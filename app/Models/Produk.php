<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class Produk extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $fillable = [];

    public static function ProdukList(){
        try {
            \DB::beginTransaction();
            $client = new Client([
                'headers' => [
                    'content-type' => 'application/json',
                ]
            ]);
            $input = [
                'username' => 'tesprogrammer221223C03',
                'password' => md5('bisacoding-22-12-23'),
            ];
            
            $respon = $client->request('POST','https://recruitment.fastprint.co.id/tes/api_tes_programmer',['form_params' => $input]);
            $responseBody = json_decode($respon->getBody()); 
            $produks = $responseBody->data;

            foreach($produks as $produk){
                $data_produk = Produk::where('id_produk',$produk->id_produk)->first();
                if($data_produk){
                    $data_produk->nama_produk =$produk->nama_produk;
                    $data_produk->harga =$produk->harga;
                    $data_produk->kategori_id =$produk->kategori;
                    $data_produk->status_id =$produk->status;
                    $data_produk->save();
                }else{
                    $data_produk = new Produk;
                    $data_produk->id_produk = $produk->id_produk;
                    $data_produk->nama_produk =$produk->nama_produk;
                    $data_produk->harga =$produk->harga;
                    $data_produk->kategori_id =$produk->kategori;
                    $data_produk->status_id =$produk->status;
                    $data_produk->save();
                }
            }
            
            $produk_list = Produk::select('*')
            ->get();
            $response['status'] = 'success';
            $response['code'] = 200;
            $response['data'] = $produk_list;
            \DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            \DB::rollback();
            $error = error($th, getErrorMsg());
            $response = array('status' => 'error', 'code' => 500, 'message' => $error);
        }
        return $response;
        // return response()->json($response);
    }
    public function set($data)
    {
        $this->nama_produk = isset($data->nama_produk) ? $data->nama_produk : '';
        $this->harga = isset($data->harga) ? $data->harga : '';
        $this->kategori_id = isset($data->kategori_id) ? $data->kategori_id : '';
        $this->status_id = isset($data->status_id) ? $data->status_id : '';

        return $this;
    }
}
