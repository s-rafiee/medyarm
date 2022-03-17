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
                    <span class="float-left">Skills</span> <a href="/dashboard/skills/create" class="btn btn-outline-success">Create New Skill</a>
                </h4>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Skills Title</th>
                        <th>Skills fa & en</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    @foreach($data['skills'] as $skill)
                        <tr data-id="{{ $skill->id }}">
                            <td>{{ $skill->id }}</td>
                            <td>
                                <img src="{{ $skill->image }}" class="square">
                            </td>
                            <td>
                                {{ $skill->title }}
                            </td>
                            <td>
                                Name: {{ $skill->name }}<br>
                                Name En: {{ $skill->name_en }}
                            </td>
                            <td>{{ $skill->description }}</td>
                            <td>{{ date('M d, Y h:i:s', strtotime($skill->created_at)) }}</td>
                            <td>
                                <div class="btn-group active-options">
                                    <button type="button" class="btn btn-outline-<?php if($skill->active){ echo "success";} else{ echo "danger"; } ?> dropdown-toggle" data-toggle="dropdown">
                                        <?php if($skill->active){ echo "Active";} else{ echo "Deactivate"; } ?>
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
                                    <a href="/dashboard/courses/?skill={{ $skill->id }}" type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-paper-cut-vertical"></i><br> courses</a>
                                    <a href="/dashboard/skills/edit/{{ $skill->id }}" type="button" class="btn btn-outline-info btn-sm"><i class="mdi mdi-pencil"></i><br> Edite</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                @if($data['skills']->currentPage() > 1 or $data['skills']->hasMorePages() )
                    <div class="card-footer">
                        {{ $data['skills']->links() }}
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
                xhr.open('POST', "{{ url('dashboard/skills/delete') }}", true);
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
            xhr.open('POST', "{{ url('dashboard/skills/update/active') }}", true);
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
