@extends('template/index')
@section('konten')
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link {{(Request::segment(2)=='barangtrash')? 'active':''}}" href="{{route('mastertrash-barang')}}">Barang</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{(Request::segment(2)=='kategoritrash')? 'active':''}}" href="{{route('mastertrash-kategori')}}">Kategori</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{(Request::segment(2)=='gudangtrash')? 'active':''}}" href="{{route('mastertrash-gudang')}}">Gudang</a>
    </li>
  </ul>
  <div class="tab-content p-4">
    @yield('master-konten')
  </div>
@endsection
