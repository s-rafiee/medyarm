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
    <link href="/css/flickity.css" type="text/css" rel="stylesheet">
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
<body class="body">
    @yield('header')

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
                            <a href="/login">ورود</a>
                        </li>
                        <li>
                            <a href="/register">ثبت نام</a>
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
    <script src="/js/flickity.pkgd.min.js" type="text/javascript"></script>
    <script>
        $('.main-carousel').flickity({
            wrapAround: false,
            draggable:true,
            pageDots: false,
            prevNextButtons: true,
            rightToLeft: true,
            freeScroll: true,
            autoPlay: true,
            cellAlign: 'right',
        });
    </script>
</body>
</html>
