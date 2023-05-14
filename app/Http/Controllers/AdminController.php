<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Trans_detail;
use App\Models\Trans_header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin/index');
    }

    public function data_produk_admin()
    {
        $data_produk = Product::latest()->paginate(5);

        return view('admin/produk/data_produk', compact('data_produk'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function input_data_product()
    {
        return view('admin/produk/input_produk');
    }

    public function store_data_product(Request $request)
    {
        $request->validate([
            'product_code' => 'required|unique:product',
            'product_name' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'discount' => 'required',
            'dimension' => 'required',
            'unit' => 'required',
        ]);

        Product::create($request->all());

        return redirect('data_produk_admin')->with('succes', 'Data Berhasil di Input');
    }

    public function edit_data_product_admin($id)
    {
        $data_produk = Product::find($id);

        return view('admin.produk.edit_produk', compact('id', 'data_produk'));
    }

    public function update_data_product(Request $request, $id)
    {
        $request->validate([
            'product_code' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'currency' => 'required',
            'discount' => 'required',
            'dimension' => 'required',
            'unit' => 'required',
        ]);

        $kpr = Product::find($id);
        $kpr->product_code = $request->product_code;
        $kpr->product_name = $request->product_name;
        $kpr->price = $request->price;
        $kpr->currency = $request->currency;
        $kpr->discount = $request->discount;
        $kpr->dimension = $request->dimension;
        $kpr->unit = $request->unit;
        $kpr->save();

        return redirect('data_produk_admin')->with('succes', 'Data Berhasil di Update');
    }

    public function hapus_data_product_admin($id)
    {
        Product::find($id)->delete();

        return redirect('data_produk_admin')->with('succes', 'Data Berhasil di Hapus');
    }

    public function report_penjualan()
    {
        $date = Date('Y-m-d');

        $data = DB::select('CALL report_penjualan');

        $data1 = Trans_header::all();

        $data2 = Trans_detail::join('product', 'trans_detail.product_code', '=', 'product.product_code')
            ->get();

        $pdf = PDF::loadview('admin.produk.report_penjualan_pdf', compact('data1', 'data2'))->setPaper('a4', 'landscape');

        return $pdf->download('Laporan Penjualan ' . $date . '.pdf');
    }
}
