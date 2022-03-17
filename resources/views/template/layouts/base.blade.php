<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 31/01/2019
 * Time: 01:53 AM
 */
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <link rel="apple-touch-icon" sizes="180x180" href="/logo/icon.icon">
    <link rel="manifest" href="/logo/icon.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/logo/icon-512.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/logo/icon-192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/logo/icon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/logo/icon-16.png">
    <meta property="og:site_name" content="مدیارم" />
    <meta property="og:locale" content="fa_IR" />
    @yield('head')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightslider.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/lightslider.min.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161643818-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-161643818-1');</script>
</head>
<body>
    <div class="container-fluid top-header">
        <div class="row">
            <div class="col-md-12">
                <header>
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <img src="/images/logo/logo-black.png" alt="مدیارم" class="logo">
                        </div>
                        <div class="navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="/">صفحه نخست</a></li>
                                <li><a href="/skills">مهارت ها</a></li>
                                <li><a href="/blog">وبلاگ</a></li>
                                @if(auth()->check())
                                    <li><a href="/cart/payment/boughts">{{ Auth::user()->name }}</a></li>
                                    <li><a href="/logout">خروج</a></li>
                                @else
                                    <li><a href="/login">ورود</a></li>
                                    <li><a href="/register">ثبت نام</a></li>
                                @endif
                                <li><a href="/cart"><i class="glyphicon glyphicon-shopping-cart"></i><span class="number-in-cart"></span></a></li>
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2" id="search-box">
                <form method="post" action="">
                    <div class="input-group text-left">
                                <span class="input-group-btn">
                                    <button class="btn btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                        <input type="text" class="form-control input-lg" placeholder="کلید واژه ای که به دنبال آن هستید..." />
                    </div>
                </form>
            </div>
        </div>
        <div class="container">
            @yield('header')
        </div>
    </div>
    @yield('content')


    <footer>
        <div class="container footer-box">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <label>گاهی خبرهای خوبی برات ایمیل کنیم؟</label>
                    <div class="input-group input-group-lg">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">ارسال!</button>
                    </span>
                        <input type="text" class="form-control" placeholder="ایمیلت را وارد کن ...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pull-right">
                    <img src="/images/logo/logo-black.png" alt="مدیارم" class="logo">
                    <p>ما تصمیم داشتیم که چند مهارت را بصورت حرفه ای دنبال کنیم در میانه راه تصمیم بر آن گرفتیم که مدیارم را راه اندازی کنیم تا شما را با خودمان همراه کنیم، ما بهترین نیستیم اما برای بهترین بودن از هیچ تلاشی دریغ نخواهیم کرد. ما را دنبال کن تا باهم پیش بریم.</p>
                </div>
                <div class="col-md-2 footer-menu pull-right">
                    <label>یادگیری</label>
                    <ul>
                        <li>
                            <a href="/skills">مهارت ها</a>
                        </li>
                        <li>
                            <a href="/blog">وبلاگ</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 footer-menu pull-right">
                    <label>تیم ما</label>
                    <ul>
                        @foreach($data['pages'] as $page)
                            <li>
                                <a href="{{ $page->title }}">{{ str_replace('-',' ', $page->title) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-2 footer-menu">
                    <label>کاربران</label>
                    <ul>
                        <li>
                            <a href="#">ورود</a>
                        </li>
                        <li>
                            <a href="#">ثبت نام</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12 footer-info">
                <p>© Medyarm 2019-<?php echo date('Y'); ?> ما برای جمع آوری این محتوا سخت تلاش کردیم لطفا به حقوق ما احترام بگذارید،درست فکر می کنید حتی با ذکر منبع.</p>
                <p>Developed with heart by saman rafiee</p>
            </div>
        </div>
    </footer>
    @yield('footer')
<script>
    $('document').ready(function(){
        $('.add-cart').click(function () {
            var data = new FormData();
            data.append('_token', "{{ csrf_token() }}");
            data.append('data',$(this).attr('data-type'));
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/cart/add", true);
            xhr.onload = function(){
                if(xhr.readyState===4 && xhr.status === 200){
                    $('.number-in-cart').html(this.responseText);
                }else{
                    alert('خطا،لطفا مجددا سعی کنید.');
                }
            };
            xhr.send(data);
        });
    });
</script>
</body>
</html>
