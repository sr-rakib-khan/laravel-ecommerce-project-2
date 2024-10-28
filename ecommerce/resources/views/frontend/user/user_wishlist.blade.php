@extends('layouts.front')
@section('content')

<div class="container" style="margin-top: 50px; margin-bottom:100px;">
    <div class="row">
        @include('frontend.user.user_sidebar')
        <div class="card col-md-8">
            <!--================Wishlist Area =================-->

            <div class="container">
                <div class="cart_inner wishlist-list">
                    <div class="table-responsive">
                        <h3 class="mt-3" style="border-bottom: 1px solid black">My Wishlist</h3>

                        <table class="table">
                            <thead>
                                @if($count_wishlist==0)
                                <p style="font-size: large;" class="mt-5 text-danger ml-5">There is no item in your wishlist</p>
                                @else
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlist as $row)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img width="20%" src="{{url('public/files/product/'.$row->thumbnail)}}" alt="" />
                                            </div>
                                            <div class="media-body">
                                                <a href="{{route('product.details', $row->product_id)}}">
                                                    <p>{{$row->name}}</p>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a id="singlecart" href="{{route('pdsingle.add.cart', $row->product_id)}}" class="btn btn-success btn-sm" id="remove-wishlist">Add to Cart</a>
                                        <a href="{{route('remove.wishlist',$row->id)}}" class="btn btn-success btn-sm" id="remove-wishlist">Remove</a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--================End Cart Area =================-->
        </div>
    </div>
</div>
<!-- ajax cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- remvoe wishlist ajax code  -->
<script type="text/javascript">
    $(document).on('click', '#remove-wishlist', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                $('.wishlist-count').load(location.href + ' .wishlist-count');
                $('.wishlist-list').load(location.href + ' .wishlist-list');
            }
        });
    });
</script>

<!-- product add to cart ajax code  -->
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