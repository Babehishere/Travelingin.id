@extends('layouts.admin')
@section('title', 'Manajemen Pesanan')
@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="font-semibold text-gray-800 text-lg">Daftar Pesanan / Booking Masuk</h2>
        <p class="text-xs text-gray-500 mt-0.5">Pencatatan otomatis seluruh transaksi pembelian pelanggan</p>
    </div>

    <!-- Filter Bar & Export Excel -->
    <div class="px-6 py-3 bg-gray-50/70 border-b border-gray-100 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-3">
        <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap items-center gap-3 text-sm">
            <select name="destination_id" onchange="this.form.submit()" class="border-gray-200 rounded-lg text-xs md:text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white py-1.5 px-3">
                <option value="">-- Semua Produk / Destinasi --</option>
                @foreach($destinations as $dest)
                    <option value="{{ $dest->id }}" {{ request('destination_id') == $dest->id ? 'selected' : '' }}>
                        {{ $dest->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" onchange="this.form.submit()" class="border-gray-200 rounded-lg text-xs md:text-sm focus:ring-emerald-500 focus:border-emerald-500 bg-white py-1.5 px-3">
                <option value="">-- Semua Status --</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Bayar</option>
                <option value="dp_processed" {{ request('status') == 'dp_processed' ? 'selected' : '' }}>DP Diproses</option>
                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>DP Terkonfirmasi / Tiket Lunas</option>
                <option value="pelunasan_processed" {{ request('status') == 'pelunasan_processed' ? 'selected' : '' }}>Pelunasan Diproses</option>
                <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                <option value="cancel_pending" {{ request('status') == 'cancel_pending' ? 'selected' : '' }}>Pengajuan Batal</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            @if(request('destination_id') || request('status'))
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-rose-600 hover:underline font-medium ml-1">Reset Filter</a>
            @endif
        </form>

        <a href="{{ route('admin.orders.export', request()->query()) }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs md:text-sm font-semibold rounded-lg shadow-sm hover:shadow transition-all">
            <i class="fas fa-file-excel text-base"></i>
            <span>Export Excel (.csv)</span>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm border-b">
                    <th class="px-6 py-3 font-medium">ID Order</th>
                    <th class="px-6 py-3 font-medium">Pelanggan</th>
                    <th class="px-6 py-3 font-medium">Destinasi</th>
                    <th class="px-6 py-3 font-medium">Tgl Booking</th>
                    <th class="px-6 py-3 font-medium">Pax</th>
                    <th class="px-6 py-3 font-medium">Total Harga</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                    <th class="px-6 py-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-gray-500">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-800">{{ $order->nama }}</div>
                        <div class="text-xs text-gray-500">{{ $order->no_hp }}</div>
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $order->destination->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($order->tanggal_booking)->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $order->jumlah_orang }} org</td>
                    <td class="px-6 py-4 text-gray-800 font-medium">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($order->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full font-medium">Menunggu Bayar</span>
                        @elseif($order->status == 'dp_processed')
                            <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full font-medium">{{ $order->destination && $order->destination->type === 'tiket' ? 'Pembayaran Diproses' : 'DP Diproses' }}</span>
                        @elseif($order->status == 'confirmed')
                            <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded-full font-medium">{{ $order->destination && $order->destination->type === 'tiket' ? 'Lunas' : 'DP Terkonfirmasi' }}</span>
                        @elseif($order->status == 'pelunasan_processed')
                            <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-medium">Pelunasan Diproses</span>
                        @elseif($order->status == 'lunas')
                            <span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded-full font-medium">Lunas</span>
                        @elseif($order->status == 'cancel_pending')
                            <span class="bg-orange-100 text-orange-700 text-xs px-2 py-1 rounded-full font-medium">Pengajuan Batal</span>
                        @elseif($order->status == 'cancelled')
                            <span class="bg-rose-100 text-rose-700 text-xs px-2 py-1 rounded-full font-medium">Dibatalkan</span>
                        @else
                            <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full font-medium">{{ ucfirst($order->status) }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="w-8 h-8 flex items-center justify-center text-primary bg-primary/5 hover:bg-primary hover:text-white rounded-lg transition-all" title="Lihat Detail">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                            
                            @if($order->status == 'pending' || $order->status == 'dp_paid')
                            <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" class="confirm-order-form" onsubmit="confirmApproveOrder(event, this)">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center text-emerald-600 bg-emerald-50 hover:bg-emerald-600 hover:text-white rounded-lg transition-all" title="Konfirmasi Pesanan">
                                    <i class="fas fa-check text-sm"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-gray-500">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Order Confirmation -->
<div id="orderConfirmModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-[#0A192F]/60 backdrop-blur-sm transition-opacity duration-300" onclick="closeOrderConfirmModal()"></div>
    
    <!-- Modal Card -->
    <div class="relative bg-white text-primary w-full max-w-md mx-4 rounded-3xl border border-gray-100 shadow-2xl p-8 transform scale-95 opacity-0 transition-all duration-300 z-10 text-center" id="orderConfirmModalCard">
        <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-check-circle text-2xl"></i>
        </div>
        
        <h3 class="text-xl font-bold text-primary mb-2">Konfirmasi Pesanan?</h3>
        <p class="text-sm text-gray-400 leading-relaxed mb-8">Apakah Anda yakin ingin mengonfirmasi pesanan ini? Status pesanan akan diubah menjadi terkonfirmasi.</p>
        
        <div class="flex items-center gap-4">
            <button onclick="closeOrderConfirmModal()" class="flex-1 py-3.5 rounded-xl border border-gray-200 text-gray-500 font-bold text-sm hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <button onclick="submitOrderConfirm()" class="flex-1 py-3.5 rounded-xl bg-emerald-600 text-white font-bold text-sm hover:bg-emerald-700 shadow-lg shadow-emerald-600/20 transition-all">
                Ya, Konfirmasi
            </button>
        </div>
    </div>
</div>

<script>
    let formToConfirm = null;

    function confirmApproveOrder(event, form) {
        event.preventDefault();
        formToConfirm = form;
        
        const modal = document.getElementById('orderConfirmModal');
        const card = document.getElementById('orderConfirmModalCard');
        
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 50);
    }

    function closeOrderConfirmModal() {
        const modal = document.getElementById('orderConfirmModal');
        const card = document.getElementById('orderConfirmModalCard');
        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }, 300);
        formToConfirm = null;
    }

    function submitOrderConfirm() {
        if (formToConfirm) {
            formToConfirm.submit();
        }
    }
</script>
@endsection