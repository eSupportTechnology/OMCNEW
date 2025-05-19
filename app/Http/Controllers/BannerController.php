<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function showBanners()
    {
        $banners = Banner::all();

        return view('admin_dashboard.banner', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('banner_images', $imageName, 'public');
        }

        Banner::create([
            'title' => $request->input('title'),
            'position' => $request->input('position'),
            'image_path' => $imageName,
        ]);


        return redirect()->route('banner')->with('status', 'Banner added successfully.');
    }

    public function destroy($id)
    {
        $parentCategory = Banner::find($id);

        if (!$parentCategory) {
            return response()->json(['status' => false, 'message' => 'Banner not found.'], 404);
        }

        if ($parentCategory->image_path) {
            \Storage::disk('public')->delete('banner_images/'.$parentCategory->image_path);
        }

        $parentCategory->delete();

        return response()->json(['status' => true, 'message' => 'Banner deleted successfully.']);
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);

        return view('admin_dashboard.edit_banner', [
            'banner' => $banner,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $banner = Banner::findOrFail($id);

        $imageName = $banner->image_path;

        if ($request->hasFile('image_path')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete('banner_images/' . $banner->image_path);
            }

            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('banner_images', $imageName, 'public');
        }

        $banner->update([
            'title' => $request->input('title'),
            'position' => $request->input('position'),
            'image_path' => $imageName,
            'is_active' => $request->input('is_active', 1),
        ]);



        return redirect()->route('banner')->with('status', 'Banner updated successfully.');
    }
}
