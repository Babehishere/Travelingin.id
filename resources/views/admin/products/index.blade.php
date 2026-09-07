@extends('layouts.admin')
@section('title', 'Katalog Produk')
@section('content')
<!-- Sticky Header & Search Bar -->
<div class="sticky top-[-2.5rem] -mx-10 px-10 py-5 bg-white/90 backdrop-blur-md border-b border-gray-100 z-30 flex flex-col md:flex-row justify-between items-center gap-6 mb-8">
    <div>
        <h2 class="text-xl font-bold text-primary font-heading">Daftar Destinasi & Tiket</h2>
        <p class="text-xs text-gray-400 mt-1">Kelola portofolio perjalanan Anda di sini &bull; <span id="product-count" class="font-bold text-accent">{{ $products->count() }}</span> Produk</p>
    </div>
    
    <div class="flex items-center gap-4 w-full md:w-auto flex-1 md:flex-none justify-end">
        <!-- Search Input -->
        <div class="relative w-full md:w-80">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">
                <i class="fas fa-search"></i>
            </span>
            <input type="text" id="admin-search-input" oninput="filterProducts()" placeholder="Cari destinasi, kategori..." class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200/60 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all text-sm font-medium">
        </div>
        
        <!-- Add Button -->
        <button onclick="openAddProductModal()" class="bg-primary hover:bg-secondary text-accent px-6 py-3 rounded-xl text-sm font-bold transition-all duration-300 flex items-center gap-3 shadow-lg shadow-primary/10 whitespace-nowrap">
            <i class="fas fa-plus"></i> Tambah Produk Baru
        </button>
    </div>
</div>

<!-- Category Filter Tabs -->
<div class="flex items-center gap-2 mb-6 bg-gray-50/50 p-1.5 rounded-2xl w-fit border border-gray-100/60 no-print">
    <button onclick="setFilterType('all')" id="tab-all" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 bg-primary text-accent shadow-sm">Semua</button>
    <button onclick="setFilterType('tiket')" id="tab-tiket" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 text-gray-500 hover:text-primary">Tiket</button>
    <button onclick="setFilterType('paket')" id="tab-paket" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 text-gray-500 hover:text-primary">Paket</button>
    <button onclick="setFilterType('tourguide')" id="tab-tourguide" class="px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-all duration-300 text-gray-500 hover:text-primary">Tourguide</button>
</div>

