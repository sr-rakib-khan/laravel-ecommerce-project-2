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
                    <h1>New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Add product</li>
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
                            <h3 class="card-title">Add new product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="product_name" class="form-control" value="{{old('product_name')}}" placeholder="product name">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select id="category_id" name="category" class="form-select">
                                                @foreach($category as $row)
                                                <option value="{{$row->id}}">{{$row->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select class="select2" name="unit" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option>pcs</option>
                                                <option>Dozon</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Buying Price</label>
                                            <input type="text" name="buying_price" class="form-control" value="{{old('buying_price')}}" placeholder="buying price">
                                        </div>
                                        <div class="form-group">
                                            <label>Featured Product</label>
                                            <select class="form-select" name="featured" style="width: 100%;">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Seasonal Status</label>
                                            <select class="form-select" name="season_status" style="width: 100%;">
                                                <option value="summer">Summer</option>
                                                <option value="winter">Winter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Product Code</label>
                                            <input type="text" name="code" class="form-control" value="{{old('code')}}" placeholder="product code">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Brand</label>
                                            <select id="brand_id" name="brand" class="form-select">
                                                @foreach($brand as $row)
                                                <option value="{{$row->id}}">{{$row->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tag</label>
                                            <select class="select2" name="tag" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option>shirt</option>
                                                <option>t-shirt</option>
                                                <option>pant</option>
                                                <option>jeans pant</option>
                                                <option>three quatar pant</option>
                                                <option>Shoe</option>
                                                <option>casual shoe</option>
                                                <option>sliper</option>
                                                <option>polo shirt</option>
                                                <option>kedgs</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control" value="{{old('buying_price')}}" placeholder="Selling price">
                                        </div>
                                        <div class="form-group">
                                            <label>inspired Product</label>
                                            <select class="form-select" name="inspired" style="width: 100%;">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <select class="select2" name="color" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option>Red</option>
                                                <option>Black</option>
                                                <option>White</option>
                                                <option>Pink</option>
                                                <option>Blue</option>
                                                <option>Navy Blue</option>
                                                <option>Sky Blue</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Size</label>
                                            <select class="select2" name="size" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option>M</option>
                                                <option>L</option>
                                                <option>XL</option>
                                                <option>XXL</option>
                                                <option>39</option>
                                                <option>40</option>
                                                <option>41</option>
                                                <option>42</option>
                                                <option>43</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Stock Quantity</label>
                                            <input type="text" name="stock" class="form-control" value="{{old('buying_price')}}" placeholder="Discount price">
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control" value="{{old('discount_price')}}" placeholder="Discount price">
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-select" name="status" style="width: 100%;">
                                                <option value="1">Active</option>
                                                <option value="0">Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Main Thumbnail</label>
                                        <input type="file" accept="image/*" class="form-control" name="thumbnail">
                                    </div>
                                    <div class="">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <div class="card-header">
                                                <h3 class="card-title text-bold">More Images(click add for more images)</h3>
                                            </div>
                                            <tr>
                                                <td><input type="file" accept="image/*" name="images[]" class="form-control name_lsit"></td>
                                                <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Product Details</label>
                                        <textarea class="form-control" name="details" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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