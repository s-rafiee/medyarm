<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/26/2019
 * Time: 7:44 PM
 */
?>
@extends('panel.layouts.app')


@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New Lesson
                    @if(isset($data['cours']))
                        for cours: <span class="text-danger">{{ $data['cours']->name }}</span>
                    @endif
                    .
                </h4>
                <p class="card-description">Complete and save this form to publish a new lesson.</p>

                <form class="forms-sample" method="post" action="{{ url('/dashboard/lessons/store') }}">

                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Post Title" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="titleen">Title En</label>
                        <input type="text" name="title_en" class="form-control" id="titleen" placeholder="Post Title En" value="{{ old('title_en') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Post Description" value="{{ old('description') }}">
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
                        <textarea class="editor" class="form-control" name="body">{{ old('body') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="Price" value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label for="time">Time Videos</label>
                        <input type="text" name="time" class="form-control" id="time" placeholder="Time Videos" value="{{ old('time') }}">
                    </div>

                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" name="link" class="form-control" id="link" placeholder="Link" value="{{ old('link') }}">
                    </div>
                    @if(isset($data['cours']))
                        <input type="hidden" name="cours" value="{{ $data['cours']->id }}">
                    @else
                        <div class="form-group">
                            <label for="cours">Cours</label>
                            <input type="text" autocomplete="off" name="cours" class="form-control suggestion" id="cours" placeholder="Cours" value="{{ old('cours') }}">
                            <div class="suggestion-box hide" data-url="/dashboard/courses/search">
                                <div class="suggestion-header">Cours Result</div>
                                <ul class="suggestion-box-list"></ul>
                            </div>
                        </div>
                    @endif

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
    <script src="/panel/vendors/ckeditor-5/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '.editor' ), {
                toolbar: {
                    items: [
                        'heading',
                        'glue',
                        '|',
                        'bold',
                        'italic',
                        'alignment',
                        'fontBackgroundColor',
                        'fontColor',
                        'fontSize',
                        'highlight',
                        'fontFamily',
                        '|',
                        'numberedList',
                        'bulletedList',
                        'todolist',
                        'outdent',
                        'indent',
                        '|',
                        'link',
                        'imageUpload',
                        'imageInsert',
                        'blockQuote',
                        'insertTable',
                        'mediaEmbed',
                        'codeBlock',
                        'horizontalLine',
                        'htmlEmbed',
                        'specialCharacters',
                        '|',
                        'undo',
                        'redo',
                        'code',
                        'removeFormat'
                    ]
                },
                language: 'fa',
                resize_enabled: 'false',
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'imageStyle:full',
                        'imageStyle:side',
                        'linkImage'
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn',
                        'tableRow',
                        'mergeTableCells',
                        'tableCellProperties',
                        'tableProperties'
                    ]
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>

    <script>
        $('.suggestion').keyup(function(){
            if($(this).val().length >= 2){
                tag = $(this);
                var data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                data.append('s', tag.val());
                if (window.XMLHttpRequest) {
                    var xhr = new XMLHttpRequest();
                } else {
                    var xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr.open('POST', "{{ url('/dashboard/courses/search') }}", true);
                xhr.onload = function () {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        result = jQuery.parseJSON(xhr.responseText);
                        html = '';
                        for(i=0;i<result.length;i++){
                            html += '<li>'+result[i].title+'</li>';
                        }
                        tag.parents('.form-group').find('.suggestion-box-list').html(html);
                        tag.parents('.form-group').find('.suggestion-box').show();
                    }else{
                        modal_show("Error ",'<span class="text-danger">Error Checking Request, Code #500</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                    }
                    $('.suggestion-box .suggestion-box-list li').click(function(){
                        $(this).parents('.form-group').find('.suggestion').val($(this).html());
                        $(this).parents('.suggestion-box').hide();
                    });
                };
                xhr.send(data);
            }
        });
    </script>
@stop
