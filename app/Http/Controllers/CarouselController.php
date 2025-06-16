<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function showCarousels()
    {
        $carousels = Carousel::all();

        return view('admin_dashboard.carousel', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('carousel_images', $imageName, 'public');
        }

        Carousel::create([
            'title' => $request->input('title'),
            'image_path' => $imageName,
        ]);


        return redirect()->route('carousel')->with('status', 'Carousel added successfully.');
    }

    public function destroy($id)
    {
        $parentCategory = Carousel::find($id);

        if (!$parentCategory) {
            return response()->json(['status' => false, 'message' => 'Carousel not found.'], 404);
        }

        if ($parentCategory->image_path) {
            \Storage::disk('public')->delete('carousel_images/' . $parentCategory->image_path);
        }

        $parentCategory->delete();

        return response()->json(['status' => true, 'message' => 'Carousel deleted successfully.']);
    }

    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);

        return view('admin_dashboard.edit_carousel', [
            'carousel' => $carousel,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $carousel = Carousel::findOrFail($id);

        $imageName = $carousel->image_path;

        if ($request->hasFile('image_path')) {
            if ($carousel->image_path) {
                Storage::disk('public')->delete('carousel_images/' . $carousel->image_path);
            }

            $image = $request->file('image_path');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('carousel_images', $imageName, 'public');
        }

        $carousel->update([
            'title' => $request->input('title'),
            'image_path' => $imageName,
            'is_active' => $request->input('is_active', 1),
        ]);



        return redirect()->route('carousel')->with('status', 'Carousel updated successfully.');
    }
}
