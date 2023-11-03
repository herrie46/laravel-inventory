<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //proses ambil data dari mysql
        $barang = MasterBarangModel::where('status',1)->get();
        return view('/master/barang/index',compact('barang'));
    }


    public function create()
    {
        return view('/master/barang/form-tambah');
    }


    public function store(Request $request)
    {
    $aturan =[
        'html_kode' => 'required|min:3|max:7|alpha_dash|unique:master_barang,kode',
        'html_nama' => 'required|min:10|max:25',
        'html_deskripsi' => 'required|max:255',
    ];
    $pesan_indo = [
        'required' =>'Wajib Diisi',
        'min' =>'Minimal :min Karakter',
        'max' =>'Maksimal :max Karakter',
        'alpha_dash' =>'Wajib menggunakan huruf,angka dan underscore'
    ];
    $validator = Validator::make($request->all(),$aturan,$pesan_indo);
    try{
        if($validator->fails()) {
            return redirect()
            -> route('master-barang-tambah')
            -> withErrors($validator)->withInput();
        } else {
      $insert = MasterBarangModel::create([
         'kode'         => strtoupper($request->html_kode),
         'nama'         => $request->html_nama,
         'deskripsi'    => $request->html_deskripsi,
         'id_kategori'  => null,
         'id_gudang'    => null,
         'dibuat_kapan' => date('Y-m-d H:i:s'),
         'dibuat_oleh'  => Auth::user()->id,
         'diperbarui_kapan' => date('Y-m-d H:i:s'),
         'diperbarui_oleh'  => Auth::user()->id,
        ]);
      //jika proses input ke mysql berhasil
      if($insert) {
        return redirect()
        -> route('master-barang')
        -> with('success','Berhasil menambahkan barang baru!');
                  }
                }
        }
       catch (\Throwable $th) {
        return redirect()
        -> route('master-barang-tambah')
        -> with('danger',$th->getMessage());
       }
    }



    public function show(string $id)
    {
        // $barang = MasterBarangModel::where(['id' => $id]) ->first();
        $barang = DB::select (
        "SELECT a.*,b.name as dibuat_nama,b.email as dibuat_email
        ,c.name as diperbarui_nama,c.email as diperbarui_email
        FROM
        master_barang a
        left join users b on b.id = a.dibuat_oleh
        left join users c on c.id = a.diperbarui_oleh
        where a.id =?;",
        [$id]
        );
        // dd($barang);
        return view('master/barang/detail',compact('barang'));
    }


    public function edit(string $id)
    {
            // $barang = MasterBarangModel::where(['id' => $id]) ->first();
            $barang = DB::select (
                "SELECT a.*,b.name as dibuat_nama,b.email as dibuat_email
                ,c.name as diperbarui_nama,c.email as diperbarui_email
                FROM
                master_barang a
                left join users b on b.id = a.dibuat_oleh
                left join users c on c.id = a.diperbarui_oleh
                where a.id =?;",
                [$id]
                );
                // dd($barang);
                return view('master/barang/form-edit',compact('barang'));
    }


    public function update(Request $request, string $id)
    {
        $aturan =[
            'html_nama' => 'required|min:10|max:25',
            'html_deskripsi' => 'required|max:255',
        ];
        $pesan_indo = [
            'required' =>'Wajib Diisi',
            'min' =>'Minimal :min Karakter',
            'max' =>'Maksimal :max Karakter',
            'alpha_dash' =>'Wajib menggunakan huruf,angka dan underscore'
        ];
        $validator = Validator::make($request->all(),$aturan,$pesan_indo);
        try{
            if($validator->fails()) {
                return redirect()
                -> route('master-barang-edit',$id)
                -> withErrors($validator)->withInput();
            } else {
          $update = MasterBarangModel::where(['id'=>$id])->Update([
             'nama'         => $request->html_nama,
             'deskripsi'    => $request->html_deskripsi,
             'diperbarui_kapan' => date('Y-m-d H:i:s'),
             'diperbarui_oleh'  => Auth::user()->id,
            ]);
          //jika proses update ke mysql berhasil
          if($update) {
            return redirect()
            -> route('master-barang')
            -> with('success','Berhasil memperbaharui barang!');
                      }
                    }
            }
           catch (\Throwable $th) {
            return redirect()
            -> route('master-barang-edit',$id)
            -> with('danger',$th->getMessage());
           }

    }


    public function destroy($id_barang)
    {
        try {
    $update = MasterBarangModel::
    where(['id' =>$id_barang])
    -> update([
        'status' => 0,
    ]);
    //jika update berhasil
    if ($update) {
        return redirect()
        ->route('master-barang')
        ->with('success','Berhasil menghapus barang');
    }}
    catch (\Throwable $th) {
        return redirect()
        ->route ('master-barang')
        ->with('danger',$th->getmessage());
    }
    }}
