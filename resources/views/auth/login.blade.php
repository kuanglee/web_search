@extends('layouts.app')

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form" >
                    @csrf
                    <span class="login100-form-title p-b-26">
						Welcome
					</span>
                    <span class="login100-form-title p-b-48">
						<i class="zmdi zmdi-font"></i>
					</span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <input id="email" type="email"  class="input100" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="focus-input100" data-placeholder="Email" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
							<i class="zmdi zmdi-eye" ></i>
						</span>


                        <input id="password" type="password" class="input100" name="password" data-placeholder="Password" required autocomplete="current-password">
                        <span class="focus-input100" ></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                            {{--@if (Route::has('password.request'))--}}
                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--{{ __('Forgot Your Password?') }}--}}
                                {{--</a>--}}
                            {{--@endif--}}

                    <div class="text-center p-t-115">
						<span class="txt1">
							Don’t have an account?
						</span>

                        <a class="txt2" href="#">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
