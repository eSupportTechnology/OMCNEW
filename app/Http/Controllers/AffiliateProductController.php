<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductImage;
use App\Models\RaffleTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AffiliateProductController extends Controller
{


    public function showAdCenter(Request $request)
{
    $categoryName = $request->get('category', 'all');
    $query = Products::where('is_affiliate', 1);
    
    $customerId = Session::get('customer_id');
    
    // Get all tracking IDs (raffle tickets) for the logged-in user
    $trackingIds = RaffleTicket::where('user_id', $customerId)->get();

    // Check if there's already a tracking ID with 'Active' status (default equivalent)
    $defaultTrackingId = $trackingIds->where('status', 'Pending')->first();

    // If no "Active" tracking ID is set and the user has at least one tracking ID, set the first one as "Active"
    if (!$defaultTrackingId && $trackingIds->count() == 1) {
        $defaultTrackingId = $trackingIds->first(); // Set the first ID as the default for this session
        $defaultTrackingId->status = 'Pending'; // Mark it as Active (default equivalent)
        $defaultTrackingId->save(); // Save to the database
    }

    // Filter products by category if a specific category is selected
    if ($categoryName != 'all') {
        $query->where('product_category', $categoryName);
    }

    $hotDeals = $query->get();

    // Filter high commission products (with commission percentage greater than the threshold)
    $commissionThreshold = 8;
    $highComQuery = Products::where('commission_percentage', '>', $commissionThreshold)
        ->where('is_affiliate', 1);

    // Apply category filter to high commission products as well
    if ($categoryName != 'all') {
        $highComQuery->where('product_category', $categoryName);
    }

    $highCom = $highComQuery->get();
    
    // Get all categories to display in the view
    $categories = Category::all(); 

    // Return the view with hot deals, high commission products, categories, and default tracking ID
    return view('affiliate_dashboard.ad_center', compact('hotDeals', 'highCom', 'categories', 'defaultTrackingId'));
}



    
    public function generatePromo(Request $request)
{
    dd($request);
    // Validate the request
    $request->validate([
        'product_ids' => 'required|string',
    ]);


    // Get the product IDs from the request
    $productIds = explode(',', $request->input('product_ids'));

    // Process the product IDs as needed
    // For example, you might want to perform actions like sending emails, updating the database, etc.

    return redirect()->back()->with('success', 'Products promoted successfully!');
}


    


    public function showPromoteModal($product_id)
    {
        $product = Products::with('images')->where('product_id', $product_id)->firstOrFail();
        return view('promote-modal', compact('product'));
    }

    


    public function downloadImages(Request $request)
    {
        $ids = explode(',', $request->query('ids'));
        $images = ProductImage::whereIn('id', $ids)->get();

        $zip = new \ZipArchive();
        $zipFileName = 'images.zip';
        $tempFile = tempnam(sys_get_temp_dir(), $zipFileName);
        $zip->open($tempFile, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach ($images as $image) {
            $filePath = storage_path('app/public/' . $image->image_path);
            if (file_exists($filePath)) {
                $zip->addFile($filePath, basename($filePath));
            }
        }

        $zip->close();
        return response()->download($tempFile, $zipFileName)->deleteFileAfterSend(true);
        }


}
