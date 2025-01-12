@extends('welcome')
@extends('layouts.app', [
    'activePage' => 'List_Produk_Sell',
    'title' => __('List Produk Sell'),
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $moduleDetails['title'] }} {{ $moduleDetails['type'] }}</h3>
                                <a href="{{ route('produk.create') }}" class="btn btn-success btn-sm float-right">Tambah</a>
                            </div>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produk as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_produk }}</td>
                                                <td>Rp {{ currencyFormat($item->harga) }}</td>
                                                <td>{{ $item->kategori_id }}</td>
                                                <td>{{ $item->status_id }}</td>
                                                <td>
                                                    <a href="{{route('produk.edit',$item->id_produk)}}" class="btn btn-block btn-primary btn-sm">Edit</a>
                                                    <a href="{{route('produk.delete',$item->id_produk)}}" onclick="return confirm('Apakah anda yakin ingin menghapus ?')" class="btn btn-block btn-danger btn-sm">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('javascript')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": 10000,
            }
            toastr.success("{{ session('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "timeOut": 10000,
            }
            toastr.error("{{ session('error') }}");
        @endif
    </script>
@endpush
