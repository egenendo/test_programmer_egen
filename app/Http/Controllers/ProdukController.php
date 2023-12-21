<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Status;
use Validator;

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
            $data = [
                "moduleDetails" => $this->moduleDetails,
                "produk" => $produk,                
            ];
            \DB::commit();
            return view('pages.produk.index',$data);
        }catch(\Throwable $e){
            dd($e);
            \DB::rollback();
            return redirect()->route('produk.index')->with('error', 'Terjadi Kesalahan! ('.$e->getMessage().')');
        }
    }

    public function create(){
        try {
            \DB::beginTransaction();
            $this->moduleDetails["type"] = "Create";
            $_SESSION['menu'] = $this->moduleDetails["menu"];
            $kategori_list = Kategori::select('*')->get();
            $status_list = Status::select('*')->get();
            $data = [
                "moduleDetails" => $this->moduleDetails,
                "kategori_list" => $kategori_list,
                "status_list" => $status_list,
            ];
            return view('pages.produk.add',$data);
            \DB::commit();
        } catch (\Throwable $th) {
            \DB::rollback();
            return redirect()->route('produk.index')->with('error', 'Terjadi Kesalahan! ('.$th->getMessage().')');
        }
    }

    public function store(Request $request){
        try {
            
            \DB::beginTransaction();
            $rules = [
                'nama_produk' => 'required',
                'harga' => 'required',
                'kategori_id' => 'required',
                'status_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // dd($validator);
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $data_input = [
                "nama_produk" => $request->nama_produk,
                "harga" => $request->harga,
                "kategori_id" => $request->kategori_id,
                "status_id" => $request->status_id,
            ];
            $data_input = (object)$data_input;
            $produk = new Produk;
            $produk->set($data_input);
            
            $produk->save();
            \DB::commit();
            return redirect()->route('produk.index')->with('success',"Data Berhasil di Simpan");
        } catch (\Throwable $th) {
            dd($th);
            \DB::rollback();
            return redirect()->route('produk.index')->with('error', 'Terjadi Kesalahan! ('.$th->getMessage().')');
        }
    }

    public function edit($id){
        try{
            \DB::beginTransaction();
            $this->moduleDetails["type"] = "Edit";
            $_SESSION['menu'] = $this->moduleDetails["menu"];
            $produk = Produk::where('id_produk',$id)->first();
            $kategori_list = Kategori::select('*')->get();
            $status_list = Status::select('*')->get();
            if(!$produk){
                throw new \Exception('produk tidak ditemukan!');
            }
            $data = [
                "moduleDetails" => $this->moduleDetails,
                "produk" => $produk,
                "kategori_list" => $kategori_list,
                "status_list" => $status_list,
            ];
            // dd($data);
            \DB::commit();
            return view('pages.produk.edit',$data);
        }catch(\Throwable $e){
            \DB::rollback();
            return redirect()->route('produk.index')->with('error', 'Terjadi Kesalahan! ('.$e->getMessage().')');
        }
    }

    public function update(Request $request, $id){
        try{
            \DB::beginTransaction();
            $rules = [
                'nama_produk' => 'required',
                'harga' => 'required',
                'kategori_id' => 'required',
                'status_id' => 'required',
            ];
            
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                // dd($validator);
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            
            $produk = Produk::where('id_produk',$id)->first();
            if(!$produk){
                throw new \Exception('Produk tidak ditemukan !');
            }
            
            $data_input = [
                "nama_produk" => $request->nama_produk,
                "harga" => $request->harga,
                "kategori_id" => $request->kategori_id,
                "status_id" => $request->status_id,
            ];
            $data_input = (object)$data_input;
            $produk->set($data_input);
            $produk->save();

            \DB::commit();
            return redirect()->route('produk.index')->with('success','Produk berhasil di ubah!');
        }catch(\Throwable $e){
            \DB::rollback();
            return redirect()->route('produk.index')->with('error', 'Terjadi Kesalahan! ('.$e->getMessage().')');
        }
    }

    public function delete($id){
        try{
            \DB::beginTransaction();
            $produk = Produk::where('id_produk',$id)->first();
            if(!$produk){
                throw new \Exception('Produk tidak ada!');
            }
            $produk->delete();
            \DB::commit();
            return redirect()->route('produk.index')->with('error','Data Berhasil dihapus!');
        }catch(\Throwable $e){
            dd($e);
            \DB::rollback();
            return redirect()->route('produk.index')->with('error', 'Terjadi Kesalahan! ('.$e->getMessage().')');
        }
    }

    public function produk_sell(){
        try{
            \DB::beginTransaction();
            $this->moduleDetails["type"] = "List";
            $_SESSION['menu'] = $this->moduleDetails["menu"];
            $produk = Produk::where('status_id','bisa dijual')
            ->get();
            $data = [
                "moduleDetails" => $this->moduleDetails,
                "produk" => $produk,                
            ];
            
            \DB::commit();
            return view('pages.produk.produk_sell',$data);
        }catch(\Throwable $e){
            dd($e);
            \DB::rollback();
            return redirect()->route('produk.index')->with('error', 'Terjadi Kesalahan! ('.$e->getMessage().')');
        }
    }
}
