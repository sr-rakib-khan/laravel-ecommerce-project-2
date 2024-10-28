@extends('layouts.front')
@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Shop Brands</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="{{route('index')}}">Home</a>
                    <a href="#">Shop</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Brand Product Area =================-->
<section class="cat_product_area section_gap">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <h3>{{$brand_name->brand_name}}</h3>

                <div class="latest_product_inner">
                    <div class="row">
                        @foreach($product as $row)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-product">
                                <div class="product-img">
                                    <img class="card-img" src="{{url('public/files/product/'.$row->thumbnail)}}" alt="" />
                                    <div class="p_icon">
                                        <a href="{{route('product.details', $row->id)}}">
                                            <i class="ti-eye"></i>
                                        </a>
                                        <a id="wishlist" href="{{route('wishlist.add', $row->id)}}">
                                            <i class="ti-heart"></i>
                                        </a>
                                        <a id="singlecart" href="{{route('pdsingle.add.cart', $row->id)}}">
                                            <i class="ti-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-btm">
                                    <a href="#" class="d-block">
                                        <h4>{{$row->name}}</h4>
                                    </a>
                                    <div class="mt-3">
                                        @if($row->discount_price == null)
                                        <span class="mr-4">${{$row->selling_price}}</span>
                                        @else
                                        <span class="mr-4">${{$row->discount_price}}</span>
                                        <del>${{$row->selling_price}}</del>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Browse Categories</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list" style="overflow-y: scroll; height: 300px;">
                                @foreach($category as $row)
                                <li>
                                    <a href="{{route('category.product', $row->id)}}">{{$row->category_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>

                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Product Brand</h3>
                        </div>
                        <div class="widgets_inner">
                            <ul class="list" style="overflow-y: scroll; height: 300px;">
                                @foreach($brand as $row)
                                <li>
                                    <a href="{{route('brand.product', $row->id)}}">{{$row->brand_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Category Product Area =================-->

<!-- ajax cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- add wishlist ajax code  -->
<script type="text/javascript">
    $(document).on('click', '#wishlist', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                $('.wishlist-count').load(location.href + ' .wishlist-count');
            }
        });
    });
</script>

<!-- add single product in cart ajax code  -->
<script type="text/javascript">
    $(document).on('click', '#singlecart', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                $('.cart-count').load(location.href + ' .cart-count');
            }
        });
    });
</script>
@endsection