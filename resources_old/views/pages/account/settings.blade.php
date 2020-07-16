@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.css">
<style>
    #kt_content{
        margin-top: -40px;
    }
    .ms-choice {
        border: none;
    }
    .kt-form.kt-form--label-right .form-group label:not(.kt-checkbox):not(.kt-radio):not(.kt-option) {
        text-align: left;
    }
    .ms-choice > span, .ms-choice > div {
        top: 5px;
    }
    .ms-drop.bottom {
        left: 0;
    }
    div.card.card-body.rounded-0 {
        display: block !important;
    }
    .kt-demo-panel.kt-demo-panel--on {
        right: 0;
        left: auto;
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
            <form method="post" action="{{route('account.update.settings', $user->id)}}">
                @csrf
                @method('put')
                <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                                <i class="fa fa-cog"></i> &nbsp;
                                            Settings                                            
                                        </h3>
                                    </div>
                                    <div class="btn-group d-block my-auto">
                                        <button type="submit" class="btn btn-brand btn-bold">
                                            <i class="fa fa-check-circle"></i> Save
                                        </button>
                                    </div>
                                </div>
                                
                                {{-- CONTENT GOES HERE --}}
                                
                                {{-- begin:: Content --}}
                                <div class="kt-content  kt-grid__item kt-grid__item--fluid my-3" id="kt_content">
                                    <div class="kt-portlet kt-portlet--tabs">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-toolbar">
                                                <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#rule" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x='0' y="0" width="24" height="24"></rect>
                                                                    <path
                                                                    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
                                                                    id="Combined-Shape" fill="#000000"></path>
                                                                    <path
                                                                    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
                                                                    id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                                                </g>
                                                            </svg>
                                                            &nbsp; Rule
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#screen_access" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                    <path
                                                                    d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                                                    id="check" fill="#000000" fillRule="nonzero" opacity="0.3"></path>
                                                                    <path
                                                                    d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                                                    id="Combined-Shape" fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            &nbsp; Screen Access
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#data_access" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                    <path
                                                                    d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z"
                                                                    id="Combined-Shape" fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            &nbsp; Data Access
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#map" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                    <path
                                                                    d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z"
                                                                    id="Combined-Shape" fill="#000000" fillRule="nonzero"></path>
                                                                </g>
                                                            </svg>
                                                            &nbsp; Map
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#email" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                    <path
                                                                    d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                                    id="Combined-Shape" fill="#000000"></path>
                                                                    <circle id="Oval" fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
                                                                </g>
                                                            </svg>
                                                            &nbsp; Email
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#sms" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                    <path
                                                                    d="M14.486222,18 L12.7974954,21.0565532 C12.530414,21.5399639 11.9220198,21.7153335 11.4386091,21.4482521 C11.2977127,21.3704077 11.1776907,21.2597005 11.0887419,21.1255379 L9.01653358,18 L5,18 C3.34314575,18 2,16.6568542 2,15 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,16.6568542 20.6568542,18 19,18 L14.486222,18 Z"
                                                                    id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                                                    <path
                                                                    d="M6,7 L15,7 C15.5522847,7 16,7.44771525 16,8 C16,8.55228475 15.5522847,9 15,9 L6,9 C5.44771525,9 5,8.55228475 5,8 C5,7.44771525 5.44771525,7 6,7 Z M6,11 L11,11 C11.5522847,11 12,11.4477153 12,12 C12,12.5522847 11.5522847,13 11,13 L6,13 C5.44771525,13 5,12.5522847 5,12 C5,11.4477153 5.44771525,11 6,11 Z"
                                                                    id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                                                </g>
                                                            </svg>
                                                            &nbsp; SMS
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#payment_gateway" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                    <rect id="Rectangle" fill="#000000" opacity="0.3" x="4" y="11" width="17" height="2" rx="1"></rect>
                                                                    <path
                                                                    d="M12.06,19.16 C10,19.16 8.28,18.16 7.44,16.96 L8.82,15.76 C9.5,16.64 10.66,17.42 12.04,17.42 C13.68,17.42 14.72,16.66 14.72,15.42 C14.72,14.12 13.92,13.44 12.4,12.78 L11.1,12.22 C8.94,11.3 8,9.98 8,8.2 C8,6.04 10.04,4.64 12.14,4.64 C13.8,4.64 15.16,5.3 16.12,6.46 L14.84,7.74 C14.1,6.86 13.32,6.38 12.08,6.38 C10.88,6.38 9.82,7.06 9.82,8.24 C9.82,9.28 10.42,9.98 11.92,10.64 L13.22,11.2 C15.14,12.04 16.56,13.22 16.56,15.22 C16.56,17.54 14.84,19.16 12.06,19.16 Z"
                                                                    id="S" fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            &nbsp; Payment Gateway
                                                        </a>
                                                    </li>
                                                    <li class="nav-item mx-0 mr-3">
                                                        <a class="nav-link" data-toggle="tab" href="#rename_label" role="tab" aria-selected="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                                                                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                    <circle id="Oval-Copy" fill="#000000" opacity="0.3" cx="5" cy="12" r="3"></circle>
                                                                    <g id="ic_type-copy-6" transform="translate(6.000000, 4.000000)">
                                                                        <rect id="bound" x="0" y="0" width="16" height="16"></rect>
                                                                        <path
                                                                        d="M9,5 L9,12 C9,12.5522847 8.55228475,13 8,13 L8,13 C7.44771525,13 7,12.5522847 7,12 L7,5 L5,5 C4.44771525,5 4,4.55228475 4,4 L4,4 C4,3.44771525 4.44771525,3 5,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,4 C12,4.55228475 11.5522847,5 11,5 L9,5 Z"
                                                                        id="T" fill="#000000"></path>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            &nbsp; Rename Label
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body">
                                            <div class="tab-content">
                                                {{-- Rule Starts --}}
                                                <div class="tab-pane active" id="rule" role="tabpanel">
                                                    <div class="col-lg-12">
                                                        <div class="kt-form kt-form--label-right">
                                                            <div class="kt-form__body">
                                                                <div class="kt-section kt-section--first">
                                                                    <div class="kt-section__body">
                                                                        <div class="form-group form-group-last row">
                                                                            <div class="col-lg-9 col-xl-6">
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--primary">
                                                                                    <a href="javascript:;" class="btn btn-primary" id="kt_form_button">
                                                                                        <i class="flaticon2-add"></i>
                                                                                        ADD RULES
                                                                                    </a>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                                                        <div class="row">
                                                                            <div class="kt-portlet__body col-12">
                                                                                {{--begin: Datatable --}}
                                                                                <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_2">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>S. No.</th>
                                                                                            <th>Rule Name</th>
                                                                                            <th>Descriptiion</th>
                                                                                            <th>Valid From</th>
                                                                                            <th>Created On</th>
                                                                                            <th>Action</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($userRules as $rule)
                                                                                        <tr>
                                                                                            <td>{{$loop->iteration}}</td>
                                                                                            <td>{{$rule->rule_name}}</td>
                                                                                            <td>{{$rule->description}}</td>
                                                                                            <td>{{Carbon\Carbon::parse($rule->valid_from)->format('d, M Y')}}</td>
                                                                                            <td>{{Carbon\Carbon::parse($rule->created_at)->format('d, M Y || H:i:s')}}</td>
                                                                                            <td class="text-center">
                                                                                                <a class="btn btn-danger pr-2">
                                                                                                    <i class="flaticon2-trash text-white"></i>
                                                                                                </a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endforeach
                                                                                        
                                                                                    </tbody>
                                                                                </table>
                                                                                {{--end: Datatable --}}
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Rule Ends --}}
                                                {{-- Screen Access --}}
                                                <div class="tab-pane" id="screen_access" role="tabpanel">
                                                    <div class="kt-form kt-form--label-right">
                                                        <div class="kt-form__body">
                                                            <div class="kt-section kt-section--first">
                                                                <div class="kt-section__body">
                                                                    <div class="row">
                                                                        <label class="col-xl-3"></label>
                                                                    </div>
                                                                    {{-- Content Goes Here --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Screen Access Ends --}}
                                                {{-- Data Access --}}
                                                <div class="tab-pane" id="data_access" role="tabpanel">
                                                    <div class="kt-form kt-form--label-right">
                                                        <div class="kt-form__body">
                                                            <div class="kt-section kt-section--first">
                                                                <div class="kt-section__body">
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            Alerts :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <select class="form-control col-6 multiselect" name="alerts[]">
                                                                                @foreach ($alerttypes as $alerttype)
                                                                                <option value="{{$alerttype->id}}">{{$alerttype->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label" for="gps">
                                                                            GPS Device :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <select class="form-control col-6 multiselect" name="gps[]">
                                                                                <option value="1">IAC 101</option>
                                                                                <option value="2">IAC 140</option>
                                                                                <option value="3">IAC 140 CAN</option>
                                                                                <option value="4">IAC 102</option>
                                                                                <option value="5">IAC 104</option>
                                                                                <option value="6">IAC 103</option>
                                                                                <option value="7">IAC 105</option>
                                                                                <option value="8">IAC 106</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            Default Language :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <select  id="default_language" class="form-control col-6" name="default_language">
                                                                                <option>Select</option>
                                                                                <option selected>English</option>
                                                                                <option>Hindi</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Data Access Ends --}}
                                                {{-- Map --}}
                                                <div class="tab-pane" id="map" role="tabpanel">
                                                    <div class="kt-form kt-form--label-right">
                                                        <div class="kt-form__body">
                                                            <div class="kt-section kt-section--first">
                                                                <div class="kt-section__body">
                                                                    <div id="kt_repeater_maps">
                                                                        <div class="form-group form-group-last row" id="kt_repeater_maps">
                                                                            <h5 class="col-lg-12 text-left border-bottom pb-3">
                                                                                Add Map:
                                                                            </h5>
                                                                            <br />
                                                                            <div class="col-lg-12 addMapForm">
                                                                                <div data-repeater-list class="form-group row align-items-center">
                                                                                    <div data-repeater-item class="card card-body rounded-0 container-fluid">
                                                                                        <div class="row ">
                                                                                            <div class="col-12 p-3">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="kt-form__group--inline">
                                                                                                            <div class="kt-form__label">
                                                                                                                <label>Map:</label>
                                                                                                            </div>
                                                                                                            <div class="kt-form__control">
                                                                                                                <select  id="map_type" class="form-control map" name="map_type">
                                                                                                                    @foreach ($maps as $map)
                                                                                                                    <option value="{{$map->id}}">{{$map->type}}</option>
                                                                                                                    @endforeach
                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="d-md-none kt-margin-b-10"></div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="kt-form__group--inline">
                                                                                                            <div class="kt-form__label">
                                                                                                                <label class="kt-label m-label--single">
                                                                                                                    Key:
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            <div class="kt-form__control">
                                                                                                                <input type="text" class="form-control map_key" placeholder="Enter contact number" />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="d-md-none kt-margin-b-10"></div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="kt-form__group--inline">
                                                                                                            <div class="kt-form__label">
                                                                                                                <label class="kt-label m-label--single">
                                                                                                                    Map Project ID:
                                                                                                                </label>
                                                                                                            </div>
                                                                                                            <div class="kt-form__control">
                                                                                                                <input type="text" class="form-control map_project_id" placeholder="Enter contact number" />
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="d-md-none kt-margin-b-10"></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-12 p-3">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="kt-radio-inline">
                                                                                                            <label class="kt-checkbox kt-checkbox--state-success">
                                                                                                                <input type="checkbox" class="map_address_from_map_provider" checked value="1" />
                                                                                                                Address From Map
                                                                                                                Provider
                                                                                                                <span class="bg-primary"></span>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="kt-radio-inline">
                                                                                                            <label class="kt-checkbox kt-checkbox--state-success">
                                                                                                                <input type="checkbox" class="map_speed_limit_api" checked value="1" />
                                                                                                                Speed Limit API
                                                                                                                <span class="bg-primary"></span>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="kt-radio-inline">
                                                                                                            <label class="kt-checkbox kt-checkbox--state-success">
                                                                                                                <input type="checkbox" class="map_default" checked value="1" />
                                                                                                                Default
                                                                                                                <span class="bg-primary"></span>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-12 pt-3">
                                                                                                        <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
                                                                                                            <i class="la la-trash-o"></i>
                                                                                                            Delete
                                                                                                        </a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-group form-group-last row">
                                                                                    <div class="col-lg-12">
                                                                                        <a href="javascript:;" data-repeater-create class="btn btn-bold btn-sm btn-label-brand px-3">
                                                                                            <i class="la la-plus"></i> Add
                                                                                        </a>
                                                                                        <a href="javascript:;"  onclick="addMapToUser()" class="btn btn-bold btn-sm btn-label-brand px-3 ml-3">
                                                                                            <i class="la la-check"></i> Save
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                                        <div class="map-data">
                                                            {{-- MAP Data Starts Here  --}}
                                                            <div class="kt-portlet kt-portlet--mobile">
                                                                <div class="kt-portlet__head">
                                                                    <div class="kt-portlet__head-label">
                                                                        <h3 class="kt-portlet__head-title">
                                                                            Map Saved
                                                                        </h3>
                                                                    </div>
                                                                    <div class="kt-portlet__head-toolbar">
                                                                        <div class="kt-portlet__head-toolbar-wrapper">
                                                                            <div class="dropdown dropdown-inline">
                                                                                <button type="button" class="btn btn-brand btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                    <i class="la la-plus"></i> Tools
                                                                                </button>
                                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                                    <ul class="kt-nav">
                                                                                        <li class="kt-nav__section kt-nav__section--first">
                                                                                            <span class="kt-nav__section-text">
                                                                                                Map
                                                                                            </span>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link" id="export_print">
                                                                                                <i class="kt-nav__link-icon la la-print"></i>
                                                                                                <span class="kt-nav__link-text">
                                                                                                    Print
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link" id="export_copy">
                                                                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                                                                <span class="kt-nav__link-text">
                                                                                                    Copy
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link" id="export_excel">
                                                                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                                                                <span class="kt-nav__link-text">
                                                                                                    Excel
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link" id="export_csv">
                                                                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                                                                <span class="kt-nav__link-text">
                                                                                                    CSV
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <li class="kt-nav__item">
                                                                                            <a href="#" class="kt-nav__link" id="export_pdf">
                                                                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                                                <span class="kt-nav__link-text">
                                                                                                    PDF
                                                                                                </span>
                                                                                            </a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="kt-portlet__body">
                                                                    {{--begin: Datatable --}}
                                                                    <table class="table table-striped- table-bordered table-hover table-checkable mapTable" id="kt_table_2">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>S. No.</th>
                                                                                <th>Map</th>
                                                                                <th>Key</th>
                                                                                <th>Map Project ID</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="mapTbody">
                                                                            @foreach ($userMaps as $userMap)
                                                                            <tr>
                                                                                <td>{{$loop->iteration}}</td>
                                                                                <td>{{App\Models\MapMaster::find($userMap->map_id)->type}}</td>
                                                                                <td>{{$userMap->key}}</td>
                                                                                <td>{{$userMap->map_project_id}}</td>
                                                                                <td class="text-center">
                                                                                    <a class="btn btn-danger pr-2">
                                                                                        <i class="flaticon2-trash text-white"></i>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                    {{--end: Datatable --}}
                                                                </div>
                                                            </div>
                                                            
                                                            {{-- MAP Data Ends Here --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Map Ends --}}
                                                {{-- Email --}}
                                                <div class="tab-pane" id="email" role="tabpanel">
                                                    <div class="kt-form kt-form--label-right">
                                                        <div class="kt-form__body">
                                                            <div class="kt-section kt-section--first">
                                                                <div class="kt-section__body">
                                                                    <div class="alert alert-solid-danger alert-bold fade show kt-margin-t-20 kt-margin-b-40 col-8 border" role="alert">
                                                                        <div class="alert-icon">
                                                                            <i class="fa fa-exclamation-triangle text-danger"></i>
                                                                        </div>
                                                                        <div class="alert-text">
                                                                            To use this service user have to fill
                                                                            all these mandatory fields.
                                                                        </div>
                                                                        <div class="alert-close">
                                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                <span aria-hidden="true">
                                                                                    <i class="la la-close"></i>
                                                                                </span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label class="col-xl-3"></label>
                                                                        {{-- <div class="col-lg-9 col-xl-6">
                                                                            <h3 class="kt-section__title kt-section__title-sm">
                                                                                Change Or Recover Your Password:
                                                                            </h3>
                                                                        </div> --}}
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            From Email Address :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <input class="form-control col-6" type="email" name="email_email_address" placeholder="Enter Email Address" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            User Name :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <input class="form-control col-6" type="text" name="email_user_name" placeholder="Enter User Name" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            Password :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <input class="form-control col-6" type="password" name="email_password" placeholder="******" autocomplete="off" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            Host Name :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <input class="form-control col-6" type="text" name="email_host_name" placeholder="Enter Host Name" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            Outgoing Port :
                                                                        </label>
                                                                        <div class="col-lg-9 col-xl-6">
                                                                            <input class="form-control col-6" type="text" name="email_outgoing_port" placeholder="Enter Outgoing port.." />
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row mb-0">
                                                                        <label class="col-3 col-form-label">
                                                                            SMTP Authentication :
                                                                        </label>
                                                                        <div class="col-9">
                                                                            <div class="kt-radio-inline">
                                                                                <div class="col-3 px-0">
                                                                                    <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                        <label>
                                                                                            <input type="checkbox" name="email_stmp_auth" value="1" defaultChecked />
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                                                            TLS Authentication :
                                                                        </label>
                                                                        <div class="col-9">
                                                                            <div class="kt-radio-inline">
                                                                                <div class="col-3 px-0">
                                                                                    <span class="kt-switch kt-switch--sm kt-switch--icon">
                                                                                        <label>
                                                                                            <input type="checkbox" name="email_tls_auth" />
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                                                        <div class="kt-form__actions">
                                                            <div class="row">
                                                                <div class="col-xl-3"></div>
                                                                <div class="col-lg-9 col-xl-6">
                                                                    <button class="btn btn-label-brand btn-bold mr-3" type="button">
                                                                        <i class="flaticon2-checkmark"></i>
                                                                        Test Configuration
                                                                    </button>
                                                                    <button class="btn btn-danger btn-bold" type="reset">
                                                                        <i class="flaticon-refresh"></i>
                                                                        Reset
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Email Ends --}}
                                                </div>
                                                
                                                {{-- SMS --}}
                                                <div class="tab-pane" id="sms" role="tabpanel">
                                                    <div class="kt-form kt-form--label-right">
                                                        <div class="kt-form__body">
                                                            <div class="kt-section kt-section--first">
                                                                <div class="kt-section__body">
                                                                    <div id="kt_repeater_sms_gateway">
                                                                        <div class="form-group form-group-last row" id="kt_repeater_sms_gateway">
                                                                            <h5 class="col-lg-12 text-left border-bottom pb-3">
                                                                                Add SMS Gateway:
                                                                            </h5>
                                                                            <br />
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group row align-items-center">
                                                                                    <div class="card card-body rounded-0 container-fluid">
                                                                                        <div class="row">
                                                                                            <div class="col-12 p-3">
                                                                                                <div class="col-md-5">
                                                                                                    <div class="kt-form__group--inline">
                                                                                                        <div class="kt-form__label">
                                                                                                            <label>
                                                                                                                SMS Gateway Type:
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="kt-form__control">
                                                                                                            <select  id="sms_gateway_type" class="form-control" name="sms_gateway_type">
                                                                                                                <option selected="selected">
                                                                                                                    Default
                                                                                                                </option>
                                                                                                                <option disabled>
                                                                                                                    Custom
                                                                                                                </option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="col-md-5">
                                                                                                    <div class="kt-form__group--inline">
                                                                                                        <div class="kt-form__label">
                                                                                                            <label>
                                                                                                                SMS Gateway Name:
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="kt-form__control">
                                                                                                            <input class="form-control" type="text" placeholder="SMS gateway name.." name="sms_gateway_name">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="d-md-none kt-margin-b-10"></div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <div class="col-md-5">
                                                                                                    <div class="kt-form__group--inline">
                                                                                                        <div class="kt-form__label">
                                                                                                            <label class="kt-label m-label--single">
                                                                                                                SMS Gateway URL:
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="kt-form__control">
                                                                                                            <textarea class="form-control" placeholder="Enter SMS Gateway URL..." name="sms_gateway_url"></textarea>
                                                                                                        </div>
                                                                                                        <span class="form-text text-muted">
                                                                                                            Example : https://www.example.com/API/sms.php?username="username"&password="xyz123abc#"&from="username
                                                                                                            @mail.com"&to="reciever@mail.com" &msg="text message.." &type=1
                                                                                                        </span>
                                                                                                    </div>
                                                                                                    <div class="d-md-none kt-margin-b-10">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                {{-- <div class="form-group form-group-last row">
                                                                                    <div class="col-lg-12">
                                                                                        <a href="javascript:;" data-repeater-create class="btn btn-bold btn-sm btn-label-brand px-3">
                                                                                            <i class="la la-plus"></i> Add
                                                                                        </a>
                                                                                    </div>
                                                                                </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- SMS Ends --}}
                                                {{-- Payment Gateway --}}
                                                <div class="tab-pane" id="payment_gateway" role="tabpanel">
                                                    <div class="kt-form kt-form--label-right">
                                                        <div class="kt-form__body">
                                                            <div class="kt-section kt-section--first">
                                                                <div class="kt-section__body">
                                                                </div>
                                                                <div class="row"><label class="col-xl-3"></label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Payment Gateway Ends --}}
                                            </div>
                                            {{-- Rename Label --}}
                                            <div class="tab-pane" id="rename_label" role="tabpanel">
                                                <div class="kt-form kt-form--label-right">
                                                    <div class="kt-form__body">
                                                        <div class="kt-section kt-section--first">
                                                            <div class="kt-section__body">
                                                                <div class="row">
                                                                    <label class="col-xl-3"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Rename Label Ends --}}
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                            {{-- CONTENT ENDS --}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--End:: App Content-->
    </div>
    <!--End::App-->
</div>
<!-- end:: Content -->
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script>
    "use strict";var KTUserProfile={init:function(){new KTOffcanvas("kt_user_profile_aside",{overlay:!0,baseClass:"kt-app__aside",closeBy:"kt_user_profile_aside_close",toggleBy:"kt_subheader_mobile_toggle"}),new KTAvatar("kt_user_avatar")}};KTUtil.ready(function(){KTUserProfile.init()});
</script>
<script src="{!!asset('assets/assets/app/custom/general/dashboard.js')!!}"></script>
<script src="{!!asset('js/script.js')!!}"></script>
<script src="{!!asset('rtl/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/form-repeater.js')!!}"></script>
<script src="{!! asset('rtl/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') !!}" charset="utf-8"></script>
<script src="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.js"></script>

<script>
    $(document).ready(function() {
        $('.multiselect').multipleSelect({
            filter: true
        });
        $('#kt_form_button').click(function() {
            $('#kt_demo_panel').addClass('kt-demo-panel--on');
        });
        $('#kt_demo_panel_close').click(function() {
            $('#kt_demo_panel').removeClass('kt-demo-panel--on');
        });
    });
</script>

{{-- Add Rules Form --}}
{{-- begin::Demo Panel --}}
<div id="kt_demo_panel" class="kt-demo-panel">
    <div class="kt-demo-panel__head">
        <h3 class="kt-demo-panel__title">
            Add Rules To User
            {{--<small>5</small>--}}
        </h3>
        <a href="#" class="kt-demo-panel__close" id="kt_demo_panel_close">
            <i class="flaticon2-delete"></i>
        </a>
    </div>
    <div class="kt-demo-panel__body">
        <div class="kt-section kt-section--first">
            <form method="post" action="{{route('save.user.rule')}}">
                @csrf
                <div class="px-1">
                    <div class="form-group">
                        <label>
                            Rule Name
                            <span class="text-danger h4 mt-1" data-toggle="tooltip" title="Valid From is required!">*</span>
                            :
                        </label>
                        <input type="text" class="form-control" placeholder="Enter rule name" name="rule_name" />
                    </div>
                    <div class="form-group">
                        <label>Description:</label>
                        <textarea class="form-control" placeholder="Write here.." name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            Valid From
                            <span class="text-danger h4 mt-1" data-toggle="tooltip" title="dd/mm/YYYY">*</span>
                            :
                        </label>
                        <input type="text" class="form-control" id="kt_datepicker_1" placeholder="Valid from.." name="valid_from" autocomplete="off" />
                    </div>
                    <div class="form-group">
                        <label>Device Accuracy Tolerance:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Device Accuracy Tolerance.." name="device_accuracy_tolerance" />
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2">meter(s)</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Device Distance Variation:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <select  id="device_dictance_variation_sign" class="form-control rounded-0" name="device_dictance_variation_sign">
                                    <option value="1" selected>+</option>
                                    <option value="2">-</option>
                                </select>
                            </div>
                            <select  id="device_dictance_variation" class="form-control rounded-0" name="device_dictance_variation">
                                @for ($i=0; $i <= 100; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>POI Tolerance:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter POI Tolerance.." name="poi_tolerance" />
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2">meter</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Speed Tolerance:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Speed Tolerance.." name="speed_tolerance" />
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2">meter</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Inactive Time:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Inactive Time.." name="inactive_time" />
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2">minute(s)</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Stoppage Time:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Inactive Time.." name="stoppage_time" />
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2">minute(s)</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Idle Time:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Idle Time.." name="idle_time" />
                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2">minute(s)</span></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cluster:</label>
                        <div class="kt-checkbox-list">
                            <label class="kt-checkbox">
                                <input type="checkbox" name="show_cluster" value="1" /> Show Cluster
                                <span></span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Set Startup Screen :</label>
                        <select  id="startup_screen" class="form-control col-5" name="startup_screen">
                            <option value="">Select</option>
                            <option value="1" selected>Dashboard</option>
                            <option value="2">Live Tracking</option>
                        </select>
                    </div>
                </div>
                <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" variant="primary">
                        <i class="fa fa-check-circle"></i> Save Rule
                    </button>
                    <button type="reset" class="btn btn-outline-danger" variant="primary">
                        <i class="flaticon-refresh"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end::Demo Panel --}}
{{-- Add Rules Form Ends --}}
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/default.min.css"/>
<script src="{{asset('assets/assets/app/bundle/app.bundle.js')}}"></script>
<script src="{{asset('js/user.js')}}"></script>    
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
<script>
    $(document).ready(() => {
        // 
    });

    /********** Functions **********/

    function addMapToUser() {
        let maps = $(".addMapForm")
        .find(".map")
        .map(function(idx, elem) {
            return $(elem).val();
        })
        .get();
        let map_keys = $(".addMapForm")
        .find(".map_key")
        .map(function(idx, elem) {
            return $(elem).val();
        })
        .get();
        let map_project_ids = $(".addMapForm")
        .find(".map_project_id")
        .map(function(idx, elem) {
            return $(elem).val();
        })
        .get();
        let map_address_from_map_providers = $(".addMapForm")
        .find(".map_address_from_map_provider")
        .map(function(idx, elem) {
            return $(elem).val();
        })
        .get();
        let map_speed_limit_apis = $(".addMapForm")
        .find(".map_speed_limit_api")
        .map(function(idx, elem) {
            return $(elem).val();
        })
        .get();
        let map_defaults = $(".addMapForm")
        .find(".map_default")
        .map(function(idx, elem) {
            return $(elem).val();
        })
        .get();
        
        var data = {
            maps,
            map_keys,
            map_project_ids,
            map_address_from_map_providers,
            map_speed_limit_apis,
            map_defaults
        };
        
        var urlParams = new URLSearchParams(window.location.search);
        // var userid = urlParams.get('id');
        var userid = $('input[name="user_id"]').val();
        $.ajax({
            method: "POST",
            url: "{{route('add.maps')}}",
            data: {'data': data, 'id': userid, '_token': '{{csrf_token()}}'}
        }).done(function(results) {
            if(results.status == 1) {
                alertify.success('Map Saved Successfully!');
                for (let index = 0; index < results.data.maps.length; index++) {
                    $('.mapTable tbody').append("<tr>"
                        +"<td>"+(results.data.count + index + 1)+"</td>"
                        +"<td>"+results.data.maps[index]+"</td>"
                        +"<td>"+results.data.map_keys[index]+"</td>"
                        +"<td>"+results.data.map_project_ids[index]+"</td>"
                        +"<td class='text-center'><a class='btn btn-danger pr-2'><i class='flaticon2-trash text-white'></i></a></td></tr>");
                    }
                }
            });
        }
        
        /********** Functions Ends **********/
    </script>
    @endpush
    