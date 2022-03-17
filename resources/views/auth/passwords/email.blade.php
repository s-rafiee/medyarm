@extends('layouts.app')

@section('content')
<div class="content-wrapper login d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                </div>
                <h4>{{ __('Reset Password') }}</h4>
                <h6 class="font-weight-light">Enter Emaail to continue.</h6>

                <form class="pt-3"  method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="text-danger text-monospace text-small" role="alert">{{ $errors->first('email') }}</span>
                        @endif
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">{{ __('Send Password Reset Link') }}</button>
                        @if (session('status'))
                            <span class="text-danger text-monospace text-small" role="alert">
                                {{ session('status') }}
                            </span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
