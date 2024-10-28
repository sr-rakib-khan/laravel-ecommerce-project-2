@extends('layouts.front')
@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area mb-40">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content row">
                <div class="col-lg-12">
                    <p class="sub text-uppercase">men Collection</p>
                    <h3><span>Show</span> Your <br />Personal <span>Style</span></h3>
                    <h4 class="text-dark">Fowl saw dry which a above together place.</h4>
                    <a class="main_btn mt-40" href="#view">View Collection</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->


<!-- Start feature Area -->
<section class="feature-area section_gap_bottom_custom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-money"></i>
                        <h3>Money back gurantee</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-truck"></i>
                        <h3>Free Delivery</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-support"></i>
                        <h3>Alway support</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="single-feature">
                    <a href="#" class="title">
                        <i class="flaticon-blockchain"></i>
                        <h3>Secure payment</h3>
                    </a>
                    <p>Shall open divide a one</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End feature Area -->



<!--================ Feature Product Area =================-->
<section id="view" class="feature_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Featured product</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($featured as $row)
            <div class="col-lg-4 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{url('public/files/product/'.$row->thumbnail)}}" alt="" />
                        <div class="p_icon">
                            <a href="{{route('product.details', $row->id)}}">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="{{route('wishlist.add', $row->id)}}" id="wishlist">
                                <i class="ti-heart"></i>
                            </a>
                            <a id="singlecart" href="{{route('pdsingle.add.cart', $row->id)}}">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="{{route('product.details', $row->id)}}" class="d-block">
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
</section>
<!--================ End Feature Product Area =================-->


<!--================ Offer Area =================-->
<section class="offer_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-lg-4 col-lg-6 text-center">
                <div class="offer_content">
                    <h3 class="text-uppercase mb-40">all men’s collection</h3>
                    <h2 class="text-uppercase">50% off</h2>
                    <p class="mt-3">Limited Time Offer</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ End Offer Area =================-->


<!--================ New Product Area =================-->
<section class="new_product_area section_gap_top section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>new products</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="new_product">
                    <h5 class="text-uppercase">collection of </h5>
                    <h3 class="text-uppercase">Men’s summer t-shirt</h3>
                    <div class="product-img">
                        <img class="img-fluid" src="{{url('public/files/product/'.$summer_season_product->thumbnail)}}" alt="" />
                    </div>
                    <a href="{{route('product.details', $summer_season_product->id)}}" class="d-block text-light">
                        <h4>{{$summer_season_product->name}}</h4>
                    </a>
                    <h4>${{$summer_season_product->selling_price}}</h4>
                    <a id="singlecart" href="{{route('pdsingle.add.cart', $summer_season_product->id)}}" class="main_btn">Add to cart</a>
                </div>
            </div>

            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="row">
                    @foreach($newproduct as $row)
                    <div class="col-lg-6 col-md-6">
                        <div class="single-product">
                            <div class="product-img">
                                <img class="img-fluid w-100" src="{{url('public/files/product/'.$row->thumbnail)}}" alt="" />
                                <div class="p_icon">
                                    <a href="{{route('product.details', $row->id)}}">
                                        <i class="ti-eye"></i>
                                    </a>
                                    <a href="{{route('wishlist.add', $row->id)}}" id="wishlist">
                                        <i class="ti-heart"></i>
                                    </a>
                                    <a id="singlecart" href="{{route('pdsingle.add.cart', $row->id)}}">
                                        <i class="ti-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-btm">
                                <a href="{{route('product.details', $row->id)}}" class="d-block">
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
    </div>
</section>
<!--================ End New Product Area =================-->

<!--================ Inspired Product Area =================-->
<section class="inspired_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Inspired products</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($inspired as $row)
            <div class="col-lg-3 col-md-6">
                <div class="single-product">
                    <div class="product-img">
                        <img class="img-fluid w-100" src="{{url('public/files/product/'.$row->thumbnail)}}" alt="" />
                        <div class="p_icon">
                            <a href="{{route('product.details', $row->id)}}">
                                <i class="ti-eye"></i>
                            </a>
                            <a href="{{route('wishlist.add', $row->id)}}" id="wishlist">
                                <i class="ti-heart"></i>
                            </a>
                            <a id="singlecart" href="{{route('pdsingle.add.cart', $row->id)}}">
                                <i class="ti-shopping-cart"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-btm">
                        <a href="{{route('product.details', $row->id)}}" class="d-block">
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
</section>
<!--================ End Inspired Product Area =================-->

@include('layouts.front_partial.blog_part')

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