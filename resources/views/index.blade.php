@extends('layouts.app')

@section('title', ':: Login')

@push('styles')
    <link rel="stylesheet" href="custom/user/assets/app/custom/login/login-v1.demo3.css">
@endpush


@section('content')
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
            <div
                class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1"
                id="kt_login"
            >
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
                    {{--  begin::Aside --}}
                    <div
                        class="kt-grid__item bg-dark kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside"
                        style="
                        /* background-image: url({{asset('img/login-background.jpg')}});
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover; */

                    ">
                        <div class="kt-grid__item">
                            <a href="/" class="kt-login__logo">
                                <img src="assets/media/logos/logo-4.png" />
                            </a>
                        </div>
                        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
                            <div class="kt-grid__item kt-grid__item--middle bg-default p-5">
                                <h3 class="kt-login__title text-white text-uppercase">
                                    <strong
                                        style="letter-spacing: 1.5px"
                                    >
                                        Welcome to Indian Auto Company
                                        Telematics App!
                                    </strong>
                                </h3>
                                {{-- <h2 class="kt-login__subtitle text-white border p-4 text-justify">
                                    We Indian Auto Company makes your
                                    driving safer and smarter. Our
                                    Telematics System encourages your
                                    customers to track all their drivers
                                    by recording all their trips and
                                    maintaining their trip records to
                                    enhance their business. After each
                                    trip, Records are being maintained
                                    by our system to it can help you
                                    tracking your vehicle activity and
                                    live tracking.
                                </h2> --}}
                            </div>
                        </div>
                        <div class="kt-grid__item">
                            <div class="kt-login__info">
                                <div class="kt-login__copyright">
                                    © 2019,
                                    <a
                                        class="text-white pl-2"
                                        href="https://indianautocompany.com"
                                        target="_blank"
                                    >
                                        Indian Auto Company
                                    </a>
                                    , <br />
                                    <small>
                                        Powered By
                                        <a
                                            class="text-white pl-2"
                                            href="http://genyventures.in"
                                            target="_blank"
                                        >
                                            Gen Y Ventures
                                        </a>
                                    </small>
                                </div>
                                <div class="kt-login__menu">
                                    <a href="#" class="kt-link">
                                        Privacy
                                    </a>
                                    <a href="#" class="kt-link">
                                        Legal
                                    </a>
                                    <a href="#" class="kt-link">
                                        Contact
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  begin::Aside --}}
                    {{--  begin::Content --}}
                    <div
                        class="kt-grid__item kt-grid__item--fluid kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper"
                        style="
                        background-image: url({{asset('img/login-background.jpg')}});
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                        "
                    >
                        {{--  begin::Body --}}
                        <div class="kt-login__body">
                            {{--  begin::Signin --}}
                            <div class="kt-login__form">
                                <div class="kt-login__title">
                                    <h3 class="text-white text-uppercase">
                                        {{ __('Login') }}
                                    </h3>
                                </div>
                                {{--  begin::Form --}}
                                <form
                                    class="kt-form"
                                    method="POST"
                                    action="{{ route('login') }}"
                                >
                                @csrf
                                    <div class="form-group">
                                        <input
                                        id="email"
                                        type="text"
                                        class="form-control bg-white @error('email') is-invalid @enderror"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        autocomplete="email"
                                        autofocus
                                        style= "font-size: 1.3rem"
                                        placeholder="Email"
                                        />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input
                                            id="password"
                                            type="password"
                                            class="form-control bg-white @error('password') is-invalid @enderror"
                                            style="fontSize: 1.3rem"
                                            placeholder="Password"
                                            name="password" 
                                            required 
                                            autocomplete="current-password"
                                        />
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <br>
                                    <label class="kt-checkbox kt-checkbox--solid kt-checkbox--secondary text-secondary">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            {{ __('Remember Me') }}
                                            <span></span>
                                        </label>
                                    {{--  begin::Action --}}
                                    <div class="kt-login__actions">
                                            @if (Route::has('password.request'))   
                                        <a
                                            href="{{ route('password.request') }}"
                                            class="text-secondary"
                                        >
                                        {{ __('Forgot Your Password?') }}
                                        </a>
                                        @endif
                                        <button
                                            class="btn btn-brand btn-elevate kt-login__btn-primary text-uppercase btn-pill"
                                            type="submit"
                                        >
                                            <strong>{{ __('SIGN IN') }}</strong>
                                        </button>
                                    </div>
                                    {{--  end::Action --}}
                                </form>
                                {{--  end::Form --}}
                            </div>
                            {{--  end::Signin --}}
                        </div>
                        {{--  end::Body --}}
                    </div>
                    {{--  end::Content --}}
                </div>
            </div>
        </div>


@endsection