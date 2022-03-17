@extends('layouts.app')

@section('content')
    <div class="content-wrapper login d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <div class="brand-logo">
                    </div>
                    <h4>{{ __('Reset Password') }}</h4>
                    <h6 class="font-weight-light">Enter Email and New Password To Change Your Password.</h6>
                    <form class="pt-3"  method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" id="exampleInputemail" placeholder="Email" name="email" required>

                            @if ($errors->has('email'))
                                <span class="text-danger text-monospace text-small" role="alert">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="exampleInputemail" placeholder="password" name="password" required>

                            @if ($errors->has('password'))
                                <span class="text-danger text-monospace text-small" role="alert">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="password-confir" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">{{ __('Reset Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
