<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;
use Illuminate\Support\Facades\Auth;


class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //proses ambil data dari mysql
        $barang = MasterBarangModel::all();
        return view('/master/barang/index',compact('barang'));
    }


    public function create()
    {
        return view('/master/barang/form-tambah');
    }


    public function store(Request $request)
    {
    //   dd($request)
    try{
      $insert = MasterBarangModel::create([
         'kode'         => $request->html_kode,
         'nama'         => $request->html_nama,
         'deskripsi'    => $request->html_deskripsi,
         'id_kategori'  => null,
         'id_gudang'    => null,
         'dibuat_kapan' => date('Y-m-d H:i:s'),
         'dibuat_oleh'  => Auth::user()->id,
        ]);
      //jika proses input ke mysql berhasil
      if($insert) {
        return redirect()
        -> route('master-barang')
        -> with('Success','Berhasil menambahkan barang baru!');
                  }
       }
       catch (\Throwable $th) {
        return redirect()
        -> route('master-barang-tambah')
        -> with('error',$th->getMessage());
       }
    }



    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
