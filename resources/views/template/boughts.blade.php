<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 05/02/2019
 * Time: 02:05 AM
 */
?>

@extends('.template.layouts.base')


@section('title','وب سایت اموزشی مدیارم - خرید های انجام شده')
@section('description',"وب سایت اموزشی مدیارم - خرید های انجام شده")
@section('keywords','یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین')



@section('content')
    <div class="container padding-bottom-100">
        <div class="col-md-10 col-xs-offset-1 cart">
            <h1 class="cart-header">همه خرید های شما</h1>
            <div class="cart-empty-box">
                @if(!count($data['links']))
                    <span>شما هیچ خریدی انجام نداده اید.</span>
                    <h3>به <a href="/skills/" class="text-danger">مهارت ها</a> سر بزن، همیشه چیزی برای آموختن هست!!!.</h3>
                @else
                    <table class="table table-responsive table-hover">
                        <tr>
                            <th>شماره</th>
                            <th>عنوان</th>
                            <th>تعداد مجاز لینک</th>
                            <th>تعداد دانلود با این لینک</th>
                            <th>تاریخ اعتبار لینک</th>
                            <th>لینک دانلود</th>
                        </tr>
                        @foreach($data['links'] as $link)
                            <tr>
                                <td>{{ $link->id }}</td>
                                <td>{{ $link->title }}</td>
                                <td>5</td>
                                <td>{{ $link->numdownloaded }}</td>
                                <td><?php echo date('Y-m-d h:i', strtotime($link->created_at)+3*30*24*60*60); ?></td>
                                <td>
                                    @if($link->numdownloaded <5)
                                        <a href="http://localhost/download/{{ $link->fakelink }}" class="btn btn-success">دانلود</a>
                                    @else
                                        <span class="text-danger">منقضی شده</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
@stop
