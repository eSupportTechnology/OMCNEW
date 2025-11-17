<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;

class BannerController extends Controller
{
    public function getBanners()
    {
        $banners = Banner::where('is_active', 1)->get()->map(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $banner->title,
                'position' => $banner->position,
                'image_url' => $banner->image_path
                    ? asset('storage/banner_images/' . $banner->image_path)
                    : null,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Banners fetched successfully.',
            'data' => $banners,
        ], 200);
    }
}