<div class="luxury-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-primary/50 text-[11px] uppercase tracking-widest border-b border-gray-50">
                    <th class="px-8 py-5 font-bold">Produk</th>
                    <th class="px-8 py-5 font-bold">Kategori</th>
                    <th class="px-8 py-5 font-bold">Harga</th>
                    <th class="px-8 py-5 font-bold">Status</th>
                    <th class="px-8 py-5 font-bold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody id="products-table-body" class="text-sm divide-y divide-gray-50">
                @forelse($products as $product)
                <tr class="product-row hover:bg-gray-50/30 transition-colors group"
                    data-name="{{ strtolower($product->name) }}"
                    data-type="{{ strtolower($product->type) }}">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                @if($product->image)
                                    <img src="{{ Str::startsWith($product->image, ['http://', 'https://']) ? $product->image : asset('storage/' . $product->image) }}" referrerpolicy="no-referrer" class="w-14 h-14 object-cover rounded-xl shadow-sm">
                                @else
                                    <div class="w-14 h-14 bg-gray-100 rounded-xl flex items-center justify-center text-gray-300">
                                        <i class="fas fa-image text-xl"></i>
                                    </div>
                                @endif
                                @if($product->is_special_offer)
                                    <div class="absolute -top-2 -right-2 w-5 h-5 bg-accent text-primary text-[10px] flex items-center justify-center rounded-full border-2 border-white">
                                        <i class="fas fa-star"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-primary group-hover:text-accent transition-colors">{{ $product->name }}</p>
                                <p class="text-[11px] text-gray-400 font-medium"><i class="fas fa-calendar-alt mr-1"></i> {{ $product->travel_date ? \Carbon\Carbon::parse($product->travel_date)->format('d M Y') : 'No Date' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-gray-100 text-gray-500">
                            {{ $product->type }}
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        @if($product->discount_price)
                            <p class="text-[10px] text-red-400 line-through font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="font-bold text-emerald-600">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</p>
                        @else
                            <p class="font-bold text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        @endif
                    </td>
                    <td class="px-8 py-5">
                        @if($product->is_special_offer)
                            <div class="flex items-center gap-2 text-accent">
                                <div class="w-2 h-2 bg-accent rounded-full animate-pulse"></div>
                                <span class="text-[10px] font-bold uppercase tracking-widest">Special Offer</span>
                            </div>
                        @else
                            <span class="text-[10px] font-bold uppercase tracking-widest text-gray-300">Reguler</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-amber-50 text-amber-600 hover:bg-accent hover:text-white transition-all duration-300">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block delete-product-form" onsubmit="confirmDeleteProduct(event, this)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <i class="fas fa-folder-open text-6xl mb-4"></i>
                            <p class="font-bold uppercase tracking-widest text-xs">Belum ada produk yang terdaftar</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Product -->
<div id="addProductModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#0A192F]/60 backdrop-blur-sm transition-opacity duration-300" onclick="closeAddProductModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white text-primary w-full max-w-3xl mx-4 rounded-3xl border border-gray-100 shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 z-10 max-h-[90vh] flex flex-col" id="addProductModalCard">
        <!-- Header -->
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center sticky top-0 bg-white z-20">
            <div>
                <h2 class="text-xl font-bold text-primary">Tambah Produk Baru</h2>
                <p class="text-xs text-gray-400 mt-1">Lengkapi detail paket atau tiket perjalanan baru</p>
            </div>
            <button onclick="closeAddProductModal()" class="text-gray-400 hover:text-accent transition-colors focus:outline-none">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Form Body -->
        <div class="overflow-y-auto flex-1">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                
                @if($errors->any() && !session('success'))
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-xl text-xs space-y-1">
                    <p class="font-bold">Terjadi kesalahan input:</p>
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Nama Destinasi / Produk</label>
                        <input type="text" name="name" placeholder="E.g. Explore Bromo Sunrise" required value="{{ old('name') }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Harga Normal (Rp)</label>
                        <input type="number" name="price" placeholder="0" required value="{{ old('price') }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Harga Diskon (Opsional)</label>
                        <input type="number" name="discount_price" placeholder="Kosongkan jika tidak ada promo" value="{{ old('discount_price') }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Kategori Produk</label>
                        <select name="type" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium appearance-none">
                            <option value="paket" {{ old('type') == 'paket' ? 'selected' : '' }}>Paket Liburan</option>
                            <option value="tiket" {{ old('type') == 'tiket' ? 'selected' : '' }}>Tiket</option>
                            <option value="tourguide" {{ old('type') == 'tourguide' ? 'selected' : '' }}>Tourguide</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Tipe Paket</label>
                        <select name="package_type" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium appearance-none">
                            <option value="general" {{ old('package_type') == 'general' ? 'selected' : '' }}>Umum / Semua Kalangan</option>
                            <option value="family" {{ old('package_type') == 'family' ? 'selected' : '' }}>Keluarga (Family)</option>
                            <option value="backpacker" {{ old('package_type') == 'backpacker' ? 'selected' : '' }}>Backpacker</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Kuota (Pax)</label>
                        <input type="number" name="quota" value="{{ old('quota', 50) }}" required min="0" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Loyalty Points</label>
                        <input type="number" name="loyalty_points" value="{{ old('loyalty_points', 100) }}" required min="0" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium" placeholder="E.g. 100">
                    </div>

                    <div>
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Tanggal Keberangkatan</label>
                        <input type="date" name="travel_date" value="{{ old('travel_date') }}" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">
                    </div>

                    <div class="col-span-2">
                        <div class="bg-amber-50/50 border border-amber-100 p-6 rounded-2xl">
                            <label class="flex items-start gap-4 cursor-pointer">
                                <div class="mt-1">
                                    <input type="checkbox" name="is_special_offer" value="1" {{ old('is_special_offer') ? 'checked' : '' }} class="w-5 h-5 rounded border-amber-200 text-accent focus:ring-accent/20">
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-amber-900">Aktifkan Sebagai "Special Offer"</p>
                                    <p class="text-[11px] text-amber-700/70 mt-0.5">Produk akan tampil di halaman promo utama dengan label khusus.</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Deskripsi Lengkap</label>
                        <textarea name="description" rows="4" placeholder="Tuliskan detail itinerary, fasilitas, dan informasi penting lainnya..." required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-accent/20 focus:border-accent outline-none transition-all font-medium">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-[11px] uppercase tracking-widest font-bold text-gray-400 mb-2">Foto Destinasi</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-100 border-dashed rounded-xl hover:border-accent/50 transition-colors cursor-pointer group bg-gray-50/50">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-300 group-hover:text-accent transition-colors"></i>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label class="relative cursor-pointer bg-transparent rounded-md font-bold text-primary hover:text-accent focus-within:outline-none transition-colors">
                                        <span>Klik untuk upload gambar</span>
                                        <input name="image" type="file" class="sr-only" onchange="updateFileName(this)">
                                    </label>
                                </div>
                                <p id="fileNameDisplay" class="text-xs font-semibold text-accent mt-1"></p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-50 flex items-center justify-end gap-4 sticky bottom-0 bg-white z-20">
                    <button type="button" onclick="closeAddProductModal()" class="text-gray-400 hover:text-primary px-6 py-4 text-sm font-bold transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="bg-primary hover:bg-secondary text-accent px-10 py-4 rounded-xl text-sm font-bold transition-all duration-300 shadow-xl shadow-primary/20">
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Confirmation -->
<div id="deleteConfirmModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#0A192F]/60 backdrop-blur-sm transition-opacity duration-300" onclick="closeDeleteModal()"></div>
    
    <!-- Modal Card -->
    <div class="relative bg-white text-primary w-full max-w-md mx-4 rounded-3xl border border-gray-100 shadow-2xl p-8 transform scale-95 opacity-0 transition-all duration-300 z-10 text-center" id="deleteConfirmModalCard">
        <div class="w-16 h-16 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-exclamation-triangle text-2xl"></i>
        </div>
        
        <h3 class="text-xl font-bold text-primary mb-2">Hapus Produk?</h3>
        <p class="text-sm text-gray-400 leading-relaxed mb-8">Apakah Anda yakin ingin menghapus produk ini? Semua data terkait produk ini akan terhapus secara permanen.</p>
        
        <div class="flex items-center gap-4">
            <button onclick="closeDeleteModal()" class="flex-1 py-3.5 rounded-xl border border-gray-200 text-gray-500 font-bold text-sm hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button onclick="submitDelete()" class="flex-1 py-3.5 rounded-xl bg-red-500 text-white font-bold text-sm hover:bg-red-600 shadow-lg shadow-red-500/20 transition-all">
                Hapus Permanen
            </button>
        </div>
    </div>
</div>

<script>
    let formToDelete = null;

    function openAddProductModal() {
        const modal = document.getElementById('addProductModal');
        const card = document.getElementById('addProductModalCard');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeAddProductModal() {
        const modal = document.getElementById('addProductModal');
        const card = document.getElementById('addProductModalCard');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
    }

    function confirmDeleteProduct(event, form) {
        event.preventDefault();
        formToDelete = form;
        
        const modal = document.getElementById('deleteConfirmModal');
        const card = document.getElementById('deleteConfirmModalCard');
        
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteConfirmModal');
        const card = document.getElementById('deleteConfirmModalCard');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
        formToDelete = null;
    }

    function submitDelete() {
        if (formToDelete) {
            formToDelete.submit();
        }
    }

    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files && input.files[0]) {
            display.innerText = "Selected: " + input.files[0].name;
        } else {
            display.innerText = "";
        }
    }

    let activeType = 'all';

    function setFilterType(type) {
        activeType = type;
        
        // Update active tab styles
        const tabs = ['all', 'tiket', 'paket', 'tourguide'];
        tabs.forEach(t => {
            const btn = document.getElementById('tab-' + t);
            if (btn) {
                if (t === type) {
                    btn.classList.add('bg-primary', 'text-accent', 'shadow-sm');
                    btn.classList.remove('text-gray-500', 'hover:text-primary');
                } else {
                    btn.classList.remove('bg-primary', 'text-accent', 'shadow-sm');
                    btn.classList.add('text-gray-500', 'hover:text-primary');
                }
            }
        });

        filterProducts();
    }

    function filterProducts() {
        const input = document.getElementById('admin-search-input');
        const filter = input.value.toLowerCase().trim();
        const rows = document.querySelectorAll('.product-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            const type = row.getAttribute('data-type');
            
            const matchesSearch = name.includes(filter) || type.includes(filter);
            const matchesType = activeType === 'all' || type === activeType;
            
            if (matchesSearch && matchesType) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const countBadge = document.getElementById('product-count');
        if (countBadge) {
            countBadge.innerText = visibleCount;
        }
    }
</script>

@if($errors->any() && !session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        openAddProductModal();
    });
</script>
@endif

@endsection