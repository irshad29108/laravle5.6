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
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <!--begin::Form-->
    <form class="px-3" method="POST" action="{{route('alert.store')}}">
        @csrf
        {{-- begin:: Content Head --}}
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">CREATE ALERT &nbsp;<i class="
                flaticon2-notification"></i></h3>
                <span class="kt-subheader__separator kt-subheader__separator--v"></span>
                {{-- <small class="text-success"> <strong>{{$user->Name}}</strong> </small> --}}
            </div>
            <div class="kt-subheader__toolbar">
                <a href="{{route('alerts.view')}}" class="btn btn-clean btn-icon-sm">
                    <i class="la la-long-arrow-left"></i>
                    Back
                </a>
                &nbsp;
                <div class="btn-group">
                    <button class="btn btn-brand btn-bold">
                        <i class="fa fa-check-circle"></i> SAVE
                    </button>
                </div>
            </div>
        </div>
            
        {{-- Main Form Goes Here --}}
        <div class="kt-content  kt-grid__item kt-grid__item--fluid row" id="kt_content">
            <div class="col-lg-6 col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Choose Vehicle :
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label for="exampleSelect1">Company</label>
                            <select class="form-control" name="company_id">
                                @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Branch</label>
                            <select class="form-control" name="branch_id">
                                @foreach ($branches as $branch)
                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Object</label>
                            <select class="form-control w-100 multiselect" name="object_id[]" multiple="multiple">
                                @foreach ($objects as $object)
                                <option value="{{$object->id}}">{{$object->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>			
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Alert Details :
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" id="alert-container">
                        <div class="form-group">
                            <label for="exampleSelect1">Alert Name</label>
                            <input type="text" class="form-control" name="alert_name" />
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Alert Type</label>
                            <select class="form-control" name="alert_type" onchange="selctedAlert($(this).val())">
                                <option value=""> Select Alert </option>
                                @foreach ($alerts as $alert)
                                <option value="{{$alert->id}}">{{$alert->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>			
                </div>
            </div>
        </div>
    </form>
    </div>
    <!--end::Form-->
    
    {{-- Content Ends Here --}}
    @endsection
    
    @push('scripts')
    <script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
    <script src="{{asset('js/alert.js')}}"></script>
    <script src="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.js"></script>
    <script>
    $('.multiselect').multipleSelect({
        filter: true
    }).multipleSelect('checkAll');
    </script>
    @endpush