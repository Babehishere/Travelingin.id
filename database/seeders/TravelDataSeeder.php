<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;
use App\Models\Booking;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class TravelDataSeeder extends Seeder
{
    private function cleanSearchQuery($name) {
        $query = $name;
        $prefixes = [
            '/^paket liburan/i', '/^paket tour/i', '/^paket/i', '/^open trip/i',
            '/^jelajah alam/i', '/^liburan seru/i', '/^private tour guide/i',
            '/^private guide/i', '/^pemandu wisata/i', '/^local tour guide/i',
            '/^local guide/i', '/^guide trekking/i', '/^guide wisat/i',
            '/^guide/i', '/^pemandu/i'
        ];
        foreach ($prefixes as $pattern) {
            $query = preg_replace($pattern, '', $query);
        }
        $suffixes = [
            '/\s+\d+d\d+n\b/i', '/\s+\d+ hari\b/i', '/\s+midnight\b/i',
            '/\s+sunrise midnight\b/i', '/\s+liveaboard\b/i',
            '/\s+\(english speaking\)/i', '/\s+\(lokal\)/i',
            '/\s+\(spesialis malam\)/i', '/\s+\(bahasa prancis\)/i',
            '/\s+\(japanese speaking\)/i', '/\s+\(ranger resmi\)/i',
            '/\s+\(ranger\)/i', '/\s+berlisensi\b/i', '/\s+ranger\b/i',
            '/\s+lpi\b/i', '/\s+hpi\b/i'
        ];
        foreach ($suffixes as $pattern) {
            $query = preg_replace($pattern, '', $query);
        }
        $query = trim($query);
        return empty($query) ? $name : $query;
    }

    private function getWikimediaImagesForQuery($query, $count = 4) {
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'User-Agent' => 'TravelAppSearchBot/1.0 (contact@example.com) GuzzleHttp/7'
            ],
            'verify' => false,
            'timeout' => 5
        ]);

        $url = "https://commons.wikimedia.org/w/api.php?action=query&format=json&generator=search&gsrsearch=" . urlencode($query) . "&gsrlimit=" . ($count * 2) . "&prop=pageimages&piprop=thumbnail&pithumbsize=800";
        
        try {
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody()->getContents(), true);
            
            if (empty($data['query']['pages'])) {
                return [];
            }
            
            $urls = [];
            foreach ($data['query']['pages'] as $page) {
                if (!empty($page['thumbnail']['source'])) {
                    $source = $page['thumbnail']['source'];
                    if (str_contains($source, 'Red_Pencil_Icon') || str_contains($source, 'Locator_map')) {
                        continue;
                    }
                    $urls[] = $source;
                }
            }
            return array_slice(array_unique($urls), 0, $count);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function run(): void
    {
        // 1. Clear existing bookings & destinations
        Schema::disableForeignKeyConstraints();
        Booking::truncate();
        Destination::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Predefined fallback Unsplash Photo IDs
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

        // Excluded from API image replacement
        $excludedNames = [
            'Candi Borobudur', 'Dufan Ancol', 'Candi Prambanan', 
            'Taman Mini Indonesia Indah (TMII)', 'Kebun Raya Bogor'
        ];

        // 3. Ticket Names (exactly 25)
        $tiketNames = [
            'Candi Borobudur', 'Dufan Ancol', 'Candi Prambanan', 'Taman Mini Indonesia Indah (TMII)', 'Kebun Raya Bogor',
            'Jatim Park 1', 'Jatim Park 2', 'Jatim Park 3', 'Tebing Breksi', 'Kawah Putih Ciwidey',
            'Farmhouse Lembang', 'Garuda Wisnu Kencana (GWK)', 'Waterbom Bali', 'Taman Safari Bogor', 'Museum Angkut',
            'Floating Market Lembang', 'Orchid Forest Cikole', 'Kebun Raya Bedugul', 'Museum Nasional Jakarta', 'Lawang Sewu Semarang',
            'Benteng Vredeburg Yogyakarta', 'Taman Safari Prigen', 'Kawah Sikidang Dieng', 'Kawah Ijen Banyuwangi', 'Museum Tsunami Aceh'
        ];

        // 4. Package Names (exactly 25)
        $paketNames = [
            'Paket Liburan Bali Classic 3D2N',
            'Paket Tour Labuan Bajo Sailing Phinisi 3D2N',
            'Paket Honeymoon Lombok Romantic 4D3N',
            'Open Trip Gunung Bromo Sunrise Midnight',
            'Paket Diving Raja Ampat Liveaboard 5D4N',
            'Paket Jelajah Yogyakarta Culture & Heritage 3D2N',
            'Paket Tour Belitung Laskar Pelangi 3D2N',
            'Paket Eksotis Danau Toba & Samosir 4D3N',
            'Paket Backpacker Karimunjawa Island 3D2N',
            'Paket Derawan Escape & Whaleshark Tour 4D3N',
            'Paket Explore Wakatobi Marine Paradise 5D4N',
            'Paket Budaya Tana Toraja Mystical Tour 4D3N',
            'Paket Adventure Climb Mount Rinjani 4D3N',
            'Paket Snorkeling Pulau Weh & Banda Aceh 4D3N',
            'Paket Liburan Bandung Lembang & Ciwidey 3D2N',
            'Paket Wisata Malang Batu & Bromo 3D2N',
            'Paket Island Hopping Nusa Penida Bali 2D1N',
            'Paket Jelajah Dieng Negeri di Atas Awan 3D2N',
            'Paket Tour Bunaken & Tomohon Manado 4D3N',
            'Paket Explore Padang & Bukittinggi Minangkabau 4D3N',
            'Paket Wisata Pulau Komodo & Pink Beach 3D2N',
            'Paket Luxury Resort Nihiwatu Sumba 4D3N',
            'Paket Adventure Trekking Kawah Ijen Blue Fire 2D1N',
            'Paket Liburan Keluarga Bali Safari & Waterbom 4D3N',
            'Paket Kuliner & Belanja Jakarta Seru 3D2N'
        ];

        // 5. Tourguide Names (exactly 25)
        $tourguideNames = [
            'Private Guide Ubud & Kuta Bali (English Speaking)',
            'Pemandu Wisata Sejarah Borobudur & Prambanan (Lokal)',
            'Guide Trekking Gunung Bromo & Semeru Berlisensi',
            'Local Guide Kawah Ijen Blue Fire (Spesialis Malam)',
            'Private Tour Guide Jakarta Kota Tua & Sunda Kelapa',
            'Guide Wisata Kuliner Legendaris Yogyakarta',
            'Local Guide Island Hopping Karimunjawa & Snorkeling',
            'Pemandu Wisata Budaya Tana Toraja (Bahasa Prancis)',
            'Private Guide Diving & Snorkeling Gili Trawangan',
            'Local Guide Danau Toba & Budaya Batak Samosir',
            'Private Tour Guide Bandung Kota & Lembang',
            'Guide Trekking Mount Rinjani Lombok (Ranger Resmi)',
            'Pemandu Wisata Sejarah & Alam Belitung',
            'Private Guide Labuan Bajo & Komodo Dragon Park',
            'Guide Wisata Belanja & Kuliner Surabaya',
            'Local Guide Dieng Plateau (Culture Festival Specialist)',
            'Pemandu Wisata Snorkeling Bunaken Manado',
            'Private Tour Guide Padang & Bukittinggi Minangkabau',
            'Guide Snorkeling Pulau Weh & Pantai Iboih',
            'Local Guide Hutan Orangutan Tanjung Puting',
            'Private Guide Seminyak & Canggu Bali (Japanese Speaking)',
            'Pemandu Wisata Heritage & Batik Solo',
            'Guide Trekking Gunung Gede Pangrango Bogor',
            'Local Guide Pulau Derawan & Kakaban Jellyfish',
            'Private Tour Guide Malang Batu & Jatim Park'
        ];

        $packageTypes = ['family', 'backpacker', 'general'];

        // Seed 25 Tickets (Price: 10k - 300k, falls into Trip Finder Economy: < 2M)
        foreach ($tiketNames as $index => $name) {
            $price = 10000 * rand(1, 30); // Rp 10.000 to Rp 300.000
            $discountPrice = (rand(1, 10) > 7) ? (round(($price * 0.85) / 1000) * 1000) : null;
            $isSpecial = ($discountPrice !== null);

            // Image loading
            if (in_array($name, $excludedNames)) {
                $image = ($name === 'Dufan Ancol') 
                    ? 'destinations/CKAHEFhXbrgHySyQolhNBq9w1YbP5bn873n52rWC.jpg'
                    : 'destinations/niMm1bS2rHNNvEc3F4P6WB4bDpVMod48xDTuCrRO.jpg';
                $gallery = [
                    'https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?auto=format&fit=crop&w=800&q=80'
                ];
            } else {
                $fallbackId = $fallbacks['tiket'][$index % count($fallbacks['tiket'])];
                $image = "https://images.unsplash.com/{$fallbackId}?auto=format&fit=crop&w=800&q=80";
                $otherIds = array_values(array_diff($fallbacks['tiket'], [$fallbackId]));
                shuffle($otherIds);
                $gallery = [];
                for ($g = 0; $g < 3; $g++) {
                    $gallery[] = "https://images.unsplash.com/{$otherIds[$g]}?auto=format&fit=crop&w=800&q=80";
                }
            }

            Destination::create([
                'name' => $name,
                'description' => "Dapatkan tiket resmi masuk ke " . $name . ". Nikmati berbagai atraksi memukau, keindahan pemandangan alam, serta pengalaman liburan berkesan bersama keluarga dan teman-teman tercinta.",
                'price' => $price,
                'discount_price' => $discountPrice,
                'is_special_offer' => $isSpecial,
                'travel_date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'image' => $image,
                'whatsapp_link' => 'https://wa.me/6281234567890',
                'type' => 'tiket',
                'package_type' => $packageTypes[rand(0, 2)],
                'quota' => rand(20, 200),
                'loyalty_points' => (int)($price / 10000),
                'whats_included' => ['Tiket Masuk Resmi', 'Akses Semua Wahana Umum', 'Peta Informasi Area Wisata'],
                'gallery' => $gallery,
            ]);
        }

        // Seed 25 Packages (Price: 1M - 20M, distributed across Economy, Mid, and Luxury tiers)
        foreach ($paketNames as $index => $name) {
            // Distribute prices: 
            // 8 economy (1M - 1.9M), 9 mid (2M - 7M), 8 luxury (7.5M - 20M)
            if ($index < 8) {
                $price = 100000 * rand(10, 19); // Rp 1.000.000 to Rp 1.900.000
            } elseif ($index < 17) {
                $price = 100000 * rand(20, 70); // Rp 2.000.000 to Rp 7.000.000
            } else {
                $price = 500000 * rand(15, 40); // Rp 7.500.000 to Rp 20.000.000
            }
            
            $discountPrice = (rand(1, 10) > 7) ? (round(($price * 0.9) / 50000) * 50000) : null;
            $isSpecial = ($discountPrice !== null);

            // Image loading
            $fallbackId = $fallbacks['paket'][$index % count($fallbacks['paket'])];
            $image = "https://images.unsplash.com/{$fallbackId}?auto=format&fit=crop&w=800&q=80";
            $otherIds = array_values(array_diff($fallbacks['paket'], [$fallbackId]));
            shuffle($otherIds);
            $gallery = [];
            for ($g = 0; $g < 3; $g++) {
                $gallery[] = "https://images.unsplash.com/{$otherIds[$g]}?auto=format&fit=crop&w=800&q=80";
            }

            Destination::create([
                'name' => $name,
                'description' => "Jelajahi keindahan Indonesia lewat " . $name . ". Paket wisata lengkap, fleksibel, terpercaya, dan dirancang khusus untuk memastikan kenyamanan Anda selama berwisata tanpa repot memikirkan rincian perjalanan.",
                'price' => $price,
                'discount_price' => $discountPrice,
                'is_special_offer' => $isSpecial,
                'travel_date' => Carbon::now()->addDays(rand(3, 40))->format('Y-m-d'),
                'image' => $image,
                'whatsapp_link' => 'https://wa.me/6281234567890',
                'type' => 'paket',
                'package_type' => $packageTypes[rand(0, 2)],
                'quota' => rand(5, 40),
                'loyalty_points' => (int)($price / 15000),
                'whats_included' => ['Akomodasi Hotel AC / Penginapan', 'Transportasi Nyaman All-In (Mobil/Boat)', 'Konsumsi Kuliner Khas', 'Pemandu Lokal Berlisensi', 'Semua Tiket Masuk Wisata'],
                'gallery' => $gallery,
            ]);
        }

        // Seed 25 Tourguides (Price: 300k - 2M, distributed across Economy and Mid tiers)
        foreach ($tourguideNames as $index => $name) {
            // Distribute prices: 
            // 24 economy (300k - 1.9M), 1 mid (2M)
            if ($index < 24) {
                $price = 50000 * rand(6, 38); // Rp 300.000 to Rp 1.900.000
            } else {
                $price = 2000000; // Rp 2.000.000
            }
            
            $discountPrice = (rand(1, 10) > 7) ? (round(($price * 0.85) / 10000) * 10000) : null;
            $isSpecial = ($discountPrice !== null);

            // Image loading
            $fallbackId = $fallbacks['tourguide'][$index % count($fallbacks['tourguide'])];
            $image = "https://images.unsplash.com/{$fallbackId}?auto=format&fit=crop&w=800&q=80";

            Destination::create([
                'name' => $name,
                'description' => "Jadikan perjalanan Anda lebih berkesan dengan menyewa pemandu lokal handal melalui " . $name . ". Dapatkan pemandu berpengalaman, ramah, menguasai sejarah lokal, serta siap menyusun rencana perjalanan fleksibel.",
                'price' => $price,
                'discount_price' => $discountPrice,
                'is_special_offer' => $isSpecial,
                'travel_date' => Carbon::now()->addDays(rand(1, 20))->format('Y-m-d'),
                'image' => $image,
                'whatsapp_link' => 'https://wa.me/6281234567890',
                'type' => 'tourguide',
                'package_type' => $packageTypes[rand(0, 2)],
                'quota' => rand(2, 10),
                'loyalty_points' => (int)($price / 8000),
                'whats_included' => ['Professional Guide'],
                'gallery' => null,
            ]);
        }
    }
}
