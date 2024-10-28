<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- font awesom icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="img/favicon.png" type="image/png" />
    <title></title>

    <!-- tostr css link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/frontend')}}/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/vendors/linericon/style.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/css/themify-icons.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/css/flaticon.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/vendors/owl-carousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/vendors/lightbox/simpleLightbox.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/vendors/nice-select/css/nice-select.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/vendors/animate-css/animate.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/vendors/jquery-ui/jquery-ui.css" />
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('public/frontend')}}/css/style.css" />
    <link rel="stylesheet" href="{{asset('public/frontend')}}/css/responsive.css" />



</head>

<body>

    @include('layouts.front_partial.header')

    @yield('content')

    @include('layouts.front_partial.footer')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('public/frontend')}}/js/jquery-3.2.1.min.js"></script>
    <script src="{{asset('public/frontend')}}/js/popper.js"></script>
    <script src="{{asset('public/frontend')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('public/frontend')}}/js/stellar.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/isotope/isotope-min.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="{{asset('public/frontend')}}/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/counter-up/jquery.counterup.js"></script>
    <script src="{{asset('public/frontend')}}/js/mail-script.js"></script>
    <script src="{{asset('public/frontend')}}/js/theme.js"></script>
    <script src="{{asset('public/frontend')}}/vendors/jquery-ui/jquery-ui.js"></script>

    <!-- toastr js link  -->
    <script src="{{asset('public/backend')}}/plugins/toastr/toastr.min.js"></script>


    <!-- toastr script -->
    <script type="text/javascript">
        @if(Session::has('message'))
        var type = "{{Session::get('alert-type','info')}}";
        switch (type) {
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;
        }
        @endif
    </script>




</body>

</html>