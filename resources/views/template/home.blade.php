<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 31/01/2019
 * Time: 01:55 AM
 */
?>
@extends('.template.layouts.base_home')
@section('head')
    <title>مدیارم-راهی برای یاد گرفتن مهارت های مدرن</title>
    <meta property="og:title" content="مدیارم-راهی برای یاد گرفتن مهارت های مدرن">
    <meta name="description" content="وب سایت آموزشی مدیارم-راهی برای یاد گرفتن مهارت های مدرن-هوش مصنوعی، داده کاوی، یادگیری ماشین و چند موضوع داغ دیگر را با ما دنبال کنید. ما هر آنچه که برای یک شروع لازم دارید را فراهم کرده ایم. برای یک شروع آماده ای؟" />
    <meta property="og:description" content="وب سایت آموزشی مدیارم-راهی برای یاد گرفتن مهارت های مدرن-هوش مصنوعی، داده کاوی، یادگیری ماشین و چند موضوع داغ دیگر را با ما دنبال کنید. ما هر آنچه که برای یک شروع لازم دارید را فراهم کرده ایم. برای یک شروع آماده ای؟">
    <meta name="keywords" content="یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین" />
    <meta property="og:image" content="">
    <meta property="og:type" content="article">
@endsection

@section('content')
    <div class="container-fluid top-bg">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <img src="/images/logo/logo-black.png" alt="مدیارم" class="logo">
            </div>
            <div class="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
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
        <div class="row">
            <div class="col-md-6 header-box">
                <h1>مدیارم راهی برای <br> یاد گرفتن مهارت های مدرن</h1>
                <p>هوش مصنوعی، داده کاوی، یادگیری ماشین و چند موضوع داغ دیگر را با ما دنبال کنید. ما هر آنچه که برای یک شروع لازم دارید را فراهم کرده ایم.
                    <br>برای یک شروع آماده ای؟</p>
                <div class="btn-group-header">
                    <a href="/skills/">جستجوی مهارت ها</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center margin-top-200 box-title">
                <label>خلاصه ای از هر آنچه که برای شما آماده کرده ایم</label>
            </div>
            <div class="col-md-12 text-center margin-top-20">

                <div class="box-options">
                    <span>{{ $data['skill_count'] }}</span>
                    <div>
                        <label>مهارت ها</label>
                        <a href="/skills/">مشاهده همه</a>
                    </div>
                </div>
                <div class="box-options">
                    <span>{{ $data['cours_count'] }}</span>
                    <div>
                        <label>دوره ها</label>
                        <a href="/courses/">مشاهده همه</a>
                    </div>
                </div>
                <div class="box-options">
                    <span>{{ $data['post_count'] }}</span>
                    <div>
                        <label>درس ها</label>
                        <a href="/lessons/">مشاهده همه</a>
                    </div>
                </div>
                <div class="box-options">
                    <span>{{ $data['blog_count'] }}</span>
                    <div>
                        <label>نوشته ها</label>
                        <a href="/blogs/">مشاهده همه</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 main-carousel margin-top-50">
                @foreach($data['skills'] as $skill)
                    <div class="carousel-cell col-md-2 col-sm-4 col-xs-6 text-center pull-right main-skill-box">
                        <div class="skill-box">
                            <div class="skill-box-header bg{{ $skill->id%10 }}">
                                <div>
                                    <a href="/skill/{{ $skill->skillen }}">
                                        <img src="{{ $skill->image }}" alt="{{ $skill->skill }}" title="{{ $skill->skill }}">
                                        <p>{{ $skill->skill }}</p>
                                    </a>
                                </div>
                                <div>
                                    <a href="/skill/{{ $skill->skillen }}">مشاهده</a>
                                </div>
                            </div>
                            <div class="skill-box-border">
                                <div>
                                    <span>{{ $skill->post_count }}</span>
                                    <label>درس ها</label>
                                </div>
                                <div>
                                    <span>{{ $skill->cours_count }}</span>
                                    <label>دوره ها</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if (count($data['posts']))
        <div class="container-fluid">
            <div class="row margin-top-100 new-lesson">
                <div class="col-md-12 text-center box-title">
                    <label> جدیدترین درس های منتشر شده</label>
                </div>
                <div class="col-md-12 main-carousel main-carousel-lesson margin-top-100">
                    @foreach($data['posts'] as $post)
                        <div class="col-md-4 col-sm-6 col-xs-12 pull-right carousel-cell">
                            <div class="cart-box">
                                <div class="cart-box-right bg{{ $post['id']%10 }}">
                                    <a href="/skill/{{ $post['skillen'] }}" class="skill"><label>{{ $post['skill'] }}</label></a>
                                    <img src="{{ $post['simage'] }}" alt="{{ $post['skill'] }}" class="skill-image">
                                    <ul class="lesson-level lesson-level{{ $post['level'] }}">
                                        <li><div></div>سخت</li>
                                        <li><div></div>متوسط</li>
                                        <li><div></div>ساده</li>
                                    </ul>
                                </div>
                                <div class="cart-box-left">
                                    <h2>
                                        <a href="/lesson/{{ $post['title_en'] }}">{{ $post['title'] }}</a>
                                    </h2>
                                    <p>{{ $post['description'] }}</p>
                                    <a href="/lesson/{{ $post['title_en'] }}" class="more bg{{ $post['id']%10 }}">ادامه مطلب</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if(count($data['blogs']))
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center margin-top-100 box-title">
                    <label>جدیدترین نوشته ها</label>
                </div>
                <div class="col-md-12 margin-top-50">
                    @foreach($data['blogs'] as $blog)
                        <div class="col-md-4">
                            <div class="blog-post">
                                <a href="/blog/{{ $blog->title_en }}">
                                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="img-responsive">
                                </a>
                                <div class="blog-post-footer">
                                    <h2>
                                        <a href="/blog/{{ $blog->title_en }}">{{ $blog->title }}</a>
                                    </h2>
                                    <p>{{ $blog->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{--<div class="container-fluid section-message">--}}
        {{--<div class="col-md-12 text-center box-title">--}}
            {{--<label>هر آنچه که ما در ذهن داریم:</label>--}}
        {{--</div>--}}
        {{--<div class="col-md-8 col-md-offset-2" id="section-message">--}}
            {{--<p>--}}
                {{--ما یک تیم از افراد با جمعی دوستانه و خلاق هستیم که این جمع دوستانه کمک زیادی به آنچه که در ذهن داریم می کند.اما در این زمان تمرکز ما بر روی انتشار محتوای مفید است،تلاش می کنیم تا آنچه که می آموزیم را با دقت منتشر کنیم.ما اهداف دیگری به جز آنچه که می بینید در ذهن داریم و برای تحقیق آنها پیش می رویم.--}}
                {{--<br>دلگرمی ما،همراهی شماست.--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="container-fluid about-box">
        <div class="col-md-7 no-padding">
            <img src="/images/play.gif" alt="مدیارم-medyarm" class="img-responsive">
        </div>
        <div class="col-md-5">
            <h2>هر آنچه که ما در ذهن داریم:</h2>
            <p>
                ما یک تیم از افراد با جمعی دوستانه و خلاق هستیم که این جمع دوستانه کمک زیادی به آنچه که در ذهن داریم می کند.اما در این زمان تمرکز ما بر روی انتشار محتوای مفید است،تلاش می کنیم تا آنچه که می آموزیم را با دقت منتشر کنیم.ما اهداف دیگری به جز آنچه که می بینید در ذهن داریم و برای تحقیق آنها پیش می رویم.
                <br>دلگرمی ما،همراهی شماست.
            </p>
        </div>
    </div>

    {{--<div class="container-fluid section-about">--}}
        {{--<div class="col-md-6 col-md-offset-1">--}}
            {{--<h2>هر آنچه که ما در ذهن داریم:</h2>--}}
            {{--<p>--}}
                {{--There's a chance you may already know me! A veteran in the PHP community, I was a co-host on the official Laravel podcast, have written successful books, built popular packages, spoken at multiple Laracon conferences, been a guest on countless podcasts (including PHP Town Hall, Shop Talk, No Capes, and Full Stack Radio), and have contributed to the largest development magazines in the world.<br>--}}
                {{--And if I may be so bold, I'm very good at teaching this stuff. You won't find boring, sleep-inducing slides and diagrams (scored to the tune of "umms" and "uhhs") anywhere on this site. No thank you. Instead, I record the sorts of lessons that I wish had been available to me all those years ago: concise and respectful of your time.<br>--}}
                {{--Buy me the equivalent of lunch once a month, and I'll teach you everything I know about this business.--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop

@section('footer')

    {{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$(document).ready(function() {--}}
                {{--$('#lightSlider').lightSlider({--}}
                    {{--speed: 1000, //ms'--}}
                    {{--auto: true,--}}
                    {{--loop: true,--}}
                    {{--slideEndAnimation: true,--}}
                    {{--pause: 4000,--}}
                    {{--item:1,--}}
                    {{--slideMove:1,--}}
                    {{--rtl:true,--}}
                    {{--slideMargin: 4,--}}
                    {{--addClass: '',--}}
                    {{--mode: "slide",--}}
                    {{--useCSS: true,--}}
                    {{--cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//--}}
                    {{--easing: 'linear', //'for jquery animation',////--}}
                    {{--keyPress: false,--}}
                    {{--controls: true,--}}
                    {{--prevHtml: '<i class="glyphicon glyphicon-chevron-left prevHtml"></i>',--}}
                    {{--nextHtml: '<i class="glyphicon glyphicon-chevron-right nextHtml"></i>',--}}
                {{--});--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@stop