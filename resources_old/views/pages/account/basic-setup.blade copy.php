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
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title">Basic Setup</h3>
                                </div>
                                <small class="kt-portlet__head-label">Edit basic setup.</small>
                            </div>
                            
                            {{-- CONTENT GOES HERE --}}

                        </div>
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
</script>
@endpush