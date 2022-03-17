<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/27/2019
 * Time: 2:20 AM
 */
?>
@extends('panel.layouts.auth')

@section('content')

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-transparent text-left p-5 text-center">
                            <img src="/images/users/saman rafiee.jpg" class="lock-profile-img" alt="img">
                            <form class="pt-5" method="post" action="{{ route('login.unlock') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="examplePassword1">Password to unlock</label>
                                    <input type="password" name="password"
                                           class="form-control text-center {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           required id="password" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-5">
                                    <button class="btn btn-block btn-success btn-lg font-weight-medium">
                                        Unlock
                                    </button>
                                </div>
                                <div class="mt-3 text-center">
                                    <a href="/dashboard/logout" class="auth-link text-white">Sign in using a different
                                        account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@stop
