<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>
@extends('.template.layouts.base')


@section('title','وب سایت اموزشی مدیارم - سبد خرید')
@section('description',"وب سایت اموزشی مدیارم - سبد خرید")
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')

@section('content')
    <div class="container padding-bottom-100">
        <div class="col-md-10 col-xs-offset-1 cart">
            <h1 class="cart-header">سبد خرید</h1>
            <div class="cart-empty-box">
                @if(count($data['cart']['courses']) or count($data['cart']['posts']))
                    <table class="table table-responsive table-hover">
                        <tr>
                            <th>عنوان</th>
                            <th>تخفیف</th>
                            <th>قیمت</th>
                            <th>قیمت نهایی</th>
                            <th>گزینه ها</th>
                        </tr>
                        <?php $total_price = 0; ?>
                        @foreach($data['courses'] as $cours)
                            <tr>
                                <td><a href="/cours/{{ $cours->id }}/{{ str_replace(' ', '-', $cours->title) }}">{{ $cours->title }}</a></td>
                                <td>{{ $cours->off }}%</td>
                                <td>{{ number_format($cours->price) }} تومان</td>
                                <td><?php if($cours->off){$off = $cours->price-($cours->price*$cours->off)/100; }else{ $off = $cours->price;} ?>{{ number_format($off) }} تومان</td>
                                <td><a href="/cart/delete/cours/{{ $cours->id }}" class="btn btn-danger">حذف از سبد</a></td>
                            </tr>
                            <?php $total_price += $off; ?>
                        @endforeach

                        @foreach($data['posts'] as $post)
                            <tr>
                                <td><a href="/lesson/{{ $post->id }}/{{ str_replace(' ', '-', $post->title) }}">{{ $post->title }}</a></td>
                                <td>{{ $post->off }}%</td>
                                <td>{{ number_format($post->price) }} تومان</td>
                                <td><?php if($post->off){$off = $post->price-($post->price*$post->off)/100; }else{ $off = $post->price;} ?>{{ number_format($off) }} تومان</td>
                                <td><a href="/cart/delete/post/{{ $post->id }}" class="btn btn-danger">حذف از سبد</a></td>
                            </tr>
                            <?php $total_price += $off; ?>
                        @endforeach
                    </table>
                @else
                    <div class="cart-empty">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                    </div>
                    <p>سبد خرید شما خالی است.</p>
                @endif
            </div>
            <div class="cart-footer">
                @if(count($data['cart']['courses']) or count($data['cart']['posts']))
                    <span>مجموع خرید: {{ number_format($total_price) }} تومان</span>
                    <a href="/cart/payment/" class="btn btn-info pull-left">نهایی کردن خرید!</a>
                @else
                    <div class="text-center">به <a href="/skills/" class="text-info">مهارت ها</a> سر بزن، مطمئنم چیزی برای یادگرفتن پیدا میکنی!!!</div>
                @endif
            </div>
        </div>
    </div>
@stop
