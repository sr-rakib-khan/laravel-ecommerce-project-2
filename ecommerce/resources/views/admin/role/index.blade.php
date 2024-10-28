@extends('layouts.admin')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{route('create.role')}}" class="btn btn-primary">
                            +create new Role
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
                            <h3 class="card-title">All Role List here</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($role as $key=>$row)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->email}}</td>
                                        <td>
                                            @if($row->category == 1) <span class="badge badge-success">category</span> @endif
                                            @if($row->brand == 1) <span class="badge badge-success">brand</span> @endif
                                            @if($row->product == 1) <span class="badge badge-success">product</span> @endif
                                            @if($row->order == 1) <span class="badge badge-success">order</span> @endif
                                            @if($row->offer == 1) <span class="badge badge-success">offer</span> @endif
                                            @if($row->blog == 1) <span class="badge badge-success">blog</span> @endif
                                            @if($row->report == 1) <span class="badge badge-success">report</span> @endif
                                            @if($row->settings == 1) <span class="badge badge-success">settings</span> @endif
                                            @if($row->userrole == 1) <span class="badge badge-success">userrole</span> @endif

                                        </td>
                                        <td>
                                            <a href="{{route('role.edit', $row->id)}}" class="btn btn-info btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="{{route('role.delete', $row->id)}}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
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

    <!-- ajax cdn link  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @endsection