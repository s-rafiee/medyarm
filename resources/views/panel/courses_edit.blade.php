<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/26/2019
 * Time: 8:53 PM
 */
?>
@extends('panel.layouts.app')


@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Changed A Skill</h4>
                <p class="card-description">
                    Complete This Form And Save It Until Changed This Cours.
                </p>
                <form class="forms-sample" method="post"
                      action="{{ url('/dashboard/courses/edit/'.$data['cours']->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Post Title"
                               value="{{ old('title') ? old('title') : $data['cours']->title }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Skill Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Cours Name"
                               value="{{ old('name') ? old('name') : $data['cours']->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name_en">Cours Name En</label>
                        <input type="text" name="name_en" class="form-control" id="name_en" placeholder="Cours Name En"
                               value="{{ old('name_en') ? old('name_en') : $data['cours']->name_en }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description"
                               placeholder="Post Description"
                               value="{{ old('description') ? old('description') : $data['cours']->description }}">
                    </div>
                    <div class="form-group">
                        <label>Image upload</label>
                        <div class="input-group col-xs-12">
                            <input type="text" name="image" class="form-control" id="selected-image"
                                   placeholder="Image URL"
                                   value="{{ old('image') ? old('image') : $data['cours']->image }}">
                            <span class="input-group-append">
                                <button id="lfm" data-input="selected-image" data-preview="holder"
                                        class="btn btn-sm btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="body">Text</label>
                        <textarea class="editor" class="form-control"
                                  name="body">{{ old('body') ? old('body') : $data['cours']->body }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Cours Price (Tomans) </label>
                        <input type="text" name="price" class="form-control" id="price" placeholder="Cours Price"
                               value="{{ old('price') ? old('price') : $data['cours']->price }}">
                    </div>

                    <div class="form-group">
                        <label for="off">Cours Off (Tomans)</label>
                        <input type="text" name="off" class="form-control" id="off" placeholder="Cours Off"
                               value="{{ old('off') ? old('off') : $data['cours']->off }}">
                    </div>

                    <div class="form-group">
                        <label for="price_type">Possibility to Sell a Single Lesson</label>
                        <input type="checkbox" name="price_type" id="price_type">
                    </div>
                    <div class="form- row">
                        <label class="col-sm-3 col-form-label">How to Sell?</label>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="howsell" id="howsell1" value="0" <?php $howsell = old('howsell') ? old('howsell') : $data['cours']->howsell; if(!$howsell){echo 'checked'; } ?>>
                                    Possibility to Sell a Single Lesson<i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="howsell" id="howsell2" value="1" <?php $howsell = old('howsell') ? old('howsell') : $data['cours']->howsell; if($howsell){echo 'checked'; } ?>>
                                    Impossibility of selling a single lesson<i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="skill">Skill</label>
                        <select class="form-control" id="skill" name="skill">
                            @foreach($data['skills'] as $skill)
                                <option value="{{ $skill->id }}" <?php if ($data['cours']->skill_id == $skill->id) {
                                    echo 'selected="selected"';
                                } ?>>{{ $skill->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="level" name="level">
                            <option value="1" <?php if (strlen(old('level'))) {
                                if (old('level') == 1) {
                                    echo 'selected="selected"';
                                }
                            } else {
                                if ($data['cours']->level == 1) {
                                    echo 'selected="selected"';
                                }
                            } ?>>مقدماتی
                            </option>
                            <option value="2" <?php if (strlen(old('level'))) {
                                if (old('level') == 2) {
                                    echo 'selected="selected"';
                                }
                            } else {
                                if ($data['cours']->level == 2) {
                                    echo 'selected="selected"';
                                }
                            } ?>>متوسط
                            </option>
                            <option value="3" <?php if (strlen(old('level'))) {
                                if (old('level') == 3) {
                                    echo 'selected="selected"';
                                }
                            } else {
                                if ($data['cours']->level == 3) {
                                    echo 'selected="selected"';
                                }
                            } ?>>پیشرفته
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="1" <?php if (strlen(old('type'))) {
                                if (old('type') == 1) {
                                    echo 'selected="selected"';
                                }
                            } else {
                                if ($data['cours']->type == 1) {
                                    echo 'selected="selected"';
                                }
                            } ?>>متنی
                            </option>
                            <option value="2" <?php if (strlen(old('type'))) {
                                if (old('type') == 2) {
                                    echo 'selected="selected"';
                                }
                            } else {
                                if ($data['cours']->type == 2) {
                                    echo 'selected="selected"';
                                }
                            } ?>>ویدیو
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="publish">Publish</label>
                        <select class="form-control" id="publish" name="publish">
                            <option value="1" <?php if (strlen(old('publish'))) {
                                if (old('publish') == 1) {
                                    echo 'selected="selected"';
                                }
                            } else {
                                if ($data['cours']->publish == 1) {
                                    echo 'selected="selected"';
                                }
                            } ?>>در حال انتشار
                            </option>
                            <option value="2" <?php if (strlen(old('publish'))) {
                                if (old('publish') == 2) {
                                    echo 'selected="selected"';
                                }
                            } else {
                                if ($data['cours']->publish == 2) {
                                    echo 'selected="selected"';
                                }
                            } ?>>منتشر شده
                            </option>
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
    <script src="/panel/vendors/ckeditor-5/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.editor'), {
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
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@stop
