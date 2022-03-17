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
                <h4 class="card-title">Create New Developer</h4>
                <form method="post" action="{{ url('dashboard/developers/store') }}">
                    @csrf
                    <?php
                    $name = "";
                    if(old('name')){
                        $name = old('name');
                    }
                    else if(isset($data['developer'])){
                        $name = $data['developer']->name;
                    }
                    if(isset($data['developer'])){
                        echo '<input type="hidden" name="id" value="'.$data['developer']->id.'">';
                    }
                    ?>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $name }}" class="form-control form-control-lg" placeholder="Name">
                    </div>
                    @if(isset($data['artist']))
                        <a href="/dashboard/developers/" class="btn btn-danger">Cansel</a>
                        <button type="submit" name="save" class="btn btn-info">Update</button>

                    @else
                        <button type="submit" name="save" class="btn btn-info">Add new Developer</button>
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
                <h4 class="card-title">Developers</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Options</th>
                    </tr>
                    @foreach($data['developers'] as $artist)
                        <tr data-id="{{ $artist->id }}">
                            <td>{{ $artist->id }}</td>
                            <td>{{ $artist->name }}</td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button>

                                    <a href="/dashboard/developers/?id={{ $artist->id }}" type="button" class="btn btn-outline-info btn-sm"><i class="mdi mdi-pencil"></i> Edite</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                @if($data['developers']->currentPage() > 1 or $data['developers']->hasMorePages() )
                    <div class="card-footer">
                        {{ $data['developers']->links() }}
                    </div>
                @endif
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
                xhr.open('POST', "{{ url('dashboard/developers/delete') }}", true);
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
        $('.btn-update').click(function () {
            var tag = $(this).parents('tr');
            var data = new FormData();
            data.append('_token', '{{ csrf_token() }}');
            data.append('id', $(this).parents('tr').attr('data-id'));
            if (window.XMLHttpRequest) {
                var xhr = new XMLHttpRequest();
            } else {
                var xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhr.open('POST', "{{ url('dashboard/developers/update-status') }}", true);
            xhr.onload = function () {alert(xhr.responseText);
                if(xhr.readyState == 4 && xhr.status == 200) {
                    if(xhr.responseText ==1){
                        tag.find('.btn-outline-warning').addClass('btn-outline-success');
                        tag.find('.mdi-eye-off-outline').addClass('mdi-eye-outline');
                        tag.find('.btn-outline-warning').removeClass('btn-outline-warning');
                        tag.find('.mdi-eye-off-outline').removeClass('mdi-eye-off-outline');
                    }else if(xhr.responseText ==0){
                        tag.find('.btn-outline-success').addClass('btn-outline-warning');
                        tag.find('.mdi-eye-outline').addClass('mdi-eye-off-outline');
                        tag.find('.btn-outline-success').removeClass('btn-outline-success');
                        tag.find('.mdi-eye-outline').removeClass('mdi-eye-outline');

                    }else{
                        modal_show("Error ",'<span class="text-danger">Error Checking Request, Code #500</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                    }
                }else{
                    modal_show("Error ",'<span class="text-danger">Error Checking Request, Code #500</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                }
            };
            xhr.send(data);
        });
    </script>

@stop
