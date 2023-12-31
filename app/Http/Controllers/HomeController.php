<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Status;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->moduleDetails["title"] = "Dashboard";
        $this->moduleDetails["menu"] = "dashboard";
    }

    public function index(){ 
        try{
            \DB::beginTransaction();
            $this->moduleDetails["type"] = "List";
            $_SESSION['menu'] = $this->moduleDetails["menu"];

            $client = new Client([
                'headers' => [
                    'content-type' => 'application/json',
                ]
            ]);
            $getProdukList = new Produk();
            $produk = $getProdukList->ProdukList();
            $produk = (Object)$produk;

            $getKategorilist = new Kategori();
            $kategori = $getKategorilist->KategoriList();

            $getStatusList = new Status();
            $status = $getStatusList->StatusList();
            
            $produk_list = count($produk->data);
            $produk_sell = Produk::where('status_id','bisa dijual')->get();
            $count_produk_sell = count($produk_sell);
            $produk_not_sell = Produk::where('status_id','tidak bisa dijual')->get();
            $count_produk_not_sell = count($produk_not_sell);
            
            $data = [
                "moduleDetails" => $this->moduleDetails,
                "produk" => $produk,
                "produk_list" => $produk_list,
                "count_produk_sell" => $count_produk_sell,
                "count_produk_not_sell" => $count_produk_not_sell
            ];
            
            \DB::commit();
            return view('pages.dashboard.index',$data);
        }catch(\Throwable $e){
            dd($e);
            \DB::rollback();
            return redirect()->route('home')->with('error', 'Terjadi Kesalahan! ('.$e->getMessage().')');
        }
    }
}
