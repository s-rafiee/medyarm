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
    <title>{{ $data['post']->title }}</title>
    <meta property="og:title" content="{{ $data['post']->title }}">
    <meta name="description" content="{{ $data['post']->description }}" />
    <meta property="og:description" content="{{ $data['post']->description }}">
    <meta name="keywords" content="یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین" />
    <meta property="og:image" content="{{ $data['post']->image }}">
    <meta property="og:type" content="article">
@endsection

@section('content')
    <div class="container-fluid no-padding">
        <img src="{{ $data['post']->image }}" class="img-responsive post-image" alt="{{ $data['post']->title }}">
    </div>
    <div class="container padding-bottom-100">
        <div class="row">
            <div class="col-md-12 post-map">
                <label><a href="/skill/{{ $data['skill']->skillen }}">{{ $data['skill']->skill }}</a></label><i>/</i><label><a href="/cours/{{ $data['cours']->name_en }}">{{ $data['cours']->title }}</a></label><i>/</i><label><a href="/lesson/{{ $data['post']->title_en }}">{{ $data['post']->title }}</a></label>
            </div>
            <div class="col-md-12 post-content">
                <div class="col-md-12 post-header">
                    <h1><a href="/lesson/{{ $data['post']->title_en }}">{{ $data['post']->title }}</a></h1>
                    <div>
                        <span><i class="glyphicon glyphicon-calendar"></i>{{ App\Classes\Jdf::jdate('l d F Y', strtotime($data['post']->updated_at)) }}</span><span><i class="glyphicon glyphicon-user"></i>{{ $data['post']->name }}</span>
                    </div>
                </div>
                <div id="post-content">{!! $data['post']->body !!}</div>
            </div>
        </div>
        <?php $i=0; ?>
        @foreach($data['posts'] as $post)
            <?php $i++; ?>
            <div class="row cours-post-list <?php if($data['post']->id == $post->id){echo 'active bg'.$post->id%10; } ?>">
                <div class="col-md-2 pull-right">
                    <a href="/lesson/{{ $post->title_en }}">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-responsive">
                    </a>
                </div>
                <div class="col-md-10">
                    <label>درس {{ $i }}</label>
                    <span><i class="glyphicon glyphicon-calendar"></i> {{ App\Classes\Jdf::jdate('l d F Y', strtotime($post->updated_at)) }}</span>
                    <h2>
                        <a href="/lesson/{{ $post->title_en }}">{{ $post->title }}</a>
                    </h2>
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
@stop
