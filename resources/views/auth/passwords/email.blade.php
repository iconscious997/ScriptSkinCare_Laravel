@extends('layouts.app')

@section('content')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-t-50 p-b-90">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('password.email') }}">
                @csrf

                <span class="login100-form-title p-b-51">
                    Reset Password
                </span>


                <div class="wrap-input100 validate-input m-b-16" data-validate = "Email is required">
                    <input class="input100" id="email" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    <span class="focus-input100"></span>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-24">

                    <div>
                        <a href="{{ route('login') }}" class="txt1">
                            Back to Login?
                        </a>
                    </div>
                </div>

                <div class="container-login100-form-btn m-t-17">
                    <button class="login100-form-btn" type="submit">
                        Send Password Reset Link
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection
