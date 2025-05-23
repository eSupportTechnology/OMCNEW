<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function showWishlist()
    {
        if (auth()->check()) {
            $userId = auth()->id();
            // Fetch the wishlist items for the logged-in user
            $wishlistItems = Wishlist::where('user_id', $userId)
                ->with('product')  
                ->get();
        } else {
            // If the user is not logged in, display an empty collection
            $wishlistItems = collect();
        }

        if (Auth::check()) {
            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            // For guests, use session data if available
            $wishlist = session()->get('wishlist', []);
            $wishlistCount = count($wishlist);
        }

        return view('frontend.master', compact('wishlistItems', 'wishlistCount'));
    }

    
    public function toggleWishlist(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $productId = $request->input('product_id');
            
            $wishlistItem = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
            
            if ($wishlistItem) {
                $wishlistItem->delete();
                return response()->json(['message' => 'Product removed from wishlist']);
            } else {
                Wishlist::create(['user_id' => $userId, 'product_id' => $productId]);
                return response()->json(['message' => 'Product added to wishlist']);
            }
        }
    
        return response()->json(['error' => 'You must be logged in to add to wishlist']);
    }
    
    
    
    
    public function checkMultipleWishlist(Request $request)
    {
        $productIds = $request->input('product_ids');
        $userId = Auth::id();
    
        if ($userId) {
            // Fetch products in the wishlist for the current user
            $wishlistProducts = Wishlist::where('user_id', $userId)
                                         ->whereIn('product_id', $productIds)
                                         ->pluck('product_id');
            return response()->json(['wishlist' => $wishlistProducts]);
        }
    
        return response()->json(['wishlist' => []]);

    }
    
    public function remove($id)
    {
        if (auth()->check()) {
            $wishlistItem = Wishlist::where('user_id', auth()->id())->find($id);
            if ($wishlistItem) {
                $wishlistItem->delete();
            }
        } else {
            // Remove from session if the user is not logged in
            $wishlist = session()->get('wishlist', []);
            if (isset($wishlist[$id])) {
                unset($wishlist[$id]);
                session()->put('wishlist', $wishlist);
            }
        }
    
        return redirect()->back()->with('message', 'Item removed from wishlist');
    }

    public function getWishlistCount(){
        
    } 
    
  
}
