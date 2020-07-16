@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.css">
<style>
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
</style>
@endpush

@section('content')
{{-- Content Goes Here --}}
<form action="{{route('object.store')}}" method="POST">
    @csrf
    
    {{-- begin:: Content Head --}}
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">
                ADD VEHICLE &nbsp;<i class="flaticon2-layers"></i>
            </h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            {{-- <small class="text-success"> <strong>{{$user->Name}}</strong> </small> --}}
        </div>
        <div class="kt-subheader__toolbar">
            <a href="{{route('objects.view')}}" class="btn btn-clean btn-icon-sm">
                <i class="la la-long-arrow-left"></i>
                Back
            </a>
            &nbsp;
            <div class="btn-group">
                <button type="submit" class="btn btn-brand btn-bold">
                    <i class="fa fa-check-circle"></i> SAVE
                </button>
            </div>
        </div>
    </div>
    {{-- end:: Content Head --}}
    
    {{-- begin:: Content --}}
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-toolbar">
                    <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#basicSetup" role="tab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M8,17 C8.55228475,17 9,17.4477153 9,18 L9,21 C9,21.5522847 8.55228475,22 8,22 L3,22 C2.44771525,22 2,21.5522847 2,21 L2,18 C2,17.4477153 2.44771525,17 3,17 L3,16.5 C3,15.1192881 4.11928813,14 5.5,14 C6.88071187,14 8,15.1192881 8,16.5 L8,17 Z M5.5,15 C4.67157288,15 4,15.6715729 4,16.5 L4,17 L7,17 L7,16.5 C7,15.6715729 6.32842712,15 5.5,15 Z" id="Mask" fill="#000000" opacity="0.3"/>
                                        <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" id="Combined-Shape" fill="#000000"/>
                                    </g>
                                </svg>
                                &nbsp; General Setup
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#deviceSetup" role="tab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <rect id="Combined-Shape" fill="#000000" x="3" y="13" width="18" height="7" rx="2"/>
                                        <path d="M17.4029496,9.54910207 L15.8599014,10.8215022 C14.9149052,9.67549895 13.5137472,9 12,9 C10.4912085,9 9.09418404,9.67104182 8.14910121,10.8106159 L6.60963188,9.53388797 C7.93073905,7.94090645 9.88958759,7 12,7 C14.1173586,7 16.0819686,7.94713944 17.4029496,9.54910207 Z M20.4681628,6.9788888 L18.929169,8.25618985 C17.2286725,6.20729644 14.7140097,5 12,5 C9.28974232,5 6.77820732,6.20393339 5.07766256,8.24796852 L3.54017812,6.96885102 C5.61676443,4.47281829 8.68922234,3 12,3 C15.3153667,3 18.3916375,4.47692603 20.4681628,6.9788888 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    </g>
                                </svg>
                                &nbsp; Device Setup
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#sensors" role="tab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M15.4508979,17.4029496 L14.1784978,15.8599014 C15.324501,14.9149052 16,13.5137472 16,12 C16,10.4912085 15.3289582,9.09418404 14.1893841,8.14910121 L15.466112,6.60963188 C17.0590936,7.93073905 18,9.88958759 18,12 C18,14.1173586 17.0528606,16.0819686 15.4508979,17.4029496 Z M18.0211112,20.4681628 L16.7438102,18.929169 C18.7927036,17.2286725 20,14.7140097 20,12 C20,9.28974232 18.7960666,6.77820732 16.7520315,5.07766256 L18.031149,3.54017812 C20.5271817,5.61676443 22,8.68922234 22,12 C22,15.3153667 20.523074,18.3916375 18.0211112,20.4681628 Z M8.54910207,17.4029496 C6.94713944,16.0819686 6,14.1173586 6,12 C6,9.88958759 6.94090645,7.93073905 8.53388797,6.60963188 L9.81061588,8.14910121 C8.67104182,9.09418404 8,10.4912085 8,12 C8,13.5137472 8.67549895,14.9149052 9.82150222,15.8599014 L8.54910207,17.4029496 Z M5.9788888,20.4681628 C3.47692603,18.3916375 2,15.3153667 2,12 C2,8.68922234 3.47281829,5.61676443 5.96885102,3.54017812 L7.24796852,5.07766256 C5.20393339,6.77820732 4,9.28974232 4,12 C4,14.7140097 5.20729644,17.2286725 7.25618985,18.929169 L5.9788888,20.4681628 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <circle id="Oval" fill="#000000" cx="12" cy="12" r="2"/>
                                    </g>
                                </svg>
                                &nbsp; Sensors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#reminders" role="tab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                        <path d="M13,5.06189375 C12.6724058,5.02104333 12.3386603,5 12,5 C11.6613397,5 11.3275942,5.02104333 11,5.06189375 L11,4 L10,4 C9.44771525,4 9,3.55228475 9,3 C9,2.44771525 9.44771525,2 10,2 L14,2 C14.5522847,2 15,2.44771525 15,3 C15,3.55228475 14.5522847,4 14,4 L13,4 L13,5.06189375 Z" id="Combined-Shape" fill="#000000"/>
                                        <path d="M16.7099142,6.53272645 L17.5355339,5.70710678 C17.9260582,5.31658249 18.5592232,5.31658249 18.9497475,5.70710678 C19.3402718,6.09763107 19.3402718,6.73079605 18.9497475,7.12132034 L18.1671361,7.90393167 C17.7407802,7.38854954 17.251061,6.92750259 16.7099142,6.53272645 Z" id="Combined-Shape" fill="#000000"/>
                                        <path d="M11.9630156,7.5 L12.0369844,7.5 C12.2982526,7.5 12.5154733,7.70115317 12.5355117,7.96165175 L12.9585886,13.4616518 C12.9797677,13.7369807 12.7737386,13.9773481 12.4984096,13.9985272 C12.4856504,13.9995087 12.4728582,14 12.4600614,14 L11.5399386,14 C11.2637963,14 11.0399386,13.7761424 11.0399386,13.5 C11.0399386,13.4872031 11.0404299,13.4744109 11.0414114,13.4616518 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" id="Path-107" fill="#000000"/>
                                    </g>
                                </svg>
                                &nbsp; Reminders
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    {{-- General Setup --}}
                    <div class="tab-pane active" id="basicSetup" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="kt-section__body">
                                            @if ($errors->any())
                                            <div class="alert alert-danger mb-3">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="row pb-5">
                                            <div class="col-lg-12 col-xl-6 border-bottom">
                                                <h3 class="kt-section__title kt-section__title-sm">
                                                    General Vehicle Setup :
                                                </h3>
                                            </div>
                                        </div>
                                        @if($resellers->count() > 0)
                                        <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Reseller :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control col-6" name="reseller_id">
                                                        <option value=""> Select Reseller </option>
                                                        @foreach ($resellers as $reseller)
                                                            <option value="{{$reseller->id}}">{{$reseller->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            @if($resellers->count() > 0)
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Company :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control col-6" type="text" name="company_id">
                                                        <option value=""> Select Company </option>
                                                        @foreach ($companies as $company)
                                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            @if($resellers->count() == 0)
                                            <input type="hidden" name="reseller_id" value="0">
                                            <input type="hidden" name="company_id" value="0">
                                            <input type="hidden" name="company_branch_id" value="{{$branches->first()->id}}">
                                            @else
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                        Branch :
                                                    </label>
                                                    <div class="col-lg-9 col-xl-6">
                                                        <select class="form-control col-6" type="text" name="company_branch_id">
                                                            <option value=""> Select Branch </option>
                                                            @foreach ($branches as $branch)
                                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Name :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control col-6" type="text" name="object_name" placeholder="Enter Vehicle Name" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Device Type :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control col-6" name="device_type">
                                                        @forelse ($devices as $device)
                                                            <option value="{{$device->id}}">{{$device->name}}</option>
                                                        @empty
                                                            <option value="1">IAC 140</option>
                                                            <option value="2">IAC 140 CAN</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row d-none">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Copy From :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control col-6" type="text" name="copy_from" placeholder="Copy From.." />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    IMEI Number :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control col-6" type="number" name="imei_number" placeholder="Enter device imei number.." />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Server Address :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control col-6 bg-secondary" type="text" name="server_address" placeholder="Copy From.." value="13.233.241.178:6006" readonly />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    SIM Number :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control col-6" type="text" name="sim_number" placeholder="SIM number.." />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Device Timezone :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control col-6" name="device_timezone">
                                                        <option value="">Select timezone</option>
                                                        @foreach ($timezone as $timezoneItem)
                                                            <option value="{{$timezoneItem->id}}">{{$timezoneItem->type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Distance Counter :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control col-6" name="distance_counter">
                                                        <option>GPS</option>
                                                        <option>Relative Odometer</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Unit Of Distance :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control col-6" name="distance_unit">
                                                        <option>Kilometer</option>
                                                        <option>Mile</option>
                                                        <option>Nutical mile</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Speed Detection :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select class="form-control col-6" name="speed_detection">
                                                        <option>From Device</option>
                                                        <option>From Latlong</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Odometer :
                                                </label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control col-6" type="text" name="odometer" placeholder="Odometer.." />
                                                </div>
                                            </div>
                                            <div class="form-group row d-none">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    LBS Detection Radius :
                                                </label>
                                                <div class="col-lg-9 col-xl-6 row pl-4">
                                                    <input class="form-control col-6" id="lbs_detection_radius" type="text" name="lbs_detection_radius" placeholder="Only numeric values less than 5000.." maxlength="4" />
                                                    <p class="col-6 py-auto">( Meter )</p>
                                                    <small class="text-danger p-1 message_lbs">Max value is upto 5000 meters.</small>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- General Setup Ends --}}
                    {{-- Device Setup --}}
                    <div class="tab-pane" id="deviceSetup" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="row pb-5">
                                        <div class="col-lg-12 col-xl-6 border-bottom">
                                            <h3 class="kt-section__title kt-section__title-sm">
                                                Device Setup :
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="kt-section__body">
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
                                                Plate Number :
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control col-6" type="text" name="plate_number" placeholder="Enter plate number.." />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                Vehicle Type :
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <div class="card card-body">
                                                <div class="row kt-radio-inline">
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Ambulance">
                                                        <img class="img" src="{{asset('img/objects/Ambulance.png')}}" alt="Ambulance" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Barge">
                                                        <img class="img" src="{{asset('img/objects/Barge.png')}}" alt="Barge" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Bike">
                                                        <img class="img" src="{{asset('img/objects/Bike.png')}}" alt="Bike" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Bus">
                                                        <img class="img" src="{{asset('img/objects/Bus.png')}}" alt="Bus" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Car">
                                                        <img class="img" src="{{asset('img/objects/Car.png')}}" alt="Car" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Default" checked>
                                                        <img class="img" src="{{asset('img/objects/Default.png')}}" alt="Default" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="JCB">
                                                        <img class="img" src="{{asset('img/objects/JCB.png')}}" alt="JCB" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="PersonalTracker">
                                                        <img class="img" src="{{asset('img/objects/PersonalTracker.png')}}" alt="PersonalTracker" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="PoliceCar">
                                                        <img class="img" src="{{asset('img/objects/PoliceCar.png')}}" alt="PoliceCar" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Rickshaw">
                                                        <img class="img" src="{{asset('img/objects/Rickshaw.png')}}" alt="Rickshaw" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="SchoolBus">
                                                        <img class="img" src="{{asset('img/objects/SchoolBus.png')}}" alt="SchoolBus" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Taxi">
                                                        <img class="img" src="{{asset('img/objects/Taxi.png')}}" alt="Taxi" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Tempo">
                                                        <img class="img" src="{{asset('img/objects/Tempo.png')}}" alt="Tempo" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="TractorUnit">
                                                        <img class="img" src="{{asset('img/objects/TractorUnit.png')}}" alt="TractorUnit" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                    <label class="kt-radio p-3">
                                                        <input class="p-3" type="radio" name="object_type" value="Truck">
                                                        <img class="img" src="{{asset('img/objects/Truck.png')}}" alt="Truck" width="40" height="40">
                                                            <span></span>
                                                    </label>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                Manufacture Date :
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control col-6" autocomplete="off" id="kt_datepicker_1" type="text" name="mfg_date" placeholder="Enter Manufacture Date.." />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                Purchage Date :
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control col-6"  autocomplete="off" id="kt_datepicker_1" type="text" name="purchage_date" placeholder="Enter Purchage Date" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                Installation Date :
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control col-6"  autocomplete="off" id="kt_datepicker_1" type="text" name="installation_date" placeholder="Enter Installation Date.." />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                Registration Number :
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control col-6" type="text" name="registration_number" placeholder="Registration Number.." />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                Mileage based on distance :
                                            </label>
                                            <div class="col-lg-9 col-xl-6">
                                                <input class="form-control col-6" type="number" name="mileage_on_distance" value="0" placeholder="Mileage based on distance.." />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-lg-3 col-form-label">
                                                Mileage based on duration :
                                            </label>
                                            <div class="col-lg-9 col-xl-6 row pl-4">
                                                <input class="form-control col-6" type="number" name="mileage_on_duration" value="0" placeholder="Mileage based on duration.." />
                                                <p class="col-6">( Minutes )</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Device Setup Ends --}}
                
                    {{-- SMS --}}
                    <div class="tab-pane" id="sensors" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="row pb-5">
                                        <div class="col-lg-12 col-xl-6 border-bottom">
                                            <h3 class="kt-section__title kt-section__title-sm">
                                                Sensors :
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="kt-section__body">
                                    </div>
                                    <div class="row"><label class="col-xl-3"></label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- SMS Ends --}}
                    {{-- Payment Gateway --}}
                    <div class="tab-pane" id="reminders" role="tabpanel">
                        <div class="kt-form kt-form--label-right">
                            <div class="kt-form__body">
                                <div class="kt-section kt-section--first">
                                    <div class="row pb-5">
                                        <div class="col-lg-12 col-xl-6 border-bottom">
                                            <h3 class="kt-section__title kt-section__title-sm">
                                                Reminders :
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="kt-section__body">
                                    </div>
                                    <div class="row"><label class="col-xl-3"></label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Payment Gateway Ends --}}
            
                </div>
            
                <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                <!--begin: Form Actions -->					
                <div class="kt-form__actions">
                    <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                    Previous
                    </div>
                    <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                    Next Step
                    </div>
                </div>
                <!--end: Form Actions -->
            </div>
        </div>
    </div>
    {{-- end:: Content --}}
