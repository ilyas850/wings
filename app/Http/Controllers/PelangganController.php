<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Trans_detail;
use App\Models\Trans_header;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PelangganController extends Controller
{
    public function index()
    {
        $user = Auth::user()->username;

        $jml_checkout = Trans_detail::where('user', $user)
            ->whereNull('doc_code')
            ->sum('quantity');

        return view('pelanggan/index', compact('jml_checkout'));
    }

    public function product_list()
    {
        $user = Auth::user()->username;

        $data_produk = Product::latest()->paginate(5);

        $jml_checkout = Trans_detail::where('user', $user)
            ->whereNull('doc_code')
            ->sum('quantity');

        return view('pelanggan/produk/product_list', compact('data_produk', 'jml_checkout'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function detail_product($id)
    {
        $item = Product::find($id);

        return view('pelanggan/produk/detail_product', compact('item'));
    }

    public function buy_product($id)
    {
        $user = Auth::user()->username;

        $data_produk = Product::where('id_product', $id)->first();

        $cek_trans = Trans_detail::where('user', $user)
            ->where('product_code', $data_produk->product_code)
            ->whereNull('doc_code')
            ->first();

        $harga_akhir = ($data_produk->price) - ($data_produk->price * $data_produk->discount) / 100;

       

        if ($cek_trans == null) {
            $sub_total = 1 * $harga_akhir;

            $trans = new Trans_detail();
            $trans->user = $user;
            $trans->product_code = $data_produk->product_code;
            $trans->price = $harga_akhir;
            $trans->quantity = 1;
            $trans->unit = $data_produk->unit;
            $trans->sub_total = $sub_total;
            $trans->currency = $data_produk->currency;
            $trans->save();
        } else {
            Trans_detail::where('user', $user)
                ->where('product_code', $data_produk->product_code)
                ->update([
                    'quantity' => DB::raw('quantity + 1'),
                    'sub_total' => ($cek_trans->quantity + 1) * $harga_akhir
                ]);
        }

        return redirect()->back()->with('succes', 'Produk Berhasil di Tambahkan');
    }

    public function checkout_page()
    {
        $user = Auth::user()->username;

        $checkout_data = Trans_detail::join('product', 'trans_detail.product_code', '=', 'product.product_code')
            ->where('trans_detail.user', $user)
            ->whereNull('trans_detail.doc_code')
            ->get();

        $total = Trans_detail::join('product', 'trans_detail.product_code', '=', 'product.product_code')
            ->where('trans_detail.user', $user)
            ->whereNull('trans_detail.doc_code')
            ->sum('sub_total');

        return view('pelanggan/produk/checkout_page', compact('checkout_data', 'total'));
    }

    public function confirmasi_checkout(Request $request)
    {
        $user = Auth::user()->username;
        $total = $request->total;
        $date = Date('Y-m-d');
        $prod_code = $request->product_code;
        $jml_code = count($prod_code);

        // Mendapatkan nilai urut terakhir dari database
        $lastBarang = Trans_header::orderBy('doc_number', 'desc')->first();

        $nextNumber = 1;
        if ($lastBarang) {
            // Jika sudah ada data sebelumnya, maka nilai urut berikutnya adalah 1 angka lebih besar
            $nextNumber = $lastBarang->doc_number + 1;
        }

        // Format nilai urut menjadi 3 digit dengan leading zero
        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $cek_header = Trans_header::where('user', $user)
            ->whereNull('doc_code')
            ->first();

        if ($cek_header == null) {

            $trans = new Trans_header();
            $trans->doc_code = 'TRX';
            $trans->doc_number = $formattedNumber;
            $trans->user = $user;
            $trans->total = $total;
            $trans->date = $date;
            $trans->save();

            for ($i = 0; $i < $jml_code; $i++) {
                $hsl = $prod_code[$i];

                Trans_detail::where('user', $user)
                    ->where('product_code', $hsl)
                    ->whereNull('doc_code')
                    ->update([
                        'doc_code' => 'TRX',
                        'doc_number' => $formattedNumber,
                    ]);
            }
        }

        return redirect('pelanggan')->with('succes', 'Produk Berhasil di Checkout');
    }
}
