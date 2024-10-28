    <!--================ Start Blog Area =================-->
    <section class="blog-area section-gap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="main_title">
                        <h2><span>latest blog</span></h2>
                        <p>Bring called seed first of third give itself now ment</p>
                    </div>
                </div>
            </div>

            <div class="row">
                @php
                $blog = DB::Table('blog_posts')->orderBy('id','DESC')->limit(3)->get();
                @endphp

                @foreach($blog as $row)
                <div class="col-lg-4 col-md-6">
                    <div class="single-blog">
                        <div class="thumb">
                            <img class="img-fluid" src="{{$row->thumbnail}}" alt="">
                        </div>
                        @php
                        $comments_count = DB::table('blog_comments')->where('blog_id', $row->id)->count();
                        @endphp
                        <div class="short_details">
                            <div class="meta-top d-flex">
                                <a href="#">By Admin</a>
                                <a href="#"><i class="ti-comments-smiley"></i>{{$comments_count}} Comments</a>
                            </div>
                            <a class="d-block" href="{{route('blog.details', $row->id)}}">
                                <h4>{{$row->blog_title}}</h4>
                            </a>
                            <div class="text-wrap">
                                <p>
                                    {{$row->blog_description_1}}
                                </p>
                            </div>
                            <a href="{{route('blog.details', $row->id)}}" class="blog_btn">Learn More <span class="ml-2 ti-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--================ End Blog Area =================-->