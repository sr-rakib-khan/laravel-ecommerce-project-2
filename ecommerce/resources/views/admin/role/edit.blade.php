@extends('layouts.admin')
@section('admin_content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Role</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Role</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('update.role')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$role->id}}" name="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="product_name">User Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$role->name}}" placeholder="User name">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="product_name">User Email</label>
                                        <input type="email" name="email" class="form-control" value="{{$role->email}}" placeholder="user email">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="product_name">User Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{$role->phone}}" placeholder="User phone">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="product_name">Role Type</label>
                                        <select name="role_type" class="form-select" id="">
                                            <option @if($role->role_admin == 1) selected @endif value="1">Admin</option>
                                            <option @if($role->role_admin == 0) selected @endif value="0">Non Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>Category</h6>
                                        <input type="checkbox" name="category" value="1" @if($role->category == 1) checked @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Brand</h6>
                                        <input type="checkbox" name="brand" value="1" @if($role->brand == 1) checked @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Product</h6>
                                        <input type="checkbox" name="product" value="1" @if($role->product == 1) checked @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Order</h6>
                                        <input type="checkbox" name="order" value="1" @if($role->order == 1) checked @endif>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <h6>Blog</h6>
                                        <input type="checkbox" name="blog" value="1" @if($role->blog == 1) checked @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Report</h6>
                                        <input type="checkbox" name="report" value="1" @if($role->report == 1) checked @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Settings</h6>
                                        <input type="checkbox" name="settings" value="1" @if($role->settings == 1) checked @endif>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>User Role</h6>
                                        <input type="checkbox" name="userrole" value="1" @if($role->userrole == 1) checked @endif>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <h6>Offer</h6>
                                        <input type="checkbox" name="offer" value="1" @if($role->offer == 1) checked @endif>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>




@endsection