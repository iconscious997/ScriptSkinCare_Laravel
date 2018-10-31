@extends('layouts.app')

@section('content')

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form" method="POST" action="{{ route('login') }}">
                @csrf
                <span class="login100-form-title p-b-49">Script Skincare Manager</span>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Name</span>
                    <input class="input100" id="name" type="text" placeholder="Type your Email Address" name="name" value="{{ old('name') }}" required autofocus>
                    <span class="focus-input100" data-symbol=""></span>
                    
                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="wrap-input100 validate-input m-b-23">
                    <span class="label-input100">Email</span>
                    <input class="input100" id="email" type="email" placeholder="Type your Email Address" name="email" value="{{ old('email') }}" required autofocus>
                    <span class="focus-input100" data-symbol=""></span>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="wrap-input100 validate-input">
                    <span class="label-input100">Password</span>
                    <input class="input100" id="password" type="password" name="password" placeholder="Type your password" autocomplete="off">
                    <span class="focus-input100" data-symbol=""></span>
                </div>

                <div class="wrap-input100 validate-input">
                    <span class="label-input100">Confirm Password</span>
                    <input class="input100" id="password" type="password" name="password" placeholder="Type your Confirm password" autocomplete="off">
                    <span class="focus-input100" data-symbol=""></span>
                </div>

                <div class="text-right p-t-8 p-b-31">
                    <a href="{{ route('password.request') }}">
                        Forget Password ?
                    </a>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn" type="submit"> Register</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
