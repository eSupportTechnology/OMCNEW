<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\Inquiry;
use App\Models\Review;
use App\Models\ReviewMedia;
use App\Models\Products;
use App\Models\Address;
use App\Models\ShippingCharge;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class UserDashboardController extends Controller
{

    public function myOrders(Request$request)
    {
        $tab = $request->query('tab', 'all-orders');
         
        $orders = CustomerOrder::with(['items.product'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $pendingOrders = $orders->where('status', 'Confirmed');
        $inProgressOrders = $orders->filter(function ($order) {
            return $order->status === 'In Progress' || $order->status === 'Paid';
        });
        $shippedOrders = $orders->where('status', 'Shipped');
        $deliveredOrders = $orders->where('status', 'Delivered');
        $cancelledOrders = $orders->where('status', 'Cancelled');

        return view('member_dashboard.myorders', compact(
            'orders',
            'pendingOrders',
            'inProgressOrders',
            'shippedOrders',
            'deliveredOrders',
            'cancelledOrders',
            'tab'
        ));
    }





    public function updateProfile(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'phone_num' => 'nullable|string|max:15',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();


        // Handle file upload for profile image
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }
            $profilePicturePath = $request->file('profile_image')->store('profile_image', 'public');

            $user->profile_image = $profilePicturePath;
        }

        // Update the user's profile with the provided input
        $user->name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->phone_num = $request->input('phone_num');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->gender = $request->input('gender');


        // Save the updated user information
        $user->save();

        return redirect()->back()->with('status', 'Profile updated successfully!');
    }


    public function orderDetails($order_code)
{
    $order = CustomerOrder::with(['items.product'])->where('order_code', $order_code)->first();

    if (!$order) {
        return redirect()->route('myorders')->with('error', 'Order not found');
    }

    // Calculate total quantity of all items in the order
    $totalQuantity = $order->items->sum('quantity');

    // Get the shipping charge based on total quantity
    $shippingCharge = ShippingCharge::where('min_quantity', '<=', $totalQuantity)
        ->where('max_quantity', '>=', $totalQuantity)
        ->first();

    $deliveryFee = $shippingCharge->charge ?? 0;

    return view('member_dashboard.order-details', compact('order', 'deliveryFee'));
}


    public function showInquiries()
    {
        $userId = auth()->id();

        $inquiries = Inquiry::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('member_dashboard.myinquiries', compact('inquiries'));
    }



    public function cancelOrder(Request $request, $order_code)
{
    $order = CustomerOrder::where('order_code', $order_code)->first();

    if (!$order) {
        return response()->json(['success' => false, 'message' => 'Order not found'], 404);
    }

    if ($order->status === 'Cancelled') {
        return response()->json(['success' => false, 'message' => 'Order already cancelled'], 400);
    }

    // Fetch order items using order_code (not order_id)
    $orderItems = CustomerOrderItems::where('order_code', $order_code)->get();

    foreach ($orderItems as $item) {
        // Now match product using 'product_id' field in DB (your table has this field)
        $product = Products::where('product_id', $item->product_id)->first();

        if ($product) {
            $product->quantity += $item->quantity;
            $product->save();
        }
    }

    $order->status = 'Cancelled';
    $order->save();

    return response()->json(['success' => true]);
}


    public function confirmDelivery(Request $request)
    {
        $order = CustomerOrder::where('order_code', $request->order_code)->first();
        if ($order) {
            $order->status = 'Delivered';
            $order->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }






    public function updatePassword(Request $request)
    {
    // 1. Validation
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    // 2. Check if current password is correct
    if (!Hash::check($request->input('current_password'), Auth::user()->password)) {
        throw ValidationException::withMessages([
            'current_password' => ['The provided password does not match your current password.'],
        ]);
    }

    // 3. Update the password
    $user = Auth::user();
    $user->password = Hash::make($request->input('new_password'));
    $user->save();

    // 4. Logout the user after password change to refresh session
    Auth::logout();

    // 5. Redirect user to login page with success message
    return redirect()->route('login')->with('success', 'Password changed successfully. Please login with your new password.');
    }






    public function myReviews()
    {
        $toBeReviewedItems = CustomerOrderItems::with(['order', 'product.images', 'product.variations'])
        ->whereHas('order', function ($query) {
            $query->where('status', 'Delivered');
        })
        ->where('reviewed', 'no')
        ->whereHas('product')
        ->get();


        $reviewedItems = Review::with(['product.images', 'product.variations'])
            ->where('user_id', auth()->id())
            ->get();

        return view('member_dashboard.myreviews', compact('toBeReviewedItems', 'reviewedItems'));
    }



    public function writeReview(Request $request)
    {
        $product_id = $request->input('product_id');
        $color = $request->input('color');
        $size = $request->input('size');
        $quantity = $request->input('quantity');
        $cost = $request->input('cost');
        $order_code = $request->input('order_code');

        $product = Products::with('images')->where('product_id', $product_id)->firstOrFail();

        return view('member_dashboard.write-reviews', compact('product', 'color', 'size', 'quantity', 'cost', 'order_code'));
    }





    public function storeReview(Request $request)
    {

            $request->validate([
                'product_id' => 'required',
                'order_code' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'nullable|string',
                'is_anonymous' => 'required|boolean',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
                'video' => 'nullable|mimes:mp4,mov,ogg|max:50000',
            ]);


            $review = Review::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'order_code' => $request->order_code,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_anonymous' => $request->is_anonymous,
            ]);


            CustomerOrderItems::where('order_code', $request->order_code)
                ->where('product_id', $request->product_id)
                ->update(['reviewed' => 'yes']);


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imagePath = $image->store('reviews/images', 'public');
                    ReviewMedia::create([
                        'review_id' => $review->id,
                        'media_type' => 'image',
                        'media_path' => $imagePath,
                    ]);
                }
            }

            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('reviews/videos', 'public');

                ReviewMedia::create([
                    'review_id' => $review->id,
                    'media_type' => 'video',
                    'media_path' => $videoPath,
                ]);
            }

            return redirect()->route('myreviews')->with('status', 'Review submitted successfully');
    }



    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!$user || !isset($user->id)) {
            return redirect()->route('login');
        }

        $activities = $this->getRecentActivities($user->id);
        $notifications = $this->getRecentNotifications($user->id);

        return view('member_dashboard.dashboard', compact('user', 'activities', 'notifications'));
    }



    private function getRecentActivities($userId)
    {
        // Fetch recent orders for the user
        $orderActivities = CustomerOrder::where('user_id', $userId)
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get(['order_code', 'created_at'])
            ->map(function ($order) {
                return [
                    'type' => 'order',
                    'message' => "Order #{$order->order_code} placed on <strong>" . $order->created_at->format('F d, Y') . "</strong>",
                    'date' => $order->created_at,
                ];
            });

        // Fetch recent reviews for the user
        $reviewActivities = Review::where('user_id', $userId)
            ->whereIn('status', ['published', 'pending'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get(['product_id', 'created_at'])
            ->map(function ($review) {
                return [
                    'type' => 'review',
                    'message' => "Review for Product ID #{$review->product_id} submitted on <strong>" . $review->created_at->format('F d, Y') . "</strong>",
                    'date' => $review->created_at,
                ];
            });

        $activities = $orderActivities->merge($reviewActivities);
        $activities = $activities->sortByDesc('date')->take(3);

        if ($activities->isEmpty()) {
            return ["No recent activities."];
        }

        return $activities->pluck('message');
    }


    private function getRecentNotifications($userId)
    {
        // Fetch recent shipped orders for the user
        $orderNotifications = CustomerOrder::where('user_id', $userId)
            ->where('status', 'shipped')
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get(['order_code', 'updated_at'])
            ->map(function ($order) {
                return [
                    'message' => "Your order #{$order->order_code} has been shipped! on <strong>" . $order->updated_at->format('F d, Y') . "</strong>",
                    'updated_at' => $order->updated_at
                ];
            });


        $notifications = $orderNotifications;

        // Take the top 3 notifications without sorting
        $notifications = $notifications->take(3);

        // Extract messages for output
        if ($notifications->isEmpty()) {
            return ["No new notifications."];
        }

        return $notifications->pluck('message')->toArray();
    }






    public function updateAddress(Request $request)
    {

        $request->merge([
            'default' => $request->has('default') ? true : false,
        ]);

        // Validate the input
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'default' => 'boolean', // Now properly handling the boolean
            'address_id' => 'required|exists:addresses,id',
        ]);

            $address = Address::findOrFail($validatedData['address_id']);

            if ($validatedData['default']) {
                Address::where('user_id', $address->user_id)
                    ->where('id', '!=', $address->id)
                    ->update(['default' => 0]);

                $address->default = 1;
            } else {
                $address->default = 0;
            }

            $address->full_name = $validatedData['first_name'];
            $address->phone_num = $validatedData['phone'];
            $address->email = $validatedData['email'];
            $address->address = $validatedData['address'];
            $address->apartment = $validatedData['apartment'];
            $address->city = $validatedData['city'];
            $address->postal_code = $validatedData['postal_code'];

            if ($address->save()) {
            } else {
            }

        return redirect()->route('addresses')->with('status', 'Address updated successfully!');
    }







    public function storeAddress(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'default' => 'nullable|in:on,off',
        ]);

        $user = Auth::user();

        if (isset($validatedData['default']) && $validatedData['default'] === 'on') {
            Address::where('user_id', $user->id)
                ->where('default', true)
                ->update(['default' => false]);
        }

        $address = new Address();
        $address->user_id = $user->id;
        $address->full_name = $validatedData['first_name'];
        $address->phone_num = $validatedData['phone'];
        $address->email = $validatedData['email'];
        $address->address = $validatedData['address'];
        $address->apartment = $validatedData['apartment'];
        $address->city = $validatedData['city'];
        $address->postal_code = $validatedData['postal_code'];
        $address->default = isset($validatedData['default']) && $validatedData['default'] === 'on';

        $address->save();

        return redirect()->route('addresses')->with('status', 'Save is Successful');
    }


    public function showAddresses()
    {
        $user = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        return view('member_dashboard.addresses', compact('addresses'));
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $address = Address::where('id', $id)->where('user_id', $user->id)->first();

        if (!$address) {
            return redirect()->back()->with('error', 'Address not found or unauthorized access.');
        }

        $address->delete();
        return redirect()->route('addresses')->with('success', 'Address deleted successfully.');
    }

}
