<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>
@extends('.template.layouts.base')

@section('head')
    <title>{{ $data['cours']->title }}</title>
    <meta property="og:title" content="{{ $data['cours']->title }}">
    <meta name="description" content="{{ $data['cours']->description }}" />
    <meta property="og:description" content="{{ $data['cours']->description }}">
    <meta name="keywords" content="یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین" />
    <meta property="og:image" content="{{ $data['cours']->image }}">
    <meta property="og:type" content="article">
@endsection

@section('header')
    <div class="row about-option">
        <div class="col-md-4">
            <img src="{{ $data['cours']->image }}" class="img-responsive" alt="{{ $data['cours']->title }}">
        </div>
        <div class="col-md-8">
            <h1><a href="/cours/{{ $data['cours']->name_en }}">{{ $data['cours']->title }}</a></h1>
            <p>{!! $data['cours']->description !!}</p>
            <div class="cours-level">
                <span class="level-box level{{ $data['cours']->level }}">
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </span>
                <span>سطح دوره</span>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container padding-bottom-100">
        @if($data['cours']->type==2)
        <div class="row cours-post-list">
            <div class="col-md-12 pull-right">
                این دوره شامل <span class="text-danger">{{ count($data['posts']) }}</span> درس است، آیا می خواهید کل دوره را با <span class="text-danger"> <?php echo $data['cours']->off ? $data['cours']->off.'%': ''; ?> تخفیف</span> یکجا دانلود کنید؟
                <button class="btn add-cart pull-left" data-type="c:{{ $data['cours']->id }}">
                    افزودن کل دوره به سبد خرید <i class="glyphicon glyphicon-shopping-cart"></i>
                </button>
            </div>
        </div>
        @endif
        <?php $i = count($data['posts']); ?>
        @foreach($data['posts'] as $post)
            <div class="row cours-post-list">
                <div class="col-md-2 pull-right">
                    <a href="/lesson/{{ $post->title_en }}">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-10">
                    <label>درس {{ $i }}</label>
                    <span><i class="glyphicon glyphicon-calendar"></i> {{ App\Classes\Jdf::jdate('l d F Y', strtotime($post->updated_at)) }}</span>
                    <span><i class="glyphicon glyphicon-usd"></i><?php if($post->price){echo $post->price.' تومان';}else{ echo 'رایگان';} ?></span>
                    {{--<button class="btn add-cart pull-left" data-type="p:{{ $post->id }}">--}}
                        {{--افزودن به سبد خرید <i class="glyphicon glyphicon-shopping-cart"></i>--}}
                    {{--</button>--}}
                    <h2>
                        <a href="/lesson/{{ $post->title_en }}">{{ $post->title }}</a>
                    </h2>
                    <p>{{ $post->description }}</p>
                </div>
            </div>
            <?php $i--; ?>
        @endforeach
    </div>
@stop
