@extends('welcome')
@extends('layouts.app', [
    'activePage' => 'List_Produk',
    'title' => __('Tambah Produk'),
])
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $moduleDetails['title'] }} {{ $moduleDetails['type'] }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $moduleDetails['title'] }} {{ $moduleDetails['type'] }}
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $moduleDetails['title'] }} {{ $moduleDetails['type'] }}</h3>
                            </div>
                            <form action="#" method="POST">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Masukan Nama Produk">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" name="harga" class="form-control" id="harga" placeholder="Masukan Harga">
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori_id" id="kategori_id">
                                            <option value="">Pilih </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Status</label>
                                        <select name="status_id" id="status_id">
                                            <option value="">Pilih </option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('javascript')
    <script>

    </script>
@endpush
