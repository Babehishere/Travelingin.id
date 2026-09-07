@extends('layouts.admin')
@section('title', 'Tambah Produk Baru')
@section('content')
<div class="max-w-4xl mx-auto">
    <div class="luxury-card overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-50 bg-white">
            <h2 class="text-xl font-bold text-primary">Informasi Produk</h2>
            <p class="text-xs text-gray-400 mt-1">Lengkapi detail paket atau tiket perjalanan baru</p>
        </div>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6 bg-white">
            @csrf
            
            @if ($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                    <div class="font-bold mb-1 flex items-center gap-2">
                        <i class="fas fa-exclamation-circle text-red-500"></i> Gagal menyimpan produk:
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-xs text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Nama Destinasi / Produk</label>
                    <input type="text" name="name" placeholder="E.g. Explore Bromo Sunrise" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Harga Normal (Rp)</label>
                    <input type="number" name="price" placeholder="0" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Harga Diskon (Opsional)</label>
                    <input type="number" name="discount_price" placeholder="Kosongkan jika tidak ada promo" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Kategori Produk</label>
                    <select name="type" id="product-type-select" onchange="toggleGallerySection()" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium appearance-none">
                        <option value="paket">Paket Liburan</option>
                        <option value="tiket">Tiket</option>
                        <option value="tourguide">Tourguide</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Tipe Paket</label>
                    <select name="package_type" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium appearance-none">
                        <option value="general">Umum / Semua Kalangan</option>
                        <option value="family">Keluarga (Family)</option>
                        <option value="backpacker">Backpacker</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Kuota (Pax)</label>
                    <input type="number" name="quota" value="50" required min="0" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Loyalty Points</label>
                    <input type="number" name="loyalty_points" value="100" required min="0" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium" placeholder="E.g. 100">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Tanggal Keberangkatan</label>
                    <input type="date" name="travel_date" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                </div>

                <div>
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Link Grup WhatsApp (Undangan)</label>
                    <input type="url" name="whatsapp_link" placeholder="E.g. https://chat.whatsapp.com/..." class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                </div>

                <div class="col-span-2">
                    <div class="bg-amber-50/50 border border-amber-100 p-6 rounded-2xl">
                        <label class="flex items-start gap-4 cursor-pointer">
                            <div class="mt-1">
                                <input type="checkbox" name="is_special_offer" value="1" class="w-5 h-5 rounded border-amber-200 text-accent focus:ring-accent/20">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-amber-900">Aktifkan Sebagai "Special Offer"</p>
                                <p class="text-[11px] text-amber-700/70 mt-0.5">Produk akan tampil di halaman promo utama dengan label khusus.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="col-span-2">
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Overview / Deskripsi Lengkap</label>
                    <textarea name="description" rows="5" placeholder="Tuliskan detail itinerary, overview, dan informasi penting lainnya..." required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium"></textarea>
                </div>

                <div class="col-span-2">
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">What's Included / Fasilitas yang Didapat</label>
                    <div id="whats-included-container" class="space-y-3">
                        <!-- Will be populated by JS -->
                    </div>
                    <button type="button" onclick="addIncludedField()" class="mt-2 text-xs font-bold text-accent hover:text-accent-hover transition-colors flex items-center gap-1">
                        <i class="fas fa-plus"></i> Tambah Fasilitas
                    </button>
                </div>

                <div class="col-span-2">
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Foto Utama Destinasi</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 border-dashed rounded-xl hover:border-accent/50 transition-colors cursor-pointer group bg-gray-50/50">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-image text-3xl text-gray-300 group-hover:text-accent transition-colors"></i>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="file-upload" class="relative cursor-pointer bg-transparent rounded-md font-bold text-primary hover:text-accent focus-within:outline-none transition-colors">
                                    <span>Klik untuk upload foto utama</span>
                                    <input id="file-upload" name="image" type="file" class="sr-only" onchange="updateFileName(this, 'file-name-main')">
                                </label>
                            </div>
                            <p id="file-name-main" class="text-[10px] text-gray-400 uppercase tracking-tighter">PNG, JPG, WEBP up to 10MB</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="block text-[10px] uppercase tracking-widest font-bold text-gray-400 mb-1">Atau Gunakan Link / URL Gambar (Opsional)</label>
                        <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="Contoh: https://images.pexels.com/..." class="w-full px-4 py-2.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all text-xs font-medium">
                    </div>
                </div>

                <div id="gallery-section" class="col-span-2">
                    <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Foto Galeri Lokasi (Multi-Upload)</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 border-dashed rounded-xl hover:border-accent/50 transition-colors cursor-pointer group bg-gray-50/50">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-images text-3xl text-gray-300 group-hover:text-accent transition-colors"></i>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="gallery-upload" class="relative cursor-pointer bg-transparent rounded-md font-bold text-primary hover:text-accent focus-within:outline-none transition-colors">
                                    <span>Klik untuk memilih beberapa foto galeri</span>
                                    <input id="gallery-upload" name="gallery[]" type="file" multiple class="sr-only" onchange="updateGalleryNames(this)">
                                </label>
                            </div>
                            <p id="gallery-files" class="text-[10px] text-gray-400 uppercase tracking-tighter">PNG, JPG up to 2MB (Bisa pilih banyak)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-50 flex items-center gap-4">
                <button type="submit" class="bg-primary hover:bg-secondary text-accent px-10 py-4 rounded-xl text-sm font-bold transition-all duration-300 shadow-xl shadow-primary/20">
                    Simpan Produk
                </button>
                <a href="{{ route('admin.products.index') }}" class="text-gray-400 hover:text-primary px-6 py-4 text-sm font-bold transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleGallerySection() {
        const typeSelect = document.getElementById('product-type-select');
        const gallerySection = document.getElementById('gallery-section');
        if (typeSelect && gallerySection) {
            if (typeSelect.value === 'tourguide') {
                gallerySection.style.display = 'none';
                const container = document.getElementById('whats-included-container');
                if (container) {
                    container.innerHTML = '';
                    addIncludedField('Professional Guide');
                }
            } else {
                gallerySection.style.display = 'block';
            }
        }
    }

    function updateFileName(input, targetId) {
        if (input.files && input.files.length > 0) {
            document.getElementById(targetId).innerText = "File terpilih: " + input.files[0].name;
            document.getElementById(targetId).classList.remove('text-gray-400');
            document.getElementById(targetId).classList.add('text-green-600', 'font-bold');
        }
    }

    function updateGalleryNames(input) {
        if (input.files && input.files.length > 0) {
            document.getElementById('gallery-files').innerText = "Terpilih " + input.files.length + " foto galeri";
            document.getElementById('gallery-files').classList.remove('text-gray-400');
            document.getElementById('gallery-files').classList.add('text-green-600', 'font-bold');
        }
    }

    function addIncludedField(value = '') {
        const container = document.getElementById('whats-included-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-3';
        div.innerHTML = `
            <input type="text" name="whats_included[]" value="${value}" placeholder="Contoh: Professional Guide" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
            <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700 p-2"><i class="fas fa-trash"></i></button>
        `;
        container.appendChild(div);
    }

    // Add default fields for convenience & check gallery section
    document.addEventListener('DOMContentLoaded', function() {
        toggleGallerySection();
        addIncludedField('Professional Guide');
        addIncludedField('All-in-One Ticket');
        addIncludedField('Premium Transport');
        addIncludedField('Gourmet Meals');
    });
</script>
@endsection