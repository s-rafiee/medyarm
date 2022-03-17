<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 6/25/2019
 * Time: 10:57 AM
 */
?>
@extends('panel.layouts.app')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New User.</h4>
                <p class="card-description">
                    Complete the form to <code>create a new user</code>.
                </p>
                <form class="form-sample" method="post" action="{{ url('/dashboard/users/store') }}">
                    @csrf
                    <p class="card-description">
                        Personal info
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="family" class="form-control"  value="{{ old('family') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control"  value="{{ old('email') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <button id="lfm" data-input="selected-image" data-preview="holder" class="btn btn-sm btn-primary" type="button">Upload</button>
                                        </div>
                                        <input type="text" id="selected-image" class="form-control" value="{{ old('image') }}" name="image" placeholder="Image Url" aria-label="Recipient's username">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="********">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Repeat Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="ppassword" class="form-control form-control-lg" placeholder="********">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Roule</label>
                                <div class="col-sm-9">
                                    <select name="role" class="form-control form-control-lg">
                                        <option value="author">Author</option>
                                        <option value="administrator">Administrator</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleTextarea1">About User</label>
                                <textarea class="form-control" name="about">{{ old('about') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Update</button>
                    @if (Session::has('success'))
                        <span class="text-success">{{ Session::get('success') }}</span>
                    @elseif (Session::has('error'))
                        <span class="text-danger">{{ Session::get('error') }}</span>
                    @endif
                </form>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        var editor_config = {
            path_absolute:"{{ url('/') }}",
            height:"200",
            selector: "textarea",
            plugins: 'print preview fullpage searchreplace autolink directionality visualchars fullscreen image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount textpattern help',
            toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + '/laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            } ,

            //  Add Bootstrap Image Responsive class for inserted images
            image_class_list: [
                {title: 'None', value: ''},
                {title: 'Bootstrap responsive image', value: 'img-responsive'},
            ]

        };

        tinymce.init(editor_config);
    </script>

    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>

@stop