</form>
{{-- Content Ends Here --}}

@endsection

@push('scripts')
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

<script src="{{asset('assets/assets/app/bundle/app.bundle.js')}}"></script>
<script src="{{asset('js/user-form.js')}}"></script>    

<script>
    $('.message_lbs').hide();
    $('#lbs_detection_radius').keyup(function(){
        if($(this).val() > 5000) $('.message_lbs').show();
        if($(this).val() < 5000) $('.message_lbs').hide();
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
        var userid = urlParams.get('id');
        $.ajax({
            method: "POST",
            url: "{{route('add.maps')}}",
            data: {'data': data, 'id': userid, '_token': '{{csrf_token()}}'}
        }).done(function(results) {
            if(results.status == 1) {
                console.log(results.data.count);
                for (let index = 0; index < results.data.maps.length; index++) {
                    $('.mapTable tbody').append("<tr>"
                        +"<td>"+(results.data.count + index + 1)+"</td>"
                        +"<td>"+results.data.maps[index]+"</td>"
                        +"<td>"+results.data.map_keys[index]+"</td>"
                        +"<td>"+results.data.map_project_ids[index]+"</td>"
                        +"<td><a class='btn btn-danger pr-2'><i class='flaticon2-trash text-white'></i></a></td></tr>");
                    }
                }
            });
        }
        
        /********** Functions Ends **********/
    </script>
    @endpush
    