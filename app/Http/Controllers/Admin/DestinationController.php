<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $products = Destination::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'type' => 'required|in:tiket,paket,tourguide',
            'package_type' => 'required|in:general,family,backpacker',
            'quota' => 'required|integer|min:0',
            'loyalty_points' => 'required|integer|min:0',
            'travel_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,svg|max:10240',
            'whatsapp_link' => 'nullable|string|max:255',
            'whats_included' => 'nullable|array',
            'whats_included.*' => 'nullable|string|max:255',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp,avif,svg|max:10240'
        ]);

        $validated['is_special_offer'] = $request->has('is_special_offer');

        
        if (isset($validated['whats_included'])) {
            $validated['whats_included'] = array_values(array_filter($validated['whats_included'], function($item) {
                return !is_null($item) && trim($item) !== '';
            }));
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        if ($validated['type'] === 'tourguide') {
            $validated['gallery'] = null;
        } elseif ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('destinations/gallery', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }

        Destination::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Destination::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Destination::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'type' => 'required|in:tiket,paket,tourguide',
            'package_type' => 'required|in:general,family,backpacker',
            'quota' => 'required|integer|min:0',
            'loyalty_points' => 'required|integer|min:0',
            'travel_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif,svg|max:10240',
            'whatsapp_link' => 'nullable|string|max:255',
            'whats_included' => 'nullable|array',
            'whats_included.*' => 'nullable|string|max:255',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp,avif,svg|max:10240'
        ]);

        $validated['is_special_offer'] = $request->has('is_special_offer');

        // Clean up empty whats_included items
        if (isset($validated['whats_included'])) {
            $validated['whats_included'] = array_values(array_filter($validated['whats_included'], function($item) {
                return !is_null($item) && trim($item) !== '';
            }));
        }

        if ($request->hasFile('image')) {
            if ($product->image && !str_starts_with($product->image, 'http://') && !str_starts_with($product->image, 'https://')) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('destinations', 'public');
            $validated['image'] = $imagePath;
        }

        if ($validated['type'] === 'tourguide') {
            $validated['gallery'] = null;
        } else {
            // Handle gallery image removals
            $gallery = $product->gallery ?? [];
            if ($request->has('remove_gallery')) {
                foreach ($request->remove_gallery as $imageToRemove) {
                    if (($key = array_search($imageToRemove, $gallery)) !== false) {
                        unset($gallery[$key]);
                        if (!str_starts_with($imageToRemove, 'http://') && !str_starts_with($imageToRemove, 'https://') && Storage::disk('public')->exists($imageToRemove)) {
                            Storage::disk('public')->delete($imageToRemove);
                        }
                    }
                }
                $gallery = array_values($gallery);
            }

            // Handle new gallery uploads
            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $gallery[] = $file->store('destinations/gallery', 'public');
                }
            }
            $validated['gallery'] = $gallery;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Destination::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
