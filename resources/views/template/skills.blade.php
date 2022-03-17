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
    <title>وب سایت آموزشی مدیارم - مهارت ها</title>
    <meta property="og:title" content="وب سایت آموزشی مدیارم - مهارت ها">
    <meta name="description" content="وب سایت آموزشی مدیارم - آموزش برخی از جدیدترین مهارت ها- برنامه نویسی و طراحی سایت، هوش مصنوعی و یادگیری ماشین، داده کاوی و چند موضوع داغ دیگر" />
    <meta property="og:description" content="وب سایت آموزشی مدیارم - آموزش برخی از جدیدترین مهارت ها- برنامه نویسی و طراحی سایت، هوش مصنوعی و یادگیری ماشین، داده کاوی و چند موضوع داغ دیگر">
    <meta name="keywords" content="یادگیری ماشین،داده کاوی،هوش مصنوعی،طراحی وب،اندروید،tensorflow,python,jupyter notebook,php,laravel,javascript,mysql,ابزارهای یادگیری ماشین" />
    <meta property="og:image" content="">
    <meta property="og:type" content="article">
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center margin-top-50">
                @foreach($data['skills'] as $skill)
                    <div class="col-md-2 pull-right">
                        <div class="skill-box">
                            <div class="skill-box-header bg{{ $skill->id%10 }}">
                                <div>
                                    <a href="/skill/{{ $skill->skillen }}">
                                        <img src="{{ $skill->image }}" alt="{{ $skill->skill }}">
                                    </a>
                                    <h2>
                                        <a href="/skill/{{ $skill->skillen }}">{{ $skill->skill }}</a>
                                    </h2>
                                </div>
                                <div>
                                    <a href="/skill/{{ $skill->skillen }}">مشاهده</a>
                                </div>
                            </div>
                            <div class="skill-box-border">
                                <div>
                                    <span>{{ $skill->post_count }}</span>
                                    <label>درس ها</label>
                                </div>
                                <div>
                                    <span>{{ $skill->cours_count }}</span>
                                    <label>دوره ها</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @stop

