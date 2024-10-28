@extends('layouts.admin')
@section('admin_content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Mail Setting</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3"></div>
                <div class="card card-primary col-md-6">
                    <div class="card-header">
                        <h3 class="card-title">Your Mail Settings</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('admin.mail.update')}}">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="mail_id" value="{{$mail->id}}">
                            <div class="form-group">
                                <label for="meta_title">Mailer Email</label>
                                <input type="text" name="mailer" value="{{$mail->mailer}}" class="form-control" id="meta_title" placeholder="mail mailer example:smtp">
                            </div>
                            <div class="form-group">
                                <label for="meta author">Mail Host</label>
                                <input type="text" name="host" class="form-control" value="{{$mail->host}}" id="mail host" placeholder="Enter mail host">
                            </div>
                            <div class="form-group">
                                <label for="meta_tag">Mail Port</label>
                                <input type="text" name="port" class="form-control" value="{{$mail->port}}" id="mail_port" placeholder="Enter mail port">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Mail username</label>
                                <input type="text" class="form-control" name="user_name" value="{{$mail->user_name}}">
                            </div>
                            <div class="form-group">
                                <label for="meta_description">Mailer name</label>
                                <input type="text" class="form-control" name="mailer_name" value="{{$mail->mailer_name}}">
                            </div>
                            <div class="form-group">
                                <label for="meta_keyword">Mail Password</label>
                                <input type="text" value="{{$mail->password}}" name="password" class="form-control" id="mail_password" placeholder="Enter mail password">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update
                                Mail Settings</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection