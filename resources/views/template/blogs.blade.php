<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>
@extends('.template.layouts.base')


@section('title','وب سایت اموزشی مدیارم - مطالب منتشر شده')
@section('description',"وب سایت اموزشی مدیارم - مطالب منتشر شده")
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')


@section('content')
    <div class="container padding-bottom-100">
        <div class="row">

            @foreach($data['blogs'] as $blog)
                <div class="row cours-group-box">
                    <div class="col-md-2 cours-line pull-right hidden-sm hidden-xs">
                        <div>
                            <div><button class="pulse"></button></div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12 text-left cours-box col-md-offset-1 pull-left">
                        <div>
                            <div class="bg{{ substr($blog->id, strlen($blog->id)-1) }}">
                                <a href="#">
                                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}">
                                </a>
                                <label>
                                    <i class="glyphicon glyphicon-list-alt"></i>
                                </label>
                            </div>
                            <div>
                                <h2><a href="/blog/{{ $blog->id }}/{{ str_replace(' ','-',$blog->title) }}">{{ $blog->title }}</a></h2>
                                <p>
                                    {!! $blog->description !!}
                                </p>
                                <div>
                                    <span><i class="glyphicon glyphicon-calendar"></i> {{ $blog->updated_at }}</span>
                                    <span><i class="glyphicon glyphicon-user"></i> {{ $blog->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        @if( count($data['blogs']) )
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">{!! $data['blogs']->appends(Request::query())->render() !!}</div>
                </div>
            </div>
        @endif
    </div>
@stop
