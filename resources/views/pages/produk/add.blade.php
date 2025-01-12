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
                        <h1 class="m-0">Produk Create</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produk Create
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
                                <h3 class="card-title">Produk Create</h3>
                            </div>
                            <form action="{{route('produk.store')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_produk">Nama Produk</label>
                                        <input type="text" name="nama_produk"
                                            class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk"
                                            placeholder="Masukan Nama Produk">
                                        @error('nama_produk')
                                            <div class="alert" style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga</label>
                                        <input type="text" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" onkeypress="return IsNumericHarga(event);" ondrop = "return false;" onpaste="return false;"
                                            placeholder="Masukan Harga">
                                            <span id="errorHarga" style="color: Red; display: none">* Input Angka 0-9</span>
                                        @error('harga')
                                            <div class="alert" style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id">
                                            <option value="">Pilih Kategori </option>
                                            @foreach ($kategori_list as $item_kategori)
                                                <option value="{{ $item_kategori->nama_kategori }}">
                                                    {{ $item_kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="alert" style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori">Status</label>
                                        <select name="status_id" class="form-control @error('status_id') is-invalid @enderror" id="status_id">
                                            <option value="">Pilih Status</option>
                                            @foreach ($status_list as $item_status)
                                                <option value="{{ $item_status->nama_status }}">
                                                    {{ $item_status->nama_status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <div class="alert" style="color: red;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('produk.index') }}" class="btn btn-danger float-right">Cancel</a>
                                    <button type="submit" class="btn btn-primary swalDefaultSuccess">Submit</button>
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
        var specialKeys = new Array();
        function IsNumericHarga(e) {
            var keyCode = e.which ? e.which : e.keyCode
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            document.getElementById("errorHarga").style.display = ret ? "none" : "inline";
            return ret;
        }
    </script>
@endpush
