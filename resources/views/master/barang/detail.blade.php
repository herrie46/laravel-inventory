@extends('master/all')
@section('master-konten')

<h3>Detail barang </h3>
@if (isset($barang[0]))
@php
    $tanggal_dibuat = new Datetime($barang[0]->dibuat_kapan);
    $dibuat = $tanggal_dibuat ->format('d M Y');

    $tanggal_diperbarui = new Datetime($barang[0]->diperbarui_kapan);
    $diperbarui = $tanggal_diperbarui ->format('d M Y');
@endphp

<div class="card w-50 shadow" >
    <div class="card-body">
      <h5 class="card-title">{{ $barang[0]->kode}}</h5>
      <h6 class="card-text">{{$barang[0]->nama}}</h6>
      <p class="card-text">{{$barang[0]->deskripsi}}</p>
      <span class="card-text">dibuat :{{$dibuat}} |{{$barang[0]->dibuat_nama}}</span><br>
      <span class="card-text">diperbarui :{{$diperbarui}}|{{$barang[0]->diperbarui_nama}}</span>
    </div>
  </div>
@else
<h5> Data tidak ada</h5>
@endif


@endsection
