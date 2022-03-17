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
                <h4 class="card-title">Create New Link</h4>
                <form method="post" action="{{ url('dashboard/links/store') }}">
                    @csrf
                    <?php
                    $title = "";
                    $url = '';
                    $size = '';
                    if(old('title')){
                        $title = old('title');
                        $ulr = old('url');
                        $size = old('size');
                    }
                    else if(isset($data['link'])){
                        $title = $data['link']->title;
                        $url = $data['link']->url;
                        $size = $data['link']->size;
                    }
                    if(isset($data['link'])){
                        echo '<input type="hidden" name="id" value="'.$data['link']->id.'">';
                    }
                    ?>
                    <input type="hidden" name="lesson" value="{{ $data['lesson_id'] }}">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $title }}" class="form-control form-control-lg" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label>Size</label>
                        <input type="text" name="size" value="{{ $size }}" class="form-control form-control-lg" placeholder="Size">
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" name="url" value="{{ $url }}" class="form-control form-control-lg" placeholder="Url">
                    </div>

                    @if(isset($data['link']))
                    <a href="/dashboard/links/{{ $data['lesson_id'] }}" class="btn btn-danger">Cansel</a>
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
                        <th>Size</th>
                        <th>url</th>
                        <th>Options</th>
                    </tr>
                    @foreach($data['links'] as $link)
                        <tr data-id="{{ $link->id }}">
                            <td>{{ $link->id }}</td>
                            <td>{{ $link->title }}</td>
                            <td>{{ $link->size }}</td>
                            <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button>
                                    <a href="/dashboard/links/{{ $data['lesson_id'] }}?id={{ $link->id }}" type="button" class="btn btn-outline-info btn-sm"><i class="mdi mdi-pencil"></i> Edite</a>
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
                xhr.open('POST', "{{ url('dashboard/links/delete') }}", true);
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
