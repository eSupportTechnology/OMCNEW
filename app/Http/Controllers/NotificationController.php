<?php

namespace App\Http\Controllers;
use App\Models\CustomerOrder;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class NotificationController extends Controller
{
  

    public function getNotifications()
    {
        $newOrders = CustomerOrder::where('created_at', '>=', now()->subDay())->get();
        $newRegistrations = User::where('created_at', '>=', now()->subDay())->get();
        $newReviews = Review::where('created_at', '>=', now()->subDay())->get(); 
    
        // Merge orders, registrations, and reviews into a single collection
        $allNotifications = $newOrders->merge($newRegistrations)->merge($newReviews);
    
        // Sort by created_at in descending order
        $sortedNotifications = $allNotifications->sortByDesc('created_at');
    
        // Count the number of new orders, registrations, and reviews
        $newOrdersCount = $newOrders->count();
        $newUsersCount = $newRegistrations->count();
        $newReviewsCount = $newReviews->count(); 
    
        return [
            'newOrdersCount' => $newOrdersCount,
            'newUsersCount' => $newUsersCount,
            'newReviewsCount' => $newReviewsCount, 
            'totalNotifications' => $newOrdersCount + $newUsersCount + $newReviewsCount, 
            'sortedNotifications' => $sortedNotifications->values(), 
        ];
    }
    
    


}
