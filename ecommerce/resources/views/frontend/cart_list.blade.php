@extends('layouts.front')
@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Cart</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="index.html">Home</a>
                    <a href="cart.html">Cart</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart_list as $row)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img width="60px" src="{{asset('public/files/product/'.$row->options->thumbnail)}}" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <p>{{$row->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>${{$row->price}}</h5>
                            </td>
                            <td>
                                <div class="product_count">
                                    <input type="number" name="qty" id="sst" maxlength="10" value="{{$row->qty}}" data-id="{{$row->rowId}}" title="Quantity:" class="input-text updateqty" />
                                </div>
                            </td>
                            <td>
                                <h5>${{$row->price * $row->qty}}</h5>
                            </td>
                            <td>
                                <a href="{{route('remove.cartitem', $row->rowId)}}" id="removecart">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>${{Cart::subtotal()}}</h5>
                            </td>
                        </tr>
                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn" href="{{route('index')}}">Continue Shopping</a>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="cupon_text">
                                    <a class="main_btn" href="{{route('order.checkout')}}">checkout</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

<!-- ajax link  -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- remvoe cart item ajax code  -->
<script type="text/javascript">
    $(document).on('click', '#removecart', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                $('.cart-count').load(location.href + ' .cart-count');
                $('.cart_area').load(location.href + ' .cart_area');
            }
        });
    });

    // ajax code for cart qty update 
    $(document).on('blur', '.updateqty', function(e) {
        e.preventDefault();
        var qty = $(this).val();
        var rowId = $(this).data("id");
        $.ajax({
            url: '{{url("cart-qty/update/")}}/' + rowId + '/' + qty,
            type: 'get',
            success: function(data) {
                toastr.success(data);
                $('.cart-count').load(location.href + ' .cart-count');
                $('.cart_area').load(location.href + ' .cart_area');

            }
        });
    });
</script>
@endsection