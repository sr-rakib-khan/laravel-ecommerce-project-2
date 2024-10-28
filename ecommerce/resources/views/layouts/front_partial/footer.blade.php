    <!--================ start footer Area  =================-->
    @php
    $one_position = DB::table('pages')->where('page_positon', 1)->get();
    $two_position = DB::table('pages')->where('page_positon', 2)->get();
    @endphp

    <footer class="footer-area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-6 single-footer-widget">
                    <h4>About us</h4>
                    <ul>
                        @foreach($one_position as $row)
                        <li><a href="{{route('info', $row->id)}}">{{$row->page_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 single-footer-widget">
                    <h4>Help</h4>
                    <ul>
                        @foreach($two_position as $row)
                        <li><a href="{{route('info', $row->id)}}">{{$row->page_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 single-footer-widget">
                    <h4>Payment us</h4>
                    <ul>
                        <div class="row">
                            <div class="col-md-4">
                                <li><img width="80px" height="50px" src="{{url('public/files/payment/bkash.png')}}" alt=""></li>
                                <li><img width="80px" height="50px" src="{{url('public/files/payment/visa.png')}}" alt=""></li>
                            </div>
                            <div class="col-md-4">
                                <li><img width="80px" height="50px" src="{{url('public/files/payment/nagad.png')}}" alt=""></li>
                                <li><img width="80px" height="50px" src="{{url('public/files/payment/american.png')}}" alt=""></li>
                            </div>
                            <div class="col-md-4">
                                <li><img width="80px" height="50px" src="{{url('public/files/payment/rocket.png')}}" alt=""></li>
                                <li><img width="80px" height="50px" src="{{url('public/files/payment/mastercard.png')}}" alt=""></li>
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 single-footer-widget">
                    <div class="ml-5">
                        <h4>Newsletter</h4>
                        <p>You can trust us. we only send promo offers,</p>
                        <form action="{{route('newsletter')}}" method="post">
                            @csrf
                            <input type="text" class="form-control" name="email">
                            <button type="submit" class="mt-3 ml-5 click-btn btn btn-default">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer-bottom row align-items-center">
                <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved by <span>Confidence Cart</span>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
                <div class="col-lg-4 col-md-12 footer-social">
                    <a href="{{$setting->facebook}}"><i class="fa fa-facebook"></i></a>
                    <a href="{{$setting->twitter}}"><i class="fa fa-twitter"></i></a>
                </div>
            </div>
            <div>
                <p class="text-center mt-5">This Web Application Devloped by <span><strong style="font-size: 15px;">"Rakib Khan"</strong></span></p>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->