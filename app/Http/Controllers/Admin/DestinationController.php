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

        $fallbacks = [
            'tiket' => [
                'photo-1544829099-b9a0c07fad1a', 'photo-1508009603885-50cf7c579365', 'photo-1598977123418-45f04b01d1bb',
                'photo-1568849676085-51415703900f', 'photo-1584551246679-0daf3d275d0f', 'photo-1534447677768-be436bb09401',
                'photo-1564507592333-c60657eea523', 'photo-1528127269322-539801943592', 'photo-1518638150341-db4e437c3574'
            ],
            'paket' => [
                'photo-1507525428034-b723cf961d3e', 'photo-1469854523086-cc02fe5d8800', 'photo-1476514525535-07fb3b4ae5f1',
                'photo-1506929562872-bb421503ef21', 'photo-1530789253388-582c481c54b0', 'photo-1488646953014-85cb44e25828',
                'photo-1501785888041-af3ef285b470', 'photo-1475924156734-496f6cac6ec1', 'photo-1527631746610-bca00a040d60'
            ],
            'tourguide' => [
                'photo-1527529482837-4698179dc6ce', 'photo-1551882547-ff40c63fe5fa', 'photo-1488085061387-422e29b40080',
                'photo-1501555088652-021faa106b9b', 'photo-1522202176988-66273c2fd55f', 'photo-1519671482749-fd09be7ccebf',
                'photo-1517841905240-472988babdf9', 'photo-1539571696357-5a69c17a67c6', 'photo-1506794778202-cad84cf45f1d'
            ]
        ];

        foreach ($products as $idx => $p) {
            $changed = false;
            $type = $p->type ?? 'paket';
            $pool = $fallbacks[$type] ?? $fallbacks['paket'];

            if ($p->image && str_contains($p->image, 'wikimedia.org')) {
                $fallbackId = $pool[$idx % count($pool)];
                $p->image = "https://images.unsplash.com/{$fallbackId}?auto=format&fit=crop&w=800&q=80";
                $changed = true;
            }

            if ($p->gallery && is_array($p->gallery)) {
                $newGallery = [];
                foreach ($p->gallery as $gIdx => $gUrl) {
                    if (str_contains($gUrl, 'wikimedia.org')) {
                        $fallbackId = $pool[($idx + $gIdx + 1) % count($pool)];
                        $newGallery[] = "https://images.unsplash.com/{$fallbackId}?auto=format&fit=crop&w=800&q=80";
                        $changed = true;
                    } else {
                        $newGallery[] = $gUrl;
                    }
                }
                if ($changed) {
                    $p->gallery = $newGallery;
                }
            }

            if ($changed) {
                $p->save();
            }
        }

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
