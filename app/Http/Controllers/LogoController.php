<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogoController extends Controller
{
    public function showLogo()
    {
        // Assuming there's only one logo record, get the first
        $logo = Logo::first();

        // If no logo record exists, create a blank instance so the form doesn't break
        if (!$logo) {
            $logo = new Logo();
        }
        return view('admin_dashboard.logo', compact('logo'));
    }

    public function insertOrUpdateLogo(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // 2MB limit
        ]);


        $logo = Logo::first(); // Assuming there's only one logo record
        if (!$logo) {
            // If no logo record exists, create a new one
            $logo = new Logo();
        }

        // If image uploaded, process it
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($logo->image_path && Storage::disk('public')->exists('logo_images/' . $logo->image_path)) {
                Storage::disk('public')->delete('logo_images/' . $logo->image_path);
            }

            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('logo_images', $filename, 'public');
            $logo->image_path = $filename;
        }

        // Update other fields
        $logo->title = $request->input('title', $logo->title); // Use existing title if not provided

        $logo->save();

        return redirect()->back()->with('success', 'Logo updated successfully.');
    }
}
