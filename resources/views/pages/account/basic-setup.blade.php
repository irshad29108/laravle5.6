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
                                <form method="post" action="{{route('account.update.basic_setup', $user->id)}}">
                                        @csrf
                                        @method('put')
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            <i class="fa fa-wrench"></i> &nbsp;
                                            Basic Setup
                                        </h3>
                                    </div>
                                    <div class="btn-group d-block my-auto">
                                        <button type="submit" class="btn btn-brand btn-bold">
                                            <i class="fa fa-check-circle"></i> Save
                                        </button>
                                    </div>
                                </div>
                                
                                {{-- CONTENT GOES HERE --}}
                                
                                
                                {{-- Basic Setup --}}
                                <div class="kt-grid__item kt-grid__item--fluid kt-app__content px-3 py-4">
                                    <div class="kt-form__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <div class="row">
                                                    <label class="col-xl-3"></label>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                        Time Zone :
                                                    </label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control col-6" name="time_zone">
                                                            <option value="0">Select Timezone</option>
                                                            @foreach ($timezones as $timezone)
                                                            <option value="{{$timezone->id}}" {{$loop->iteration == 1 || old('time_zone') == $timezone->id ? 'selected="selected"' : ''}}>{{$timezone->type}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                        Date Format :
                                                    </label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control col-6" name="date_format">
                                                            <option>Select</option>
                                                            <option>DD-MM-YYYY</option>
                                                            <option>MM-DD-YYYY</option>
                                                            <option>YYYY-MM-DD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                        Time Format :
                                                    </label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control col-6" name="time_format">
                                                            <option>Select</option>
                                                            <option selected>24 - Hours</option>
                                                            <option>12 - Hours</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">
                                                        User Status
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline mt-0">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="user_status" value="1" checked />
                                                                Active
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="user_status" value="2" />
                                                                Inactive
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0">
                                                    <label class="col-3 col-form-label">
                                                        Store User Action
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <div class="col-3 px-0">
                                                                <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                    <label>
                                                                        <input type="checkbox" checked name="user_action" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-0">
                                                    <label class="col-3 col-form-label">
                                                        Show Default Filter
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <div class="col-3 px-0">
                                                                <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                    <label>
                                                                        <input type="checkbox" checked name="default_filter" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">
                                                        Smooth Live Tracking
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <div class="col-3 px-0">
                                                                <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                    <label>
                                                                        <input type="checkbox" checked name="smooth_tracking" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">
                                                        Show Country Border
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <div class="col-3 px-0">
                                                                <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                    <label>
                                                                        <input type="checkbox" checked name="country_border" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">
                                                        Disputed Region
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <select class="form-control col-6" name="disputed_region">
                                                                <option>Select</option>
                                                                <option data-offset={-39600} value="1" selected="selected">
                                                                    India
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">
                                                        Immobilization
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" checked name="immobilization" value="1" />
                                                                On
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="immobilization" value="2" />
                                                                Off
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">
                                                        Web Access
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="web_access" value="1" checked />
                                                                On
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="web_access" value="2" />
                                                                Off
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-3 col-form-label">
                                                        Mobile Access
                                                    </label>
                                                    <div class="col-9">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mobile_access" value="1" checked />
                                                                All
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mobile_access" value="2" />
                                                                None
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" name="mobile_access" value="3" />
                                                                Specific
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Basic Setup Ends --}}
                                
                                
                                {{-- CONTENT ENDS HERE --}}
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
</script>
@endpush