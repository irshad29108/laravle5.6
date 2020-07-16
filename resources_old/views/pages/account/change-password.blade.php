@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<style>
    #kt_content{
        margin-top: -40px;
    }
</style>
@endpush

@section('content')
{{-- Content Goes Here --}}
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor p-0" id="kt_content">
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--Begin::App-->
        <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
            <!--Begin:: App Aside Mobile Toggle-->
            <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                <i class="la la-close"></i>
            </button>
            <!--End:: App Aside Mobile Toggle-->
            
            
            {{-- SIDE PANEL --}}
            @include('pages.account.sidepanel')
            {{-- SIDE PANEL ENDS --}}
            
            <!--Begin:: App Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <form method="POST" action="{{route('account.update.password', $user->id)}}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">Change Password</h3>
                                    <button type="button" class="btn border-left ml-3" onclick="showPasswords()">
                                        <small>
                                            <i class="fa fa-eye"></i>
                                            SHOW PASSWORDS
                                        </small>
                                    </button>
                                </div>
                                <div class="btn-group d-block my-auto">
                                    <button type="submit" class="btn btn-brand btn-bold ml-3">
                                        <i class="fa fa-check-circle"></i> Save
                                    </button>
                                    <button type="reset" class="btn btn-secondary ml-3">
                                        <i class="la la-refresh"></i> RESET
                                    </button>
                                </div>
                            </div>
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-portlet__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="password" class="form-control" name="old_password" autocomplete="old_password" id="old_password" placeholder="Current password" value="{{old('old_password')}}" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="password" id="password" placeholder="New password" value="{{old('password')}}" />
                                                    @error('password')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group form-group-last row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Verify Password</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="password_confirmation" id="password_confirmation" placeholder="Verify password" value="{{old('password_confirmation')}}" />
                                                    @error('password_confirmation')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="kt-portlet__foot">
                                    <div class="kt-form__actions">
                                        <div class="row">
                                            <div class="col-lg-3 col-xl-3">
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--End:: App Content-->
        </div>
        <!--End::App-->
    </div>
    <!-- end:: Content -->
</div>
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script>
    "use strict";var KTUserProfile={init:function(){new KTOffcanvas("kt_user_profile_aside",{overlay:!0,baseClass:"kt-app__aside",closeBy:"kt_user_profile_aside_close",toggleBy:"kt_subheader_mobile_toggle"}),new KTAvatar("kt_user_avatar")}};KTUtil.ready(function(){KTUserProfile.init()});
    function showPasswords() {
        let passwords = $('.kt-section__body input');
        passwords.map(function(key, value) {
            if(value.getAttribute('type') == "password") {
                value.setAttribute('type', 'show');
            } else {
                value.setAttribute('type', 'password');
            }
        });
    }
</script>
@endpush