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
                    <h1>Update Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">update product</li>
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
                            <h3 class="card-title">Update Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$product->thumbnail}}" name="old_thumbnail">
                            <input type="hidden" value="{{$product->images}}" name="old_images">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="hidden" name="id" value="{{$product->id}}" id="">
                                        <div class="form-group">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" name="product_name" class="form-control" value="{{$product->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select id="category_id" name="category" class="form-select">
                                                @foreach($category as $row)
                                                <option @if($row->id == $product->category_id) selected @endif value="{{$row->id}}">{{$row->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <select class="select2" name="unit" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option @if($product->unit == 'pcs') selected @endif value="pcs">pcs</option>
                                                <option @if($product->unit == 'Dozon') selected @endif value="Dozon">Dozon</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Buying Price</label>
                                            <input type="text" name="buying_price" class="form-control" value="{{$product->buying_price}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Featured Product</label>
                                            <select class="form-select" name="featured" style="width: 100%;">
                                                <option @if($product->featured == '1') selected @endif value="1">Yes</option>
                                                <option @if($product->featured == '0') selected @endif value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Seasonal Status</label>
                                            <select class="form-select" name="season_status" style="width: 100%;">
                                                <option @if($product->season_status == 'summer') selected @endif value="1">Summer</option>
                                                <option @if($product->season_status == 'winter') selected @endif value="0">Winter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Product Code</label>
                                            <input type="text" name="code" class="form-control" value="{{$product->code}}" placeholder="product code">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Brand</label>
                                            <select id="category_id" name="brand" class="form-select">
                                                @foreach($brand as $row)
                                                <option @if($row->id == $product->brand_id) selected @endif value="{{$row->id}}">{{$row->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tag</label>
                                            <select class="select2" name="tag" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option @if($product->tag == 'shirt') selected @endif value="shirt">shirt</option>
                                                <option @if($product->tag == 't-shirt') selected @endif value="t-shirt">t-shirt</option>
                                                <option @if($product->tag == 'pant') selected @endif value="pant">pant</option>
                                                <option @if($product->tag == 'jeans pant') selected @endif value="jeans pant">jeans pant</option>
                                                <option @if($product->tag == 'three quatar pant') selected @endif value="three quatar pant">three quatar pant</option>
                                                <option @if($product->tag == 'Shoe') selected @endif value="Shoe">Shoe</option>
                                                <option @if($product->tag == 'casual shoe') selected @endif value="casual shoe">casual shoe</option>
                                                <option @if($product->tag == 'sliper') selected @endif value="sliper">sliper</option>
                                                <option @if($product->tag == 'polo shirt') selected @endif value="polo shirt">polo shirt</option>
                                                <option @if($product->tag == 'kedgs') selected @endif value="kedgs">kedgs</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Selling Price</label>
                                            <input type="text" name="selling_price" class="form-control" value="{{$product->selling_price}}">
                                        </div>
                                        <div class="form-group">
                                            <label>inspired Product</label>
                                            <select class="form-select" name="inspired" style="width: 100%;">
                                                <option @if($product->inspired_product == 1) selected @endif value="1">Yes</option>
                                                <option @if($product->inspired_product == 0) selected @endif value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Color</label>
                                            <select class="select2" name="color" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option @if($product->color == "Red") selected @endif value="Red">Red</option>
                                                <option @if($product->color == "Black") selected @endif>Black</option>
                                                <option @if($product->color == "White") selected @endif>White</option>
                                                <option @if($product->color == "Pink") selected @endif>Pink</option>
                                                <option @if($product->color == "Blue") selected @endif>Blue</option>
                                                <option @if($product->color == "Navy Blue") selected @endif>Navy Blue</option>
                                                <option @if($product->color == "Sky Blue") selected @endif>Sky Blue</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Size</label>
                                            <select class="select2" name="size" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                <option @if($product->size == 'M') selected @endif value="M">M</option>
                                                <option @if($product->size == 'L') selected @endif value="L">L</option>
                                                <option @if($product->size == 'XL') selected @endif value="XL">XL</option>
                                                <option @if($product->size == 'XXL') selected @endif value="XXL">XXL</option>
                                                <option @if($product->size == 'L39') selected @endif value="39">39</option>
                                                <option @if($product->size == '40') selected @endif value="40">40</option>
                                                <option @if($product->size == '41') selected @endif value="41">41</option>
                                                <option @if($product->size == '42') selected @endif value="42">42</option>
                                                <option @if($product->size == '43') selected @endif value="43">43</option>
                                                <option @if($product->size == '6') selected @endif value="6">6</option>
                                                <option @if($product->size == '7') selected @endif value="7">7</option>
                                                <option @if($product->size == '8') selected @endif value="8">8</option>
                                                <option @if($product->size == '9') selected @endif value="9">9</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Stock Quantity</label>
                                            <input type="text" name="stock" class="form-control" value="{{$product->stock}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="buyingprice">Discount Price</label>
                                            <input type="text" name="discount_price" class="form-control" value="{{$product->discount_price}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-select" name="status" style="width: 100%;">

                                                <option @if($product->status == 1) selected @endif value="1">Active</option>
                                                <option @if($product->status == 0) selected @endif value="0">Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="tags">Main Thumbnail</label>
                                        <input type="file" accept="image/*" class="form-control" name="thumbnail">
                                        <br>
                                        <img width="100px" src="{{url('public/files/product/'.$product->thumbnail)}}" alt="">
                                    </div>
                                    <div class="">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <div class="card-header">
                                                <h3 class="card-title text-bold">More Images(click add for more images)</h3>
                                            </div>
                                            @php
                                            $images = json_decode($product->images, true);
                                            @endphp
                                            <tr>
                                                <td><input type="file" accept="image/*" name="images[]" class="form-control name_lsit"></td>
                                                <td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
                                            </tr>
                                        </table>
                                        @foreach($images as $image)
                                        <img width="100px" src="{{url('public/files/product/'. $image)}}" alt="">
                                        @endforeach
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">Product Details</label>
                                        <textarea class="form-control" name="details" id="exampleFormControlTextarea1" rows="3">{{$product->details}}</textarea>
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
    // $('#subcategory_id').change(function() {
    //     let id = $(this).val();
    //     $.ajax({
    //         url: "{{url('/get-child-category/')}}/" + id,
    //         type: 'get',
    //         success: function(data) {
    //             $('select[name="childcategory_id"]').empty();
    //             $.each(data, function(key, data) {
    //                 $('select[name="childcategory_id"]').append('<option value="' + data.id + '">' + data.childcategory_name + '</option>');
    //             });
    //         }
    //     });
    // });
</script>
@endsection