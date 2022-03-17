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
                    <span class="float-left">Users</span> <a href="/dashboard/users/create" class="btn btn-outline-success">Create New User</a>
                </h4>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tr>
                    @foreach($data['users'] as $user)
                        <tr data-id="{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td><img src="{{ $user->image !=''? $user->image : url('panel/images/no-user-image.png') }}"></td>
                            <td>{{ $user->name }} {{ $user->family }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role_name }}</td>
                            <td>{{ date('M d, Y h:i:s', strtotime($user->created_at)) }}</td>
                            <td>
                                <div class="btn-group active-options">
                                    <button type="button" class="btn btn-outline-<?php if($user->active){ echo "success";} else{ echo "danger"; } ?> dropdown-toggle" data-toggle="dropdown">
                                        <?php if($user->active){ echo "Active";} else{ echo "Deactivate"; } ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" data-active="1">Active</a>
                                        <a class="dropdown-item" data-active="0">Deactivate</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-outline-danger btn-sm btn-delete"><i class="mdi mdi-trash-can-outline"></i> Delete</button>
                                    <a href="/dashboard/users/edit/{{ $user->id }}" type="button" class="btn btn-outline-info btn-sm"><i class="mdi mdi-pencil"></i> Edite</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
                @if($data['users']->currentPage() > 1 or $data['users']->hasMorePages() )
                    <div class="card-footer">
                        {{ $data['users']->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        $('.btn-delete').click(function () {
            if(confirm("Are You Sure You Want To Delete This Item?")){
                var tag = $(this).parents('tr');
                var data = new FormData();
                data.append('_token', '{{ csrf_token() }}');
                data.append('uid', $(this).parents('tr').attr('data-id'));
                if (window.XMLHttpRequest) {
                    var xhr = new XMLHttpRequest();
                } else {
                    var xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr.open('POST', "{{ url('dashboard/users/delete') }}", true);
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
        $('.active-options .dropdown-menu a').click(function () {
            var tag = $(this).parents('.btn-group').find('button');
            var data = new FormData();
            data.append('_token', '{{ csrf_token() }}');
            data.append('uid', $(this).parents('tr').attr('data-id'));
            data.append('active', $(this).attr('data-active'));

            if (window.XMLHttpRequest) {
                var xhr = new XMLHttpRequest();
            } else {
                var xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xhr.open('POST', "{{ url('dashboard/users/update/active') }}", true);
            xhr.onload = function () {
                if(xhr.readyState == 4 && xhr.status == 200) {
                    if(xhr.responseText ==1){
                        tag.removeClass('btn-outline-danger');
                        tag.addClass('btn-outline-success');
                        tag.html('Active');
                        modal_show("Success",'<span class="text-success">User Is Active</span>','<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>');
                    }else if(xhr.responseText ==0){
                        tag.addClass('btn-outline-danger');
                        tag.removeClass('btn-outline-success');
                        tag.html('Deactivate');
                        modal_show("Success",'<span class="text-danger">User Is Deactivate</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                    }else{
                        modal_show("Error ",'<span class="text-danger">User Not Found, Code #404</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                    }
                }else{
                    modal_show("Error ",'<span class="text-danger">Error Checking Request, Code #500</span>','<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>');
                }
            };
            xhr.send(data);
        });
    </script>
@stop