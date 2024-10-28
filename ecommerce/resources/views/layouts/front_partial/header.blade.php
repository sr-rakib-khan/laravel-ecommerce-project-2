    <!--================Header Menu Area =================-->
    <header class="header_area">
        <div class="top_menu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="float-left">
                            <p>Phone: {{$setting->phone_one}}</p>
                            <p>email: {{$setting->main_email}}</p>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="float-right">
                            <ul class="right_side">
                                @guest
                                <li>
                                    <a href="{{route('login.page')}}">
                                        Sign in
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('signup.page')}}">
                                        Sign up
                                    </a>
                                </li>
                                @else
                                <li>
                                    <a href="{{route('user.logout')}}">
                                        Logout
                                    </a>
                                </li>
                                @endguest

                                @if(Auth::check())
                                <li>
                                    <a href="{{route('order.truck')}}">
                                        track order
                                    </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{route('contact.index')}}">
                                        Contact Us
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main_menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light w-100">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html">
                        <!-- <img width="250" height="100" src="" alt="" /> -->
                        <h1 class="text-success" style="font-family: sans-serif;">Confidence Cart</h1>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
                        <div class="row w-100 mr-0">
                            <div class="col-lg-8 pr-0">
                                <ul class="nav navbar-nav center_nav pull-right">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('index')}}">Home</a>
                                    </li>
                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('shop.category')}}">Shop Category</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('order.checkout')}}">Product Checkout</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('cart.list')}}">Shopping Cart</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category</a>
                                        <ul class="dropdown-menu">
                                            @php
                                            $category = DB::table('categories')->get();
                                            @endphp
                                            @foreach($category as $row)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('category.product', $row->id)}}">{{$row->category_name}}</a>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </li>

                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Brands</a>
                                        <ul class="dropdown-menu">
                                            @php
                                            $brand = DB::table('brands')->get();
                                            @endphp

                                            @foreach($brand as $row)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{route('brand.product', $row->id)}}">{{$row->brand_name}}</a>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('blog.index')}}">Blog</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('contact.index')}}">Contact</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-4 pr-0 mt-2">
                                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                                    <li class="nav-item">
                                        <li class="nav-item submenu dropdown">
                                            <a href="#" class="nav-link dropdown-toggle icons" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="ti-search" style="font-size: 18px" aria-hidden="true"></i></a>
                                            <ul class="dropdown-menu" style="width: 300px">
                                              
                                                <li class="nav-item">
                                                    <div class="blog_right_sidebar">
                                                        <aside class="single_sidebar_widget search_widget">
                                                            <form action="{{route('srarch.product')}}" method="post">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" name="search" class="form-control" placeholder="Search by product name">
                                                                        <div class="input-group-append">
                                                                            <button class="btn" type="button"><i class="ti-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <button class="main_btn rounded-0 w-100" type="submit">Search</button>
                                                            </form>
                                                        </aside>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </li>

                                    <li class="nav-item cart-count">
                                        <a href="{{route('cart.list')}}" class="icons">
                                            <i class="ti-shopping-cart">
                                                <sup>{{Cart::count()}}</sup>
                                            </i>
                                        </a>
                                    </li>
                                    @php
                                    $wishlist_count = DB::table('wishlists')->where('user_id', auth()->id())->count();
                                    @endphp
                                    <li class="nav-item wishlist-count">
                                        <a href="{{route('my.wishlist')}}" class="icons">
                                            <i class="ti-heart" aria-hidden="true">
                                                <sup>{{$wishlist_count}}</sup>
                                            </i>
                                        </a>
                                    </li>
                                    @if(Auth::check())
                                    <li class="nav-item">
                                        <a href="{{route('user.dashboard')}}" class="icons">
                                            <i class="ti-user" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!--================Header Menu Area =================-->