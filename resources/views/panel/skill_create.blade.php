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
                <h4 class="card-title">Create New Skill</h4>
                <p class="card-description">
                    Complete This Form And Save It Until A New Skill Is Published.
                </p>
                <form class="forms-sample" method="post" action="{{ url('/dashboard/skills/store') }}">

                    @csrf

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Skill Title" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="skill">Skill Nmae</label>
                        <input type="text" name="skill" class="form-control" id="skill" placeholder="Skill Name" value="{{ old('skill') }}">
                    </div>
                    <div class="form-group">
                        <label for="skillen">Skill Nmae En</label>
                        <input type="text" name="skillen" class="form-control" id="skillen" placeholder="Skill Name En" value="{{ old('skillen') }}">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Skill Description" value="{{ old('description') }}">
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
        // $('#lfm1').filemanager('image');
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
@stop
