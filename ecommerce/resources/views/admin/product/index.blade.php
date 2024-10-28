@extends('layouts.admin')

@section('admin_content')
<!-- dropify cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{route('product.create')}}" type="button" class="btn btn-primary">
                            +Add new
                        </a>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Product List</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="staticEmail" class="col-form-label">Category</label>
                                <select name="category_id" class="form-select submitable" id="category_id">
                                    <option value="" disabled selected>All</option>
                                    <option value="">None</option>
                                    @foreach($category as $row)
                                    <option value="{{$row->id}}">{{$row->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="staticEmail" class="col-form-label">Brand</label>
                                <select name="brand_id" class="form-select submitable" id="brand_id">
                                    <option disabled selected>All</option>
                                    <option value="">None</option>
                                    @foreach($brand as $row)
                                    <option value="{{$row->id}}">{{$row->brand_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="warehose" class="col-form-label">Status</label>
                                <select name="status" class="form-select submitable" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped ytable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Featured</th>
                                        <th>Inspired Status</th>
                                        <th>Status</th>
                                        <th>Thumbnail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- view product details modal  -->
    <div class="modal fade" id="productviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>


    <!-- eidt product -->
    <div class="modal fade" id="producteditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modal_body">

                </div>
            </div>
        </div>
    </div>

    <!-- ajax cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- dropify js link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




    <script type="text/javascript">
        $(function product() {
            let table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: ({
                    url: "{{route('product.index')}}",
                    data: function(e) {
                        e.category_id = $('#category_id').val();
                        e.brand_id = $('#brand_id').val();
                        e.status = $('#status').val();
                    }

                }),
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'code',
                    name: 'code'
                }, {
                    data: 'category_name',
                    name: 'category_name'
                }, {
                    data: 'brand_name',
                    name: 'brand_name'
                }, {
                    data: 'featured',
                    name: 'featured'
                }, {
                    data: 'inspired_product',
                    name: 'inspired_product'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'thumbnail',
                    name: 'thumbnail',
                    // render: function(data, type, full, meta) {
                    //     return "<img src=\"public/files/product/" + data + "\" height=\"40\" / > "
                    // }
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                }]
            });
        });
    </script>


    <script type="text/javascript">
        //deactive featured
        $(document).ready(function() {
            let table = $('.ytable').DataTable();
            $(document).on('click', '.featured-deactive', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{url('product/not-featured')}}/" + id,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });

            // active featured 
            $(document).on('click', '.featured-active', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{url('product/featured')}}/" + id,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });

            //inspired product no
            $(document).on('click', '.inspired-no', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{url('product/inspired-no')}}/" + id,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });

            //inspired product yes
            $(document).on('click', '.inspired-yes', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{url('product/inspired-yes')}}/" + id,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });

            //status deactive
            $(document).on('click', '.status-deactive', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{url('product/status-deactive')}}/" + id,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });

            //status active
            $(document).on('click', '.status-active', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                $.ajax({
                    url: "{{url('product/status-active')}}/" + id,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });

            // on change yazra datatable reload 
            $(document).on('change', '.submitable', function() {
                $('.ytable').DataTable().ajax.reload();
            });
        });
    </script>

    <!-- product view details with ajax code-->
    <script type="text/javascript">
        $('body').on('click', '.view', function() {
            let url = $(this).attr('href');
            $.get(url, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script>

    <!-- product edit with ajax code-->
    <!-- <script type="text/javascript">
        $('body').on('click', '.edit', function() {
            let url = $(this).attr('href');
            $.get(url, function(data) {
                $("#modal_body").html(data);
            });
        });
    </script> -->




    <script type="text/javascript">
        //deactive featured
        $(document).ready(function() {
            let table = $('.ytable').DataTable();
            $(document).on('click', '.product-delete', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                });
            });

            // on change yazra datatable reload 
            $(document).on('change', '.submitable', function() {
                $('.ytable').DataTable().ajax.reload();
            });
        });
    </script>


    @endsection