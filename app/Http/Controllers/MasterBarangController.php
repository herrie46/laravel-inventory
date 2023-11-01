<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarangModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



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
    $aturan =[
        'html_kode' => 'required|min:3|max:7|alpha_dash',
        'html_nama' => 'required|min:10|max:25',
        'html_deskripsi' => 'max:255',
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
