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
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
                <div class="col-md-10">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('admin.website.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="id" value="{{$setting->id}}" id="">
                                        <input type="hidden" name="old_logo" value="{{$setting->logo}}" id="">
                                        <input type="hidden" name="old_favicon" value="{{$setting->favicon}}" id="">
                                        <div class="form-group">
                                            <label for="phone_one">Phone One</label>
                                            <input type="text" name="phone_one" class="form-control" value="{{$setting->phone_one}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phone Two</label>
                                            <input type="text" name="phone_two" class="form-control" value="{{$setting->phone_two}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Main Email</label>
                                            <input type="text" name="main_email" class="form-control" value="{{$setting->main_email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Support Eamil</label>
                                            <input type="text" name="support_email" class="form-control" value="{{$setting->support_email}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Logo</label>
                                            <input type="file" name="logo" class="form-control">
                                            <img width="40px" src="{{$setting->logo}}" alt="">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Favicon</label>
                                            <input type="file" name="favicon" class="form-control">
                                            <img width="40px" src="{{$setting->favicon}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-4 ml-5">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="address" class="form-control" value="{{$setting->address}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" name="facebook" class="form-control" value="{{$setting->facebook}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Twitter</label>
                                            <input type="text" name="twitter" class="form-control" value="{{$setting->twitter}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Instagram</label>
                                            <input type="text" name="instagram" class="form-control" value="{{$setting->instagram}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Linkedin</label>
                                            <input type="text" name="linkedin" class="form-control" value="{{$setting->linkedin}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Youtube</label>
                                            <input type="text" name="youtube" class="form-control" value="{{$setting->youtube}}">
                                        </div>
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

<!-- ajax cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js" integrity="sha512-J+763o/bd3r9iW+gFEqTaeyi+uAphmzkE/zU8FxY6iAvD3nQKXa+ZAWkBI9QS9QkYEKddQoiy0I5GDxKf/ORBA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
    $('.dropify').dropify();


    $('input[data-bootstrap-switch]').each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    $(document).ready(function() {
        let postURL = "<?php echo url('addmore'); ?>";
        let i = 1;

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="file" accept="image/*" name="images[]" placeholder="enter your name" class="form-control name_list"/></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>')
        });

        $(document).on('click', '.btn_remove', function() {
            let button_id = $(this).attr('id');
            $('#row' + button_id + '').remove();
        });
    });
</script>

<script type="text/javascript">
    // ajax request send for get childcategory
    $('#subcategory_id').change(function() {
        let id = $(this).val();
        $.ajax({
            url: "{{url('/get-child-category/')}}/" + id,
            type: 'get',
            success: function(data) {
                $('select[name="childcategory_id"]').empty();
                $.each(data, function(key, data) {
                    $('select[name="childcategory_id"]').append('<option value="' + data.id + '">' + data.childcategory_name + '</option>');
                });
            }
        });
    });
</script>
@endsection