<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/27/2019
 * Time: 2:20 AM
 */
?>
@extends('panel.layouts.app')

@section('content')
    <div class="col-md-5 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New Category</h4>
                <form method="post" action="{{ url('dashboard/cats/store') }}">
                    @csrf
                    <?php
                    $title = "";
                    $title_en = "";
                    $parent = 0;
                    if(old('title')){
                        $title = old('title');
                    }
                    else if(isset($data['cat'])){
                        $title = $data['cat']->title;
                    }
                    if(old('title_en')){
                        $title_en = old('title_en');
                    }
                    else if(isset($data['cat'])){
                        $title_en = $data['cat']->title_en;
                    }
                    if(old('parent')){
                        $parent = old('parent');
                    }else if(isset($data['cat'])){
                        $parent = $data['cat']->parent;
                    }
                    if(isset($data['cat'])){
                        echo '<input type="hidden" name="id" value="'.$data['cat']->id.'">';
                    }
                    ?>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $title }}" class="form-control form-control-lg" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label>Title En</label>
                        <input type="text" name="title_en" value="{{ $title_en }}" class="form-control form-control-lg" placeholder="Title En">
                    </div>
                    <div class="form-group">
                        <label>Parent Category</label>
                        <select class="form-control form-control-lg" name="parent">
                            <option value="0">Not Categorized</option>
                            @foreach($data['cats'] as $cat)
                                @if((isset($data['cat']) and $data['cat']->id != $cat->id and $cat->parent ==0) or (!isset($data['cat']) and $cat->parent==0))
                                    <option value="{{ $cat->id }}" {{ $parent == $cat->id ? 'selected="selected"':'' }}>{{ $cat->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    @if(isset($data['cat']))
                    <a href="/dashboard/cats/" class="btn btn-danger">Cansel</a>
                        <button type="submit" name="save" class="btn btn-info">Update</button>

                    @else
                        <button type="submit" name="save" class="btn btn-info">Add new Category</button>
                    @endif

                    @if (Session::has('success'))
                        <span class="text-success">{{ Session::get('success') }}</span>
                    @elseif (Session::has('error'))
                        <span class="text-danger">{{ Session::get('error') }}</span>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Categories</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Title En</th>
                        <th>Parent</th>
                        <th>Options</th>
                    </tr>
                    @foreach($data['cats'] as $cat)
                        <tr data-id="{{ $cat->id }}">
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->title }}</td>
                            <td>{{ $cat->title_en}}</td>
                            <td>{{ $cat->parent }}</td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button>
                                    <a href="/dashboard/cats/?id={{ $cat->id }}" type="button" class="btn btn-outline-info btn-sm"><i class="mdi mdi-pencil"></i> Edite</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
        $('.btn-delete').click(function () {
            if(confirm("Are You Sure You Want To Delete This Item?")){
                var tag = $(this).parents('tr');
                var data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                data.append('id', $(this).parents('tr').attr('data-id'));
                if (window.XMLHttpRequest) {
                    var xhr = new XMLHttpRequest();
                } else {
                    var xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr.open('POST', "{{ url('dashboard/cats/delete') }}", true);
                xhr.onload = function () {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        if(xhr.responseText ==1){
                            tag.remove();
                            modal_show("Success",'<span class="text-success">The User Has Been Deleted.</span>','<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>');
                        }else{
                            modal_show("Error ",'<span class="text-danger">Error Checking Request, Code #500</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                        }
                    }else{
                        modal_show("Error ",'<span class="text-danger">Error Checking Request, Code #500</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                    }
                };
                xhr.send(data);
            }
        });
    </script>
@stop
