@extends('layouts.front')
@section('content')

<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content d-md-flex justify-content-between align-items-center">
                <div class="mb-3 mb-md-0">
                    <h2>Blog</h2>
                    <p>Very us move be blessed multiply night</p>
                </div>
                <div class="page_link">
                    <a href="{{route('index')}}">Home</a>
                    <a href="{{route('blog.index')}}">Blog </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Blog Area =================-->
<section class="blog_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @foreach($blog_post as $post_row)

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
                    @endforeach
                    {{-- <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">
                                        <span class="ti-arrow-left"></span>
                                    </span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <span aria-hidden="true">
                                        <span class="ti-arrow-right"></span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </nav> --}}
                </div>
                {{ $blog_post->links() }}
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="{{route('blog.search')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="blog_search" class="form-control" placeholder="Search Keyword">
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
                            @foreach($blog_cat as $row)
                            @php
                            $category_count = DB::table('blog_categories')->where('id', $row->id)->count();
                            @endphp
                            <li>
                                <a href="" class="d-flex">
                                    <p>{{$row->blog_cat_name}}</p>
                                    <p>({{$category_count}})</p>
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
                                <a href="single-blog.html">
                                    <h3>{{$row->blog_title}}</h3>
                                </a>
                                <p>{{$row->date}}</p>
                            </div>
                        </div>
                        @endforeach

                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->

@endsection