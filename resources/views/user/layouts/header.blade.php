<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Caltimes</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="" />

<!-- Facebook and Twitter integration -->
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:url" content=""/>
<meta property="og:site_name" content=""/>
<meta property="og:description" content=""/>
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400" rel="stylesheet">
<!-- Animate.css -->
<link rel="stylesheet" href="{{asset('user/css/animate.css')}}">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="{{asset('user/css/icomoon.css')}}">
<!-- Bootstrap  -->
<link rel="stylesheet" href="{{asset('user/css/bootstrap.css')}}">

<!-- Magnific Popup -->
<link rel="stylesheet" href="{{asset('user/css/magnific-popup.css')}}">

<!-- Owl Carousel -->
<link rel="stylesheet" href="{{asset('user/css/owl.carousel.min.css')}}">

<link rel="stylesheet" href="{{asset('user/css/owl.theme.default.min.css')}}">

<!-- Theme style  -->
<link rel="stylesheet" href="{{asset('user/css/style.css')}}">

<link rel="stylesheet" href="{{asset('user/css/mycss.css')}}">

<!-- jQuery -->
<script src="{{ asset('user/js/jquery.min.js')}}"></script>

<script src="{{ asset('user/js/jquery.pjax.js')}}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('user/js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('user/js/bootstrap.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{ asset('user/js/jquery.waypoints.min.js')}}"></script>
<!-- Stellar Parallax -->
<script src="{{ asset('user/js/jquery.stellar.min.js')}}"></script>
<!-- YTPlayer -->
<script src="{{ asset('user/js/jquery.mb.YTPlayer.min.js')}}"></script>
<!-- Owl carousel -->
<script src="{{ asset('user/js/owl.carousel.min.js')}}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('user/js/jquery.magnific-popup.min.js')}}"></script>

<script src="{{ asset('user/js/magnific-popup-options.js')}}"></script>
<!-- Counters -->
<script src="{{ asset('user/js/jquery.countTo.js')}}"></script>
<!-- Main -->
<script src="{{ asset('user/js/main.js')}}"></script>

<script src="{{ asset('user/js/modernizr-2.6.2.min.js')}}"></script>

<script src="{{ asset('user/js/respond.min.js')}}"></script>

<link rel="stylesheet"  src="{{ asset('css/app.css')}}">

<script language="JavaScript" type="text/javascript" src="{{ asset('user/js/jquery-ui.js')}}"></script>

<script type="text/javascript">
    var token = '{{ csrf_token() }}';
</script>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
