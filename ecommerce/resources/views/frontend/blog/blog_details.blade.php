@extends('layouts.front')
@section('content')
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Blog Details</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="{{route('index')}}">Home</a>
                    <a href="{{route('blog.index')}}">Blog </a>
                    <a href="">Blog Details</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="{{asset($single_blog->thumbnail)}}" alt="">
                    </div>
                    <div class="blog_details">
                        <h2>{{$single_blog->blog_title}}</h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="ti-user"></i>{{$single_blog->blog_cat_name}}</a></li>
                            <li><a href="#"><i class="ti-comments"></i>{{$comment_count}} Comments</a></li>
                        </ul>
                        <p class="excert">
                            {{$single_blog->blog_description_1}}
                        </p>
                        <p>
                            {{$single_blog->blog_description_2}}
                        </p>
                        <div class="quote-wrapper">
                            <div class="quotes">
                                {{$single_blog->blog_description_3}}
                            </div>
                        </div>


                        <p>
                            {{$single_blog->blog_description_4}}

                        </p>
                    </div>
                </div>
                <div class="navigation-top">
                    <div class="d-sm-flex justify-content-between text-center">

                        <ul class="social-icons">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                            <li><a href="#"><i class="ti-dribbble"></i></a></li>
                            <li><a href="#"><i class="ti-wordpress"></i></a></li>
                        </ul>
                    </div>
                </div>


                <div class="comments-area">
                    <h4>{{$comment_count}} Comments</h4>
                    @foreach($blog_comment as $row)
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="desc">
                                    <p class="comment">
                                        {{$row->comment}}
                                    </p>

                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <h5>
                                                <a href="#">{{$row->name}}</a>
                                            </h5>
                                            <p class="date">{{$row->created_at}} </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{$blog_comment->links()}}
                <div class="comment-form">
                    <h4>Leave a Comment</h4>
                    <form class="form-contact comment_form" action="{{route('blog_comment.store')}}" id="commentForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="blog_id" value="{{$single_blog->id}}">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="main_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="#">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search Keyword">
                                    <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="main_btn rounded-0 w-100" type="submit">Search</button>
                        </form>
                    </aside>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <ul class="list cat-list">
                            @foreach($blog_category as $row)
                            <li>
                                <a href="#" class="d-flex">
                                    <p>{{$row->blog_cat_name}}</p>
                                    <p>(37)</p>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </aside>

                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent Post</h3>
                        @foreach($recent_post as $row)
                        <div class="media post_item">
                            <img width="40px" src="{{asset($row->thumbnail)}}" alt="post">
                            <div class="media-body">
                                <a href="{{route('blog.details', $row->id)}}">
                                    <h3>{{$row->blog_title}}</h3>
                                </a>
                                <p>{{$row->date}}</p>
                            </div>
                        </div>
                        @endforeach

                    </aside>
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            <li>
                                <a href="#">project</a>
                            </li>
                            <li>
                                <a href="#">love</a>
                            </li>
                            <li>
                                <a href="#">technology</a>
                            </li>
                            <li>
                                <a href="#">travel</a>
                            </li>
                            <li>
                                <a href="#">restaurant</a>
                            </li>
                            <li>
                                <a href="#">life style</a>
                            </li>
                            <li>
                                <a href="#">design</a>
                            </li>
                            <li>
                                <a href="#">illustration</a>
                            </li>
                        </ul>
                    </aside>


                    <aside class="single_sidebar_widget instagram_feeds">
                        <h4 class="widget_title">Instagram Feeds</h4>
                        <ul class="instagram_row flex-wrap">
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="img/instagram/widget-i1.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="img/instagram/widget-i2.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="img/instagram/widget-i3.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="img/instagram/widget-i4.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="img/instagram/widget-i5.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img class="img-fluid" src="img/instagram/widget-i6.png" alt="">
                                </a>
                            </li>
                        </ul>
                    </aside>


                    <aside class="single_sidebar_widget newsletter_widget">
                        <h4 class="widget_title">Newsletter</h4>

                        <form action="#">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <button class="main_btn rounded-0 w-100" type="submit">Subscribe</button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->
@endsection