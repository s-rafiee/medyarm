<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>

@extends('.template.layouts.base')


@section('title','انتخاب روش پرداخت')
@section('description','انتخاب روش پرداخت')
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')


@section('content')
    <div class="container padding-bottom-100">
        <div class="col-md-10 col-xs-offset-1 cart">
            <h1 class="cart-header">انتخاب روش پرداخت</h1>
            <div class="cart-empty-box">
                <table class="table table-responsive table-hover">
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>وضعیت</th>
                        <th>انتخاب</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>درگاه پرداخت زرین پال</td>
                        <td class="text-success">فعال</td>
                        <td>
                            <a href="/cart/payment/gateway" class="btn btn-success">پرداخت</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>درگاه پرداخت بانک سامان</td>
                        <td class="text-danger">غیر فعال</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>درگاه پرداخت بانک ملت</td>
                        <td class="text-danger">غیر فعال</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>درگاه پرداخت ایران کیش</td>
                        <td class="text-danger">غیر فعال</td>
                        <td>...</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop
