<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/23/2019
 * Time: 3:29 AM
 */
?>
@extends('panel.layouts.app')


@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body table-responsive pt-5">
                <h4 class="card-title text-right">
                    @if(isset($data['cours']))
                    <span class="float-left">Lessons For <span class="text-danger">{{ $data['cours']->name }}</span></span>
                    <a href="/dashboard/lessons/create?cours_id={{ $data['cours']->id }}" class="btn btn-outline-success">Create New Lesson For This Cours</a>
                    @else
                    <span class="float-left">lessons</span> <a href="/dashboard/lessons/create" class="btn btn-outline-success">Create New Lesson</a>
                    @endif
                </h4>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Details</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    @foreach($data['lessons'] as $post)
                        <tr data-id="{{ $post->id }}">
                            <td>{{ $post->id }}</td>
                            <td>
                                <img src="{{ $post->image }}" class="square">
                            </td>
                            <td>
                                <p class="text-success">En: {{ $post->title_en }}</p><hr>
                                <p class="text-info">Fa: {{ $post->title }}</p>
                            </td>
                            <td>{{ $post->description }}</td>
                            <td>
                                Visit: <span class="text-success">{{ $post->visit }}</span><br>
                                Cours Id: <span class="text-success">{{ $post->cours_id }}</span><br>
                                Off: <span class="text-success">{{ $post->off }} %</span><br>
                                Price: <span class="text-success">{{ $post->price }}</span><br>
                                time: <span class="text-success">{{ $post->time }}</span><br>
                            </td>
                            <td>{{ date('M d, Y h:i:s', strtotime($post->created_at)) }}</td>
                            <td>
                                <div class="btn-group active-options">
                                    <button type="button" class="btn btn-outline-<?php if($post->active){ echo "success";} else{ echo "danger"; } ?> dropdown-toggle" data-toggle="dropdown">
                                        <?php if($post->active){ echo "Active";} else{ echo "Deactivate"; } ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-active="1">Active</a>
                                        <a class="dropdown-item" data-active="0">Deactivate</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="mdi mdi-trash-can-outline"></i><br> Delete</button>
                                    <a href="/dashboard/links/{{ $post->id }}" type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-target"></i><br> Links</a>
                                    <a href="/dashboard/lessons/edit/{{ $post->id }}" type="button" class="btn btn-outline-info btn-sm"><i class="mdi mdi-pencil"></i><br> Edite</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                @if($data['lessons']->currentPage() > 1 or $data['lessons']->hasMorePages() )
                    <div class="card-footer">
                        {{ $data['lessons']->links() }}
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
                xhr.open('POST', "{{ url('dashboard/lessons/delete') }}", true);
                xhr.onload = function () {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        if(xhr.responseText ==1){
                            tag.remove();
                            modal_show("Success",'<span class="text-success">This Item Has Been Deleted.</span>','<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>');
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
    <script>
        $('.active-options .dropdown-menu a').click(function () {
            var tag = $(this).parents('.btn-group').find('button');
            var data = new FormData();
            data.append('_token', '{{ csrf_token() }}');
            data.append('id', $(this).parents('tr').attr('data-id'));
            data.append('active', $(this).attr('data-active'));

            if (window.XMLHttpRequest) {
                var xhr = new XMLHttpRequest();
            } else {
                var xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhr.open('POST', "{{ url('dashboard/lessons/update/active') }}", true);
            xhr.onload = function () {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    if(xhr.responseText ==1){
                        tag.removeClass('btn-outline-danger');
                        tag.addClass('btn-outline-success');
                        tag.html('Active');
                        modal_show("Success",'<span class="text-success">This Item Is Active</span>','<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>');
                    }else if(xhr.responseText ==0){
                        tag.addClass('btn-outline-danger');
                        tag.removeClass('btn-outline-success');
                        tag.html('Deactivate');
                        modal_show("Success",'<span class="text-danger">This Item Is Deactivate</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                    }else{
                        modal_show("Error ",'<span class="text-danger">This Item Not Found, Code #404</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                    }
                }else{
                    modal_show("Error ",'<span class="text-danger">Error Checking Request, Code #500</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                }
            };
            xhr.send(data);
        });
    </script>
@stop
