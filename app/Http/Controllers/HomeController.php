<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Status;
use DataTables;
use RealRashid\SweetAlert\Facades\Alert;
// setelahnya
use Illuminate\Contracts\View\Factory;


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

    public function listAjax(Request $request)
    {
        $produk = Produk::orderBy('id_produk','desc');

        // Filter berdasarkan status_id jika ada dalam request
        if ($request->status_id == 'tidak bisa dijual') {
            $produk = $produk->where('status_id', 'tidak bisa dijual'); 
        } elseif ($request->status_id == 'bisa dijual') {
            $produk = $produk->where('status_id', 'bisa dijual'); 
        }
        return Datatables::of($produk)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                $btn .=  '<a href="' . route('produk.edit', $row->id_produk) . '" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-edit"></i></a>' . '&nbsp';
                $btn .= '<a href="' . route('produk.delete', $row->id_produk) . '" class="btn btn-danger btn-sm" onclick="confirmDelete(event, ' . $row->id_produk . ')"><i class="nav-icon fas fa-trash"></i></a>';
                return $btn;
            })
            ->editColumn('harga', function ($row) {
                return formatRupiah($row->harga);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%m/%d/%Y') LIKE ?", ["%$keyword%"]);
            })
            ->make(true);
    }
}
