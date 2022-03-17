<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 31/01/2019
 * Time: 01:55 AM
 */
?>
@extends('.template.layouts.index')

@section('title','وب سایت آموزشی مدیارم')
@section('description','وب سایت آموزشی مدیارم منتشر کننده دوره های آموزشی یادگیری ماشین، داده کاوی، اندروید، طراحی وب.')
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')


@section('header')
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
                <p>هوش مصنوعی، داده کاوی، یادگیری ماشین و چند موضوع داغ دیگر را با ما دنبال کنید.ما هر آنچه که برای یک شروع لازم دارید را فراهم کرده ایم.
                    <br>برای یک شروع آماده ای؟</p>
                <div class="btn-group-header">
                    <a href="/skills/">جستجوی مهارت ها</a>
                </div>
            </div>
            <div class="col-md-6">
                {{--<img src="/images/default/robot.png" alt="">--}}
            </div>
        </div>
    </div>
@stop


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center margin-top-200 box-title">
                <label>خلاصه ای از هر آنچه که برای شما آماده کرده ایم</label>
            </div>
            <div class="col-md-12 text-center margin-top-20">
                <div class="box-options">
                    <span>{{ $data['skill_count'] }}</span>
                    <label>مهارت ها</label>
                </div>
                <div class="box-options">
                    <span>{{ $data['cours_count'] }}</span>
                    <label>دوره ها</label>
                </div>
                <div class="box-options">
                    <span>{{ $data['post_count'] }}</span>
                    <label>درس ها</label>
                </div>
                <div class="box-options">
                    <span>{{ $data['blog_count'] }}</span>
                    <label>نوشته ها</label>
                </div>
            </div>
            <div class="col-md-12 margin-top-50">
                @foreach($data['skills'] as $skill)
                    <div class="col-md-2 col-sm-4 col-xs-6 text-center pull-right main-skill-box">
                        <div class="skill-box">
                            <div class="skill-box-header bg{{ substr($skill->id,strlen($skill->id)-1) }}">
                                <div>
                                    <a href="/skill/{{ $skill->id }}/{{ str_replace(' ','-',$skill->skill) }}">
                                        <img src="{{ $skill->image }}" alt="{{ $skill->skill }}" title="{{ $skill->skill }}">
                                    <p>{{ str_replace('-',' ',$skill->skill) }}</p>
                                    </a>
                                </div>
                                <div>
                                    <a href="/skill/{{ $skill->id }}/{{ str_replace(' ','-',$skill->skill) }}">مشاهده</a>
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

        @if (count($data['post_slider']))
            <div class="row">
                <div class="col-md-12 text-center box-title">
                    <label> جدیدترین درس های منتشر شده</label>
                </div>
                <div class="container">
                    <div class="col-md-12 text-center margin-top-50">
                        <div class="col-md-6 no-padding">
                            <div class="post-box-1">
                                <ul id="lightSlider">
                                    @foreach($data['post_slider'] as $slider)
                                        <li>
                                            <img src="{{ $slider['image'] }}" alt="{{ $slider['title'] }}">
                                            <div>
                                                <label class="bg{{ substr($slider['id'],strlen($slider['id'])-1) }} tag"><a href="/skill/{{ $slider['sid'] }}/{{ str_replace(' ','-',$slider['skill']) }}">{{ $slider['skill'] }}</a></label>
                                                <h2><a href="/lesson/{{ $slider['id'] }}/{{ str_replace(' ','-',$slider['title']) }}">{{ $slider['title'] }}</a></h2>
                                                <span><i class="glyphicon glyphicon-calendar"></i>{{ $slider['updated_at'] }}</span>
                                                <span><i class="glyphicon glyphicon-user"></i>{{ $slider['name'] }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @for($i=0; $i<count($data['posts']) and $i<4;$i++)
                            <div class="col-md-3 post-box">
                                <div class="post-box-2">
                                    <img src="{{ $data['posts'][$i]['image'] }}" alt="{{ $data['posts'][$i]['title'] }}">
                                    <div>
                                        <label class="bg{{ substr($data['posts'][$i]['id'],strlen($data['posts'][$i]['id'])-1) }} tag"><a href="/skill/{{ $data['posts'][$i]['sid'] }}/{{ str_replace(' ', '-', $data['posts'][$i]['title']) }}">{{ $data['posts'][$i]['skill'] }}</a></label>
                                        <h2><a href="/lesson/{{ $data['posts'][$i]['title'] }}/{{ str_replace(' ', '-', $data['posts'][$i]['title']) }}">{{ $data['posts'][$i]['title'] }}</a></h2>
                                        <span><i class="glyphicon glyphicon-calendar"></i>{{ $data['posts'][$i]['updated_at'] }}</span>
                                        <span><i class="glyphicon glyphicon-user"></i>{{ $data['posts'][$i]['name'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="col-md-12">
                        @for($i=4; $i<count($data['posts']);$i++)
                            <div class="col-md-3 post-box-footer">
                                <img src="{{ $data['posts'][$i]['image'] }}" alt="{{ $data['posts'][$i]['title'] }}">
                                <div class="bg{{ substr($data['posts'][$i]['id'],strlen($data['posts'][$i]['id'])-1) }}">
                                    <h2>
                                        <a href="/lesson/{{ $data['posts'][$i]['sid'] }}/{{ str_replace(' ', '-', $data['posts'][$i]['title']) }}">{{ $data['posts'][$i]['title'] }}</a>
                                    </h2>
                                    <p><i class="glyphicon glyphicon-calendar"></i>{{ $data['posts'][$i]['updated_at'] }}</p>
                                    <p><i class="glyphicon glyphicon-user"></i>{{ $data['posts'][$i]['name'] }}</p>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 text-center margin-top-100 box-title">
                <label>جدیدترین نوشته ها</label>
            </div>
            <div class="col-md-12 margin-top-50">
                @foreach($data['blogs'] as $blog)
                    <div class="col-md-4">
                        <div class="blog-post">
                            <a href="/blog/{{ $blog->id }}/{{ str_replace(' ', '-', $blog->title) }}">
                                <img src="{{ $blog->image1 }}" alt="{{ $blog->title }}" class="img-responsive">
                            </a>
                            <div class="blog-post-footer">
                                <h2>
                                    <a href="/blog/{{ $blog->id }}/{{ str_replace(' ', '-', $blog->title) }}">{{ $blog->title }}</a>
                                </h2>
                                <p>{{ $blog->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{--<div class="container-fluid section-form ">--}}
        {{--<div class="col-md-12 text-center box-title">--}}
            {{--<label>The most concise screencasts for the working developer.</label>--}}
            {{--<p> called “monthly” - and it’s not like the gym.<br> Seriously, you can cancel it in five seconds if this isn't for you. </p>--}}
        {{--</div>--}}
        {{--<div class="col-md-8 col-md-offset-2" id="section-form">--}}

        {{--</div>--}}
    {{--</div>--}}
    <div class="container-fluid about-box">
        <div class="col-md-7 no-padding">
            <video autoplay loop>
                <source src="/videos/3.mp4" type="video/mp4">
            </video>
        </div>
        <div class="col-md-5">
            <h2>هر آنچه که ما در ذهن داریم:</h2>
            <p>
                ما یک تیم از افراد با جمعی دوستانه و خلاق هستیم که این جمع دوستانه کمک زیادی به آنچه که در ذهن داریم می کند.اما در این زمان تمرکز ما بر روی انتشار محتوای مفید است،تلاش می کنیم تا آنچه که می آموزیم را با دقت منتشر کنیم.ما اهداف دیگری به جز آنچه که می بینید در ذهن داریم و برای تحقیق آنها پیش می رویم.
                <br>دلگرمی ما،همراهی شماست.
            </p>
        </div>
    </div>

    {{--<div class="container-fluid section-about hidden">--}}
        {{--<div class="col-md-6 col-md-offset-1">--}}
            {{--<h2>There's a chance you may already know me!</h2>--}}
            {{--<p>--}}
                {{--There's a chance you may already know me! A veteran in the PHP community, I was a co-host on the official Laravel podcast, have written successful books, built popular packages, spoken at multiple Laracon conferences, been a guest on countless podcasts (including PHP Town Hall, Shop Talk, No Capes, and Full Stack Radio), and have contributed to the largest development magazines in the world.<br>--}}
                {{--And if I may be so bold, I'm very good at teaching this stuff. You won't find boring, sleep-inducing slides and diagrams (scored to the tune of "umms" and "uhhs") anywhere on this site. No thank you. Instead, I record the sorts of lessons that I wish had been available to me all those years ago: concise and respectful of your time.<br>--}}
                {{--Buy me the equivalent of lunch once a month, and I'll teach you everything I know about this business.--}}
            {{--</p>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop

@section('footer')
    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                $('#lightSlider').lightSlider({
                    speed: 1000, //ms'
                    auto: true,
                    loop: true,
                    slideEndAnimation: true,
                    pause: 4000,
                    item:1,
                    slideMove:1,
                    rtl:true,
                    slideMargin: 4,
                    addClass: '',
                    mode: "slide",
                    useCSS: true,
                    cssEasing: 'ease', //'cubic-bezier(0.25, 0, 0.25, 1)',//
                    easing: 'linear', //'for jquery animation',////
                    keyPress: false,
                    controls: true,
                    prevHtml: '<i class="glyphicon glyphicon-chevron-left prevHtml"></i>',
                    nextHtml: '<i class="glyphicon glyphicon-chevron-right nextHtml"></i>',
                });
            });
        });
    </script>
@stop
