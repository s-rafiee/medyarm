<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/27/2019
 * Time: 5:26 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/25/2019
 * Time: 3:04 AM
 */
?>
@extends('panel.layouts.app')

@section('content')
    <div class="col-md-12 text-center">
        <h1 class="text-danger">Forbidden</h1>
        <h3>You don't have permission to access {{ URL::current() }} on this server.</h3>
    </div>
@stop
