<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>

@extends('.template.layouts.base')

@section('title','نتیجه پرداخت')
@section('description','نتیجه پرداخت')
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')


@section('content')
    <div class="container padding-bottom-100">
        <div class="col-md-10 col-xs-offset-1 cart">
            <h1 class="cart-header">
                <span class="<?php if($data['status']=='ok'){ echo 'text-success';}else{ echo 'text-danger';} ?>">
                    {{ $data['message'] }}
                </span>
            </h1>
            <div class="cart-empty-box">
                @if($data['status']=='ok')
                    هورااا، خرید با موفقیت به پایان رسید، هم اکنون از <a href="/cart/payment/boughts" class="text-info">صفحه خرید های من</a> دانلود کنید.
                @else
                     رفتن به صفحه <a href="/cart/payment/boughts" class="text-info"> خرید های من</a>.</a>
                @endif
            </div>
        </div>
    </div>
@stop
