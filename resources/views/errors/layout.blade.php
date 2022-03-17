 <!DOCTYP html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0 , shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="">
    <link rel="apple-touch-icon" sizes="180x180" href="">
    <link rel="icon" type="image/png" sizes="32x32" href="">
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <link rel="manifest" href="">
    <meta name="robots" content="Index, Follow">
    @yield('header')
    <meta property="og:site_name" content="آهنگام"/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ahangam.ir">
    <meta property="og:locale" content="fa_IR" />
    <meta property="og:locale:alternate" content="en_GB" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="آهنگام">
    <meta property="og:image" content="https://ahangam.ir/images/ahangam.png">
    <meta name="twitter:image" content="https://ahangam.ir/images/ahangam.png">
    <meta name="twitter:image:alt" content="آهنگام">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <link href="/css/style.css" type="text/css" rel="stylesheet">
    <script src="/js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <style type="text/css">
    	*{
    		background: #F5F5F5;
    		text-align: center!important;
    	}
    	.errors{
    		font-size: 18px;
    		margin-bottom: -80px;
    	}
    	img{
    		margin-left: 50px;
    	}
    </style>
</head>
<body>
	@yield('content')
</body>
</html>
