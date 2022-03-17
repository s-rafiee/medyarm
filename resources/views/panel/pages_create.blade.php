<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/26/2019
 * Time: 12:09 PM
 */
?>
@extends('panel.layouts.app')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New Page</h4>
                <p class="card-description">
                    Complete This Form And Save It Until A New Page Is Published.
                </p>
                <form class="forms-sample" method="post" action="{{ url('/dashboard/pages/store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Page Title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Page Description" value="{{ old('description') }}">
                    </div>
                    <div class="form-group">
                        <label>Image upload</label>
                        <div class="input-group col-xs-12">
                            <input type="text" name="image" class="form-control" id="selected-image" placeholder="Image URL" value="{{ old('image') }}">
                            <span class="input-group-append">
                                <button id="lfm" data-input="selected-image" data-preview="holder" class="btn btn-sm btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body">Text</label>
                        <textarea class="form-control" name="body" id="body" rows="4">{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="title">Language</label>
                        <select class="form-control" id="language" name="language">
                            @foreach($data['lan'] as $lan)
                                <option value="{{ $lan->id }}" <?php if (old('language') == $lan->id){echo 'selected';} ?>>{{ $lan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Save</button>
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
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
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
@stop