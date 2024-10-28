@extends('layouts.front')
@section('content')


<!--================Blog Area =================-->
<section class="blog_area section_gap">
    <div class="container">
        <div class="row">
            @foreach($blog_post as $post_row)
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">

                    @php
                    $comment_count = DB::table('blog_comments')->where('blog_id', $post_row->blog_category_id)->count();
                    @endphp
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img height="300px" class="card-img rounded-0" src="{{asset($post_row->thumbnail)}}" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>{{$post_row->date}}</h3>
                            </a>
                        </div>

                        <div class="blog_details">
                            <a class="d-inline-block" href="{{route('blog.details', $post_row->id)}}">
                                <h2>{{$post_row->blog_title}}</h2>
                            </a>
                            <p>{{$post_row->blog_description_1}}</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="ti-user"></i>{{$post_row->blog_cat_name}}</a></li>
                                <li><a href="#"><i class="ti-comments"></i> {{$comment_count}} Comments</a></li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--================Blog Area =================-->

@endsection