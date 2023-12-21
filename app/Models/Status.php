<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    protected $fillable = [];

    public static function StatusList(){
        try {
            \DB::beginTransaction();
            $data_status = Produk::select(
                'status_id',
                )
            ->distinct()
            ->get();
            foreach($data_status as $status){
                $data_status = Status::where('nama_status',$status->status_id)->first();
                if($data_status){
                    $data_status->nama_status =$status->status_id;
                    $data_status->save();
                }else{
                    $data_status = new Status();
                    $data_status->id_status = $data_status->id_status;
                    $data_status->nama_status =$status->status_id;
                    $data_status->save();
                }
            }
            // $kategor_list = Kategori::select('*')->get();
            // // dd($kategor_list);
            \DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            \DB::rollback();
            $error = error($th, getErrorMsg());
            $response = array('status' => 'error', 'code' => 500, 'message' => $error);
        }
        
    }
}
