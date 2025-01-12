@extends('welcome')
@extends('layouts.app',[
    'activePage'    => 'Dashboard',
    'title'         => __('Dashboard')
    ])
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$moduleDetails['title']}} {{$moduleDetails['type']}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{$moduleDetails['title']}} {{$moduleDetails['type']}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$produk_list}}</h3>

                                <p>Produk</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$count_produk_sell}}</h3>

                                <p>Produk Bisa Dijual</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$count_produk_not_sell}}</h3>

                                <p>Produk Tidak Bisa Dijual</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Produk List</h3>
                            </div>
                            <div class="card-body">
                                @include('sweetalert::alert')
                                <div class="row float-right">
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="col-sm-4" for="filter_status">Filter:</label>
                                            <div class="col-md-8">
                                                <select class="form-control" id="statusFilter">
                                                    <option>Semua</option>
                                                    <option value="tidak bisa dijual">tidak bisa dijual</option>
                                                    <option value="bisa dijual">bisa dijual</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> &nbsp;
                                    <a href="{{ route('produk.create') }}"><button type="button" class="btn btn-success float-right">Create</button></a>
                                </div>
                                <br>
                                <br><br>
                                <table id="ProdukTable" class="table table-bordered table-hover">
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
        $(function () {
            $('#ProdukTable').DataTable({
            "processing": true,
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            ajax: "{{ route('produk.listAjax') }}",
            columns: [
                    {
                        "data": "id_produk",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'harga',
                        name: 'harga',
                    },
                    {
                        data: 'kategori_id',
                        name: 'kategori_id',
                    },
                    {
                        data: 'status_id',
                        name: 'status_id',
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });

        $(document).ready(function() {
            $('#statusFilter').change(function() {
                var status_id = $(this).val();
                loadData(status_id);
            });
            function loadData(status_id) {
                var url = "{{ route('produk.listAjax') }}";
                url = url + "?status_id=" + status_id;
                $('#ProdukTable').DataTable().ajax.url(url).load();
            }
        });
        function confirmDelete(event, productId) {
            event.preventDefault(); // Mencegah link untuk melakukan aksi default
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data produk ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke URL penghapusan produk jika user mengonfirmasi
                    window.location.href = '{{ route('produk.delete', '') }}/' + productId;
                }
            });
        }
       @if (session('success'))
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: {{ session('success') }},
                showConfirmButton: false,
                timer: 1500
            })
        @endif
        @if(session('errors'))
            <script>
                Swal.fire({
                    icon: 'errors',
                    title: 'Errors',
                    text: '{{ session('errors') }}',
                });
            </script>
        @endif
    </script>
@endpush