<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $fillable = [];

    public static function KategoriList(){
        try {
            \DB::beginTransaction();
            $data_kategori = Produk::select(
                'kategori_id',
                )
            ->distinct()
            ->get();
            
            foreach($data_kategori as $kategori){
                // dd($kategori->kategori_id);
                $data_kategori = Kategori::where('nama_kategori',$kategori->kategori_id)->first();
                if($data_kategori){
                    $data_kategori->nama_kategori =$kategori->kategori_id;
                    $data_kategori->save();
                }else{
                    $data_kategori = new Kategori();
                    $data_kategori->id_kategori = $data_kategori->id_kategori;
                    $data_kategori->nama_kategori =$kategori->kategori_id;
                    $data_kategori->save();
                }
            }
            $kategor_list = Kategori::select('*')->get();
            // dd($kategor_list);
            \DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            \DB::rollback();
            $error = error($th, getErrorMsg());
            $response = array('status' => 'error', 'code' => 500, 'message' => $error);
        }
        
    }
}
