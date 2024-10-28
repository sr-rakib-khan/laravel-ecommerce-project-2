@extends('layouts.front')
@section('content')

<!--================ Feature Product Area =================-->
<section id="view" class="feature_product_area section_gap_bottom_custom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="main_title">
                    <h2><span>Your Search Product</span></h2>
                    <p>Bring called seed first of third give itself now ment</p>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($search_product as $row)
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