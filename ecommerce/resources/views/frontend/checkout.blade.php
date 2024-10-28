@extends('layouts.front')
@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Product Checkout</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="index.html">Home</a>
                    <a href="checkout.html">Product Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->
<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="cupon_area">
            <div class="check_title">
                <h2>
                    Have a coupon?
                </h2>
            </div>
            <form action="{{route('apply.coupon')}}" method="post">
                @csrf
                <input type="text" placeholder="Enter coupon code" name="coupon" />
                <button type="submit" class="tp_btn">Apply Coupon</button>
            </form>
        </div>
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Billing Details/Shipping Address</h3>
                    <form class="row contact_form" action="{{route('order.placed')}}" method="post">
                        @csrf
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="first" name="f_name" placeholder="first name" required />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="last" name="l_name" placeholder="last name" required />
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="company" name="company" placeholder="Company name" required />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="number" name="number" placeholder="phone number" required />
                        </div>
                        <div class="col-md-6 form-group p_star">
                            <input type="text" class="form-control" id="email" name="email" placeholder="email" required />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" name="country" class="form-control" id="country" placeholder="country" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="address" name="address" placeholder="address" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="city" />
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="district" name="district" placeholder="District" />
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" />
                        </div>
                        <div class="col-md-12 ml-3">
                            <h3>Payment Type</h3>
                            <div class="row">
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="payment_type" value="cash on delivery">
                                    <label class="form-check-label" for="cashondelivery">
                                        Cash On Delivery
                                    </label>
                                </div>
                                <div class="form-check col-md-4">
                                    <input class="form-check-input" type="radio" name="payment_type" value="mobile banking">
                                    <label class="form-check-label" for="mobilebanking">
                                        Bkash/Nagad
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ml-3 mt-3">
                            <button class="btn btn-success" type="submit">Order Placed</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Your Order</h2>
                        <ul class="list">
                            <li>
                                <a href="#">Product
                                    <span>Total</span>
                                </a>
                            </li>
                            @foreach($cart_item as $row)
                            <li>
                                <a href="#">{{$row->name}}
                                    <span class="middle">x {{$row->qty}}</span>
                                    <span class="last">${{$row->price * $row->qty}}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        <ul class="list list_2">
                            <li>
                                <a href="#">Subtotal
                                    <span>${{Cart::subtotal()}}</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">Shipping
                                    <span>Flat rate: $00.00</span>
                                </a>
                            </li>
                            @if(Session::has('coupon'))
                            <li>
                                <a href="#">Coupon discount
                                    <span>{{Session::get('coupon')['discount']}}</span>
                                </a>
                            </li>
                            @endif

                            @if(Session::has('coupon'))
                            <li>
                                <a href="#">Total
                                    <span>${{Session::get('coupon')['after_discount_price']}}</span>
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="#">Total
                                    <span>${{Cart::subtotal()}}</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

@endsection