<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>

@extends('.template.layouts.base')


@section('title',$data['blog']->title)
@section('description',$data['blog']->description)
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')


@section('content')
    <div class="container-fluid no-padding">
        <img src="{{ $data['blog']->image }}" class="img-responsive post-image" alt="{{ $data['blog']->title }}">
    </div>
    <div class="container padding-bottom-100">
        <div class="row">
            <div class="col-md-12 post-content">
                <div class="col-md-12 post-header">
                    <h1><a href="/blog/{{ $data['blog']->id }}/{{ str_replace(' ','-',$data['blog']->title) }}">{{ $data['blog']->title }}</a></h1>
                    <div>
                        <span><i class="glyphicon glyphicon-calendar"></i>{{ $data['blog']->updated_at }}</span><span><i class="glyphicon glyphicon-user"></i>{{ $data['blog']->name }}</span>
                    </div>
                </div>
                <div id="post-content">{!! $data['blog']->body !!}</div>
            </div>
        </div>
    </div>
@stop
