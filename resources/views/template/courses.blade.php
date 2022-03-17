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
    <title>مدیارم-{{ $data['skill']->title }}</title>
    <meta property="og:title" content="مدیارم-{{ $data['skill']->title }}">
    <meta name="description" content="{{ $data['skill']->description }}" />
    <meta property="og:description" content="{{ $data['skill']->description }}">
    <meta name="keywords" content="یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین" />
    <meta property="og:image" content="{{ $data['skill']->image }}">
    <meta property="og:type" content="article">
@endsection

@section('header')
    <div class="row about-option">
        <div class="col-md-4">
            <a href="/skill/{{ $data['skill']->skillen }}">
                <img src="{{ $data['skill']->image }}" class="img-responsive" alt="{{ $data['skill']->skill }}">
            </a>
        </div>
        <div class="col-md-8">
            <h1>
                <a href="/skill/{{ $data['skill']->skillen }}">{{ $data['skill']->skill }}</a>
            </h1>
            <p>{{$data['skill']->description}}</p>
        </div>
    </div>
@stop

@section('content')
    <div class="container padding-bottom-100">
        @foreach($data['courses'] as $cours)
            <div class="row cours-group-box">
                <div class="col-md-2 cours-line pull-right hidden-sm hidden-xs">
                    <div>
                        <div><button class="pulse"></button></div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 text-left cours-box col-md-offset-1 pull-left">
                    <div>
                        <div class="bg{{ $cours->id%10 }}">
                            <label>
                                <a href="/skill/{{ $data['skill']->skillen }}">{{ $data['skill']->skill }}</a>
                            </label>
                            <a href="/skill/{{ $data['skill']->skill }}">
                                <img src="{{ $cours->image }}" alt="{{ $cours->title }}">
                            </a>
                            @if($cours->type == 1)
                                <label>
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                </label>
                            @elseif($cours->type == 2)
                                <label>
                                    <i class="glyphicon glyphicon-film"></i>
                                </label>
                            @endif
                        </div>
                        <div>
                            <h2><a href="/cours/{{ $cours->name_en }}">{{ $cours->title }}</a></h2>
                            <p>
                                {!! $cours->description !!}
                            </p>
                            <div>
                                <span class="level-box level{{ $cours->level }}">
                                    <ul>
                                        <li></li>
                                        <li></li>
                                        <li></li>
                                    </ul>
                                </span>
                                <span>سطح</span>
                                <span><i class="glyphicon glyphicon-book"></i>{{ $cours->posts_count }} درس </span>
                                <span><i class="glyphicon glyphicon-calendar"></i> {{ App\Classes\Jdf::jdate('l d F Y', strtotime($cours->updated_at)) }}</span>
                                <span><i class="glyphicon glyphicon-user"></i> {{ $cours->name }}</span>

                                @if($cours->publish)
                                    <span><i class="glyphicon glyphicon-pause"></i> درحال انتشار</span>
                                @else
                                    <span><i class="glyphicon glyphicon-stop"></i> تکمیل شده</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
