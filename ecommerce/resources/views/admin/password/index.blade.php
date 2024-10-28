@extends('layouts.admin')

@section('admin_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Password</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="height:500px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <!-- /.card -->
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('admin.password.update')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="old Password" class="form-label">Old Password</label>
                                    <input type="password" name="old_password" class="form-control" id="old password" placeholder="old password">
                                </div>
                                <div class="mb-3">
                                    <label for="new Password" class="form-label">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="new password" placeholder="new password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirm Password" class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" id="confirm password" placeholder="confirm password">
                                </div>
                                <button class="btn btn-success" type="submit">Update Password</button>
                            </form>
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

 
    @endsection