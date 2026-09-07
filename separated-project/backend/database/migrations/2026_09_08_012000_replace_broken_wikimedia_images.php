<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Destination;

return new class extends Migration
{
    public function up(): void
    {
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

        $destinations = Destination::all();
        foreach ($destinations as $index => $dest) {
            $type = $dest->type ?? 'paket';
            $pool = $fallbacks[$type] ?? $fallbacks['paket'];
            
            // Check if main image is a Wikimedia URL or empty
            if (empty($dest->image) || str_contains($dest->image, 'wikimedia.org')) {
                $fallbackId = $pool[$index % count($pool)];
                $dest->image = "https://images.unsplash.com/{$fallbackId}?auto=format&fit=crop&w=800&q=80";
            }

            // Check gallery images
            if ($dest->gallery && is_array($dest->gallery)) {
                $newGallery = [];
                foreach ($dest->gallery as $gIndex => $gUrl) {
                    if (str_contains($gUrl, 'wikimedia.org')) {
                        $fallbackId = $pool[($index + $gIndex + 1) % count($pool)];
                        $newGallery[] = "https://images.unsplash.com/{$fallbackId}?auto=format&fit=crop&w=800&q=80";
                    } else {
                        $newGallery[] = $gUrl;
                    }
                }
                $dest->gallery = $newGallery;
            }

            $dest->save();
        }
    }

    public function down(): void
    {
    }
};
