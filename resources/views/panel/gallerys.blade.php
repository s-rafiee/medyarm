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
                <form method="post" action="{{ url('dashboard/gallerys/store') }}">
                    @csrf
                    <?php
                    $url = '';
                    if(old('url')){
                        $ulr = old('url');
                    }
                    else if(isset($data['gallery'])){
                        $url = $data['gallery']->url;
                    }
                    if(isset($data['gallery'])){
                        echo '<input type="hidden" name="id" value="'.$data['gallery']->id.'">';
                    }
                    ?>
                    <input type="hidden" name="post" value="{{ $data['post_id'] }}">
                    <div class="form-group">
                        <label>Image upload</label>
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control" id="url" placeholder="Image URL" name="url" value="{{ $url }}" >
                            <span class="input-group-append">
                                <button id="lfm" data-input="url" data-preview="holder" class="btn btn-sm btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>

                    @if(isset($data['link']))
                    <a href="/dashboard/gallerys/{{ $data['post_id'] }}" class="btn btn-danger">Cansel</a>
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
                        <th>Image</th>
                        <th>Options</th>
                    </tr>
                    @foreach($data['gallerys'] as $link)
                        <tr data-id="{{ $link->id }}">
                            <td>{{ $link->id }}</td>
                            <td><img src="{{ $link->url }}" style="width:200px; height:100px; border-radius: 0px"></td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button>
                                    <a href="/dashboard/gallerys/{{ $data['post_id'] }}?id={{ $link->id }}" type="button" class="btn btn-outline-info btn-sm"><i class="mdi mdi-pencil"></i> Edite</a>
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
    <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');
    </script>
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
                xhr.open('POST', "{{ url('dashboard/gallerys/delete') }}", true);
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
