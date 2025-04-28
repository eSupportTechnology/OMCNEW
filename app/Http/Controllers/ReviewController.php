<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $publishedReviews = Review::with(['product.images', 'user', 'media'])
            ->where('status', 'published')
            ->get();

        $pendingReviews = Review::with(['product.images', 'user'])
            ->where('status', 'pending')
            ->get();


        return view('admin_dashboard.manage_reviews', compact('publishedReviews', 'pendingReviews'));
        $pendingCount = $pendingReviews->count();
        return view('admin_dashboard.manage_reviews', compact('publishedReviews', 'pendingReviews', 'pendingCount'));


        return view('admin_dashboard.manage_reviews', compact('publishedReviews', 'pendingReviews'));
    }

    public function edit($id)
    {
        // Logic for editing a review
    }


    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->status = 'published';
        $review->save();

        return response()->json(['success' => true, 'message' => 'Review approved successfully.']);
    }


    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('manage_reviews')->with('status', 'Review deleted successfully.');
    }

}
