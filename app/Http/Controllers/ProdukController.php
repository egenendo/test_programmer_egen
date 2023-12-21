<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->moduleDetails["title"] = "Produk";
        $this->moduleDetails["menu"] = "produk";
    }

    public function index(){
        try{
            \DB::beginTransaction();
            $this->moduleDetails["type"] = "List";
            $_SESSION['menu'] = $this->moduleDetails["menu"];
            $produk = Produk::get();
            // $getProdukList = new Produk();
            // $produk = $getProdukList->ProdukList();
            // $produk = (Object)$produk;
            // $produk_list = count($produk->data);
            // $produk_sell = Produk::where('status_id','bisa dijual')->get();
            // $count_produk_sell = count($produk_sell);
            // $produk_not_sell = Produk::where('status_id','tidak bisa dijual')->get();
            // $count_produk_not_sell = count($produk_not_sell);
            $data = [
                "moduleDetails" => $this->moduleDetails,
                "produk" => $produk,                
            ];
            \DB::commit();
            return view('pages.produk.index',$data);
        }catch(\Throwable $e){
            dd($e);
            \DB::rollback();
            return redirect()->route('home')->with('error', 'Terjadi Kesalahan! ('.$e->getMessage().')');
        }
    }
}
