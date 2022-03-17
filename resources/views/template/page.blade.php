<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>

@extends('.template.layouts.base')

@section('title', $data['page']->title)
@section('description', $data['page']->description)
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')

@section('content')
    <div class="container-fluid no-padding">
        <img src="{{ $data['page']->image }}" class="img-responsive post-image" alt="{{ str_replace('-',' ',$data['page']->title) }}">
    </div>
    <div class="container padding-bottom-100">
        <div class="row">
            <div class="col-md-12 post-content">
                <div class="col-md-12 post-header">
                    <h1><a href="/{{ $data['page']->title }}">{{ str_replace('-',' ',$data['page']->title) }}</a></h1>
                </div>
                <div id="post-content">{!! $data['page']->body !!}</div>
            </div>
        </div>
    </div>
@stop
