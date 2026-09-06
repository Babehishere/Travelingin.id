<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('destination')->latest();

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();
        $destinations = \App\Models\Destination::orderBy('name')->get();

        return view('admin.orders.index', compact('orders', 'destinations'));
    }

    public function export(Request $request)
    {
        $fileName = 'laporan-pesanan-' . date('Y-m-d-His') . '.csv';

        $query = Booking::with(['destination', 'user'])->latest();

        if ($request->filled('destination_id')) {
            $query->where('destination_id', $request->destination_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID Order',
            'Nama Pemesan',
            'No HP',
            'Email',
            'Produk / Destinasi',
            'Tgl Booking',
            'Jumlah Pax',
            'Total Harga (Rp)',
            'Jumlah DP (Rp)',
            'Status Pembayaran',
            'Tanggal Transaksi'
        ];

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            // Write UTF-8 BOM so Microsoft Excel automatically recognizes UTF-8 encoding
            fputs($file, "\xEF\xBB\xBF");
            fputcsv($file, $columns, ';');

            foreach ($orders as $order) {
                $statusText = match ($order->status) {
                    'pending' => 'Menunggu Bayar',
                    'dp_processed' => ($order->destination && $order->destination->type === 'tiket') ? 'Pembayaran Diproses' : 'DP Diproses',
                    'confirmed' => ($order->destination && $order->destination->type === 'tiket') ? 'Lunas' : 'DP Terkonfirmasi',
                    'pelunasan_processed' => 'Pelunasan Diproses',
                    'lunas' => 'Lunas',
                    'cancel_pending' => 'Pengajuan Batal',
                    'cancelled' => 'Dibatalkan',
                    default => ucfirst($order->status),
                };

                $row = [
                    '#ORD-' . str_pad($order->id, 4, '0', STR_PAD_LEFT),
                    $order->nama,
                    "'" . $order->no_hp,
                    $order->email,
                    $order->destination->name ?? 'N/A',
                    $order->tanggal_booking ? \Carbon\Carbon::parse($order->tanggal_booking)->format('d-m-Y') : '-',
                    $order->jumlah_orang,
                    $order->total_price,
                    $order->dp_amount ?? 0,
                    $statusText,
                    $order->created_at ? $order->created_at->format('d-m-Y H:i:s') : '-'
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function show($id)
    {
        $order = Booking::with('destination')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function confirm(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function confirmDp(Request $request, $id)
    {
        $booking = Booking::with('destination')->findOrFail($id);
        
        if ($booking->destination->type === 'tiket') {
            $booking->status = 'lunas';
            $booking->save();

            try {
                \Illuminate\Support\Facades\Mail::to($booking->email)->send(new \App\Mail\PelunasanConfirmed($booking));
            } catch (\Exception $e) {
                return redirect()->back()->with('success', 'Pembayaran Tiket Lunas berhasil dikonfirmasi. TAPI EMAIL GAGAL DIKIRIM: ' . $e->getMessage());
            }

            return redirect()->back()->with('success', 'Pembayaran Tiket Lunas berhasil dikonfirmasi.');
        }

        $booking->status = 'confirmed';
        $booking->save();

        try {
            \Illuminate\Support\Facades\Mail::to($booking->email)->send(new \App\Mail\DpConfirmed($booking));
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Pembayaran Down Payment berhasil dikonfirmasi. TAPI EMAIL GAGAL DIKIRIM: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pembayaran Down Payment berhasil dikonfirmasi.');
    }

    public function confirmPelunasan(Request $request, $id)
    {
        $booking = Booking::with('destination')->findOrFail($id);
        $booking->status = 'lunas';
        $booking->save();

        try {
            \Illuminate\Support\Facades\Mail::to($booking->email)->send(new \App\Mail\PelunasanConfirmed($booking));
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Pembayaran Pelunasan berhasil dikonfirmasi. Status pesanan diubah menjadi Lunas. TAPI EMAIL GAGAL: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pembayaran Pelunasan berhasil dikonfirmasi. Status pesanan diubah menjadi Lunas.');
    }

    public function approveCancellation(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->status !== 'cancel_pending') {
            return redirect()->back()->with('error', 'Status pesanan tidak valid.');
        }

        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->back()->with('success', 'Pengajuan pembatalan berhasil disetujui. Status pesanan diubah menjadi Dibatalkan.');
    }

    public function rejectCancellation(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->status !== 'cancel_pending') {
            return redirect()->back()->with('error', 'Status pesanan tidak valid.');
        }

        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->back()->with('success', 'Pengajuan pembatalan ditolak. Status pesanan dikembalikan menjadi Terkonfirmasi.');
    }
}
