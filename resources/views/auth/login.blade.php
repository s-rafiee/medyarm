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
            <div class="content-wrapper login d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                            </div>
                            <h4>{{ __("Hello! let's get started") }}</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                           placeholder="Email" name="email" value="{{ old('email') }}" required
                                           autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger text-monospace text-small"
                                              role="alert">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                           id="exampleInputPassword1" placeholder="Password" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="text-danger text-monospace text-small"
                                              role="alert">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">SIGN IN
                                    </button>
                                    @if ($errors->has('error_access'))
                                        <span class="text-danger text-monospace text-small"
                                              role="alert">{{ $errors->first('error_access') }}</span>
                                    @endif
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" name="remember"
                                                   class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                            Keep me signed in
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="auth-link text-black" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
