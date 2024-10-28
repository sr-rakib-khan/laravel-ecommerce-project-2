@extends('layouts.front')
@section('content')

<style>
    #social-links {
        margin-top: 50px;
    }

    #social-links ul li {
        display: inline-block;
    }

    #social-links ul li a {
        padding: 15px;
        margin: 2px;
        font-size: 20px;
        color: rgb(46, 41, 114);
        background-color: #ccc;
    }
</style>
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Product Details</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="{{route('index')}}">Home</a>
                    <a href="single-product.html">Product Details</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            @php
            $images = json_decode($product->images, true);
            @endphp
            <div class="col-lg-6">
                <div class="s_product_img">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0">
                                <img width="60px" src="{{url('public/files/product/'.$product->thumbnail)}}" alt="" />
                            </li>
                            @foreach($images as $row)
                            <li data-target="#carouselExampleIndicators" data-slide-to="0">
                                <img width="60px" src="{{url('public/files/product/'.$row)}}" alt="" />
                            </li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{url('public/files/product/'.$product->thumbnail)}}" alt="First slide" />
                            </div>
                            @foreach($images as $row)
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{url('public/files/product/'.$row)}}" alt="Second slide" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{$product->name}}</h3>
                    @if($product->discount_price)
                    <h2>${{$product->discount_price}}</h2>
                    @else
                    <h2>${{$product->selling_price}}</h2>
                    @endif
                    <ul class="list">
                        <li>
                            <a class="active" href="#">
                                <span>Category</span> : {{$product->category_name}}</a>
                        </li>
                        <li>
                            @if($product->stock >0)
                            <a href="{{route('category.product', $product->category_id)}}"> <span>Availibility</span> : In Stock</a>
                            @else
                            <p class="fs-5"> <span>Availibility</span> : Out of stock</p>
                            @endif
                        </li>
                    </ul>
                    <p>
                        {{substr($product->details, 0, 100)}}
                    </p>
                    <div class="product_count">
                        <form action="{{route('product.add.cart')}}" method="post" id="addtocart">
                            @csrf
                            <input type="hidden" name="id" value="{{$product->id}}">
                            <label for="qty">Quantity:</label>
                            <input type="number" name="qty" id="sst" minlength="1" maxlength="12" value="1" title="Quantity:" class="input-text qty" />
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button">
                                <i class="lnr lnr-chevron-up"></i>
                            </button>
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;" class="reduced items-count" type="button">
                                <i class="lnr lnr-chevron-down"></i>
                            </button>
                    </div>
                    <div class="card_area">
                        <!-- <a class="main_btn">Add to Cart</a> -->
                        <button class="main_btn">Add to Cart</button>
                        </form>
                        <a title="add to wishlist" class="icon_btn" id="wishlist" href="{{route('wishlist.add', $product->id)}}">
                            <i class="lnr lnr lnr-heart"></i>
                        </a>
                    </div>
                    {!! Share::page(url()->current(), $product->name)
                    ->facebook()
                    ->twitter()
                    ->linkedin()
                    ->whatsapp(); !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Specification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>
                    {{$product->details}}
                </p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Brands</h5>
                                </td>
                                <td>
                                    <h5>{{$product->brand_name}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Color</h5>
                                </td>
                                <td>
                                    <h5>{{$product->color}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Size</h5>
                                </td>
                                <td>
                                    <h5>{{$product->size}}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Quality checking</h5>
                                </td>
                                <td>
                                    <h5>yes</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Freshness Duration</h5>
                                </td>
                                <td>
                                    <h5>03days</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>When packeting</h5>
                                </td>
                                <td>
                                    <h5>Without touch of hand</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Each Box contains</h5>
                                </td>
                                <td>
                                    <h5>01pcs</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        @foreach($comment as $row)
                        <div class="comment_list mt-2 all-comment">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/product/single-product/review-1.png" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <h4>{{$row->name}}</h4>
                                        <h5>{{$row->created_at}}</h5>
                                        <a id="cmnt-toggle" class="reply_btn" data-comment-id="{{$row->id}}" href="javascript::void(0);">Reply</a>
                                    </div>
                                </div>
                                <p>
                                    {{$row->message}}
                                </p>
                                <div id="cmnt-reply" class="reply_comment mt-2 d-none">
                                    <form id="comment-store" action="{{route('comment.reply')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="comment_id" value="{{$row->id}}">
                                        <input type="hidden" name="product_id" value="{{$row->product_id}}">
                                        <div class="form-group">
                                            <textarea class="form-control" name="comment" id="message" rows="2" placeholder="Message"></textarea>
                                        </div>
                                        <button id="comment-store" type="submit" value="submit" class="btn submit_btn submit-reply">
                                            Reply
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @php
                            $comment_reply = DB::table('comment_replies')->where('comment_id', $row->id)->get();
                            @endphp

                            @foreach($comment_reply as $row)
                            <div class="review_item reply">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/product/single-product/review-2.png" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <h4>{{$row->name}}</h4>
                                        <h5>{{$row->created_at}}</h5>
                                    </div>
                                </div>
                                <p>
                                    {{$row->comment}}
                                </p>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Post a comment</h4>
                            <form class="row contact_form" action="{{route('user.comment')}}" method="post" id="contactForm" novalidate="novalidate">
                                @csrf
                                <div class="col-md-12">
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Full name" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="phone" placeholder="Phone Number" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="2" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn submit_btn">
                                        Submit Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        @php
                        $review_star = DB::table('reviews')->where('product_id', $product->id)->count();

                        $five_star = DB::table('reviews')->where('product_id', $product->id)->where('star', 5)->count();
                        $four_star = DB::table('reviews')->where('product_id', $product->id)->where('star', 4)->count();
                        $three_star = DB::table('reviews')->where('product_id', $product->id)->where('star', 3)->count();
                        $two_star = DB::table('reviews')->where('product_id', $product->id)->where('star', 2)->count();
                        $one_star = DB::table('reviews')->where('product_id', $product->id)->where('star', 1)->count();

                        $review_sum = DB::table('reviews')->where('product_id', $product->id)->sum("star");
                        @endphp
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Overall</h5>
                                    @if($review_star>0)
                                    @if(intval($review_sum/$review_star)==5)
                                    <h4>5.0</h4>
                                    @elseif(intval($review_sum/$review_star)==4)
                                    <h4>4.0</h4>
                                    @elseif(intval($review_sum/$review_star)==3)
                                    <h4>3.0</h4>
                                    @elseif(intval($review_sum/$review_star)==2)
                                    <h4>2.0</h4>
                                    @else
                                    <h4>1.0</h4>
                                    @endif
                                    @endif
                                    <h6>({{$review_star}} Reviews)</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Based on {{$review_star}} Reviews</h3>
                                    <ul class="list">
                                        <li>
                                            <a href="#">5 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> 0{{$five_star}}</a>
                                        </li>
                                        <li>
                                            <a href="#">4 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star text-secondary"></i> 0{{$four_star}}</a>
                                        </li>
                                        <li>
                                            <a href="#">3 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i> 0{{$three_star}}</a>
                                        </li>
                                        <li>
                                            <a href="#">2 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i> 0{{$two_star}}</a>
                                        </li>
                                        <li>
                                            <a href="#">1 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i> 0{{$one_star}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                            @foreach($reviews as $row)
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="" alt="" />
                                    </div>
                                    <div class="media-body">
                                        <h4>{{$row->name}}</h4>

                                        @if($row->star==5)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        @elseif($row->star==4)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        @elseif($row->star==3)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        @elseif($row->star==2)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        @else
                                        <i class="fa fa-star"></i>
                                        @endif
                                    </div>
                                </div>
                                <p>
                                    {{$row->review}}
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Add a Review</h4>
                            <p>Your Rating:</p>
                            <ul class="list">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-star"></i>
                                    </a>
                                </li>
                            </ul>
                            <p>Outstanding</p>
                            <form class="row contact_form" action="{{route('user.review.store')}}" method="post" id="contactForm" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">email</label>
                                        <input type="email" class="form-control" id="email" name="email" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" id="number" name="phone" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="">Review Star</label>
                                    <select name="star" class="form-select" aria-label="Default select example">
                                        <option value="5">Five</option>
                                        <option value="4">Four</option>
                                        <option value="3">Three</option>
                                        <option value="2">Two</option>
                                        <option value="1">One</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Review</label>
                                        <textarea class="form-control" name="review" id="message" rows="3" placeholder="Review"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn submit_btn">
                                        Submit Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->

<!-- ajax cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- laravel share link  -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script src="{{ asset('js/share.js') }}"></script>



<!-- add to cart ajax code  -->
<script type="text/javascript">
    $('#addtocart').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#addtocart')[0].reset();
                $('.cart-count').load(location.href + ' .cart-count');
            }
        });
    });

    // comment store ajax code 
    $('#comment-store').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            data: request,
            success: function(data) {
                toastr.success(data);
                $('#comment-store')[0].reset();
                $('.all-comment').load(location.href + ' .all-comment');
            }
        });
    });
</script>

<!-- comment reply code -->
<script>
    $(document).ready(function() {
        $('.reply_btn').on('click', function() {
            var commentId = $(this).data('comment-id');
            var replyForm = $(this).closest('.comment_list').find('#cmnt-reply');

            if (replyForm.hasClass('d-none')) {
                replyForm.removeClass('d-none');
            } else {
                replyForm.addClass('d-none');
            }
        });

    });
</script>

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
@endsection