@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{asset('custom/wizard/assets/app/custom/wizard/wizard-v2.demo3.css')}}">
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
    .select2-selection--single {
        height: 100% !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 50%;
    }
    #kt_form {
        height: 85vh;
        overflow-y: scroll;
    }
    
  .select2-container--default {
    width: 100% !important;
  }
</style>
@endpush

@section('content')
{{-- Content Goes Here --}}
<form action="{{route('add-user.create')}}" method="POST">
    @csrf
    {{-- {{dd()}} --}}
    {{-- begin:: Content Head --}}
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">ADD USER &nbsp;<i class="flaticon2-user"></i></h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <span> Company Name : <small class="text-success text-bold">{{$company->name}}</small> </span>
        </div>
        <div class="kt-subheader__toolbar">
            <a href="{{route('user', Request::segment(1))}}" class="btn btn-default btn-bold">
                Back
            </a>
            <div class="btn-group">
                <button type="submit" class="btn btn-brand btn-bold">
                    <i class="fa fa-check-circle"></i> Save
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
                            <a class="nav-link active" data-toggle="tab" href="#branch" role="tab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                        <path d="M4.95312427,14.3025791 L3.04687573,13.6974209 C4.65100965,8.64439903 7.67317997,6 12,6 C16.32682,6 19.3489903,8.64439903 20.9531243,13.6974209 L19.0468757,14.3025791 C17.6880467,10.0222676 15.3768837,8 12,8 C8.62311633,8 6.31195331,10.0222676 4.95312427,14.3025791 Z M12,8 C12.5522847,8 13,7.55228475 13,7 C13,6.44771525 12.5522847,6 12,6 C11.4477153,6 11,6.44771525 11,7 C11,7.55228475 11.4477153,8 12,8 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M5.73243561,6 L9.17070571,6 C9.58254212,4.83480763 10.6937812,4 12,4 C13.3062188,4 14.4174579,4.83480763 14.8292943,6 L18.2675644,6 C18.6133738,5.40219863 19.2597176,5 20,5 C21.1045695,5 22,5.8954305 22,7 C22,8.1045695 21.1045695,9 20,9 C19.2597176,9 18.6133738,8.59780137 18.2675644,8 L14.8292943,8 C14.4174579,9.16519237 13.3062188,10 12,10 C10.6937812,10 9.58254212,9.16519237 9.17070571,8 L5.73243561,8 C5.38662619,8.59780137 4.74028236,9 4,9 C2.8954305,9 2,8.1045695 2,7 C2,5.8954305 2.8954305,5 4,5 C4.74028236,5 5.38662619,5.40219863 5.73243561,6 Z M12,8 C12.5522847,8 13,7.55228475 13,7 C13,6.44771525 12.5522847,6 12,6 C11.4477153,6 11,6.44771525 11,7 C11,7.55228475 11.4477153,8 12,8 Z M4,19 C2.34314575,19 1,17.6568542 1,16 C1,14.3431458 2.34314575,13 4,13 C5.65685425,13 7,14.3431458 7,16 C7,17.6568542 5.65685425,19 4,19 Z M4,17 C4.55228475,17 5,16.5522847 5,16 C5,15.4477153 4.55228475,15 4,15 C3.44771525,15 3,15.4477153 3,16 C3,16.5522847 3.44771525,17 4,17 Z M20,19 C18.3431458,19 17,17.6568542 17,16 C17,14.3431458 18.3431458,13 20,13 C21.6568542,13 23,14.3431458 23,16 C23,17.6568542 21.6568542,19 20,19 Z M20,17 C20.5522847,17 21,16.5522847 21,16 C21,15.4477153 20.5522847,15 20,15 C19.4477153,15 19,15.4477153 19,16 C19,16.5522847 19.4477153,17 20,17 Z" id="Combined-Shape" fill="#000000"/>
                                    </g>
                                </svg>
                                &nbsp; BRANCHES
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#addUser" role="tab" aria-selected="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
                                        <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"/>
                                    </g>
                                </svg>
                                &nbsp; Add Users
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="tab-content">
                    {{-- Alerts --}}
                    @if (Session::has('message') || $errors->any())
                    <div class="w-75 form-group form-group-last">
                        <div class="alert {{ Session::has('alert-class') ? Session::get('alert-class') : 'alert-danger' }}" role="alert">
                            <div class="alert-icon">
                                <i class="{{ Session::get('alert-class') == 'alert-success' ? 'flaticon2-checkmark' : 'flaticon2-information' }}">
                                </i>
                            </div>
                            <div class="alert-text pl-3">
                                {{ Session::has('message') ? Session::get('message') : 'ERROR OCCURRED!!' }}
                            </div>
                            @if (!Session::has('message'))
                            <div class="row pl-3">
                                <br>
                                <p class="pl-3">Please see this list of errors carefully and resolve them while saving again.</p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    @endif
                    {{-- Alerts Ends --}}
                    
                    
                    {{-- Rule Starts --}}
                    <div class="tab-pane active" id="branch" role="tabpanel">
                        <div class="col-lg-12">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group form-group-last row">
                                                <div class="col-lg-9 col-xl-6">
                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--primary">
                                                        <a href="javascript:;" class="btn btn-elevate-hover btn-outline-primary" id="kt_form_button">
                                                            <i class="fa fa-plus-circle"></i>
                                                            ADD BRANCH
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
                                                                <th>Branch Name</th>
                                                                <th>UserName</th>
                                                                <th>Mobile No</th>
                                                                <th>Created On</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($branches as $branch)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$branch->name}}</td>
                                                                <td>{{$branch->user_name}}</td>
                                                                <td>{{$branch->mobile_number}}</td>
                                                                <td>{{Carbon\Carbon::parse($branch->created_at)->format('d, M Y || H:i:s')}}</td>
                                                                <td class="text-center">
                                                                    <a 
                                                                        href="{{route('user.settings', [Request::segment(1), encrypt($branch->id)])}}" 
                                                                        class="btn btn-outline-dark btn-elevate-hover btn-circle btn-icon">
                                                                        <i class="fa fa-cog"></i>
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
                    
                    {{-- Rule Starts --}}
                    <div class="tab-pane" id="addUser" role="tabpanel">
                        <div class="col-lg-12">
                            <div class="kt-form kt-form--label-right">
                                <div class="kt-form__body">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <div class="form-group form-group-last row">
                                                <div class="col-lg-9 col-xl-6">
                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--primary">
                                                        <a href="javascript:;" data-target="#kt_modal_KTDatatable_local" class="btn btn-elevate-hover btn-outline-primary" data-toggle="modal">
                                                            <i class="fa fa-plus-circle"></i>
                                                            ADD USER
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
                                                                <th>User Name</th>
                                                                <th>UserName</th>
                                                                <th>Mobile No</th>
                                                                <th>Created On</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($users as $user)
                                                            <tr>
                                                                <td>{{$loop->iteration}}</td>
                                                                <td>{{$user->name}}</td>
                                                                <td>{{$user->user_name}}</td>
                                                                <td>{{$user->mobile_number}}</td>
                                                                <td>{{Carbon\Carbon::parse($user->created_at)->format('d, M Y || H:i:s')}}</td>
                                                                <td class="text-center">
                                                                    <a href="{{route('user.settings', [Request::segment(1), encrypt($user->id)])}}" class="btn btn-outline-dark btn-elevate-hover btn-circle btn-icon"><i class="fa fa-cog"></i></a>
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
                    {{-- End Rule --}}
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end:: Content --}}
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

{{-- Add Rules Form --}}
{{-- begin::Demo Panel --}}
<div id="kt_demo_panel" class="kt-demo-panel">
    <div class="kt-demo-panel__head">
        <h3 class="kt-demo-panel__title">
            Add Branch
            {{--<small>5</small>--}}
        </h3>
        <a href="#" class="kt-demo-panel__close" id="kt_demo_panel_close">
            <i class="flaticon2-delete"></i>
        </a>
    </div>
    <div class="kt-demo-panel__body">
        <div class="kt-section kt-section--first">
            <form method="post" action="{{route('save.branch')}}">
                @csrf
                <input type="hidden" name="parent_id" value="{{$company->id}}" />
                <div class="px-1">
                    <div class="form-group">
                        <label>
                            Branch Name
                            <span class="text-danger h4 mt-1" data-toggle="tooltip" title="This field is required!">*</span>
                            :
                        </label>
                        <input type="text" class="form-control" placeholder="Enter branch name" name="branch_name" />
                    </div>
                    
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email.." name="branch_email" />
                    </div>
                    
                    <div class="form-group">
                        <label>Password
                            <span class="text-danger h4 mt-1" data-toggle="tooltip" title="This field is required!">*</span>
                            :</label>
                            <input type="password" class="form-control" placeholder="Enter password.." name="branch_password" />
                        </div>
                        
                        <div class="form-group">
                            <label>Confirm Password
                                <span class="text-danger h4 mt-1" data-toggle="tooltip" title="This field is required!">*</span>
                                :</label>
                                <input type="password" class="form-control" placeholder="Enter password same as password field.." name="branch_confirm_password" />
                            </div>
                            
                            <div class="form-group">
                                <label>Contact Person:</label>
                                <input type="text" class="form-control" placeholder="Enter contact person.." name="branch_contact_person" />
                            </div>
                            
                            <div class="form-group">
                                <label>Mobile Number:</label>
                                <input type="text" class="form-control" placeholder="Enter mobile number.." name="branch_mobile_number" />
                            </div>
                            
                            <div class="form-group">
                                <label>Country:</label>
                                <select class="form-control rounded-0" name="branch_country">
                                    <option value="1" selected>+</option>
                                    <option value="2">-</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>State:</label>
                                <select class="form-control rounded-0" name="branch_state">
                                    <option value="1" selected>+</option>
                                    <option value="2">-</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>City:</label>
                                <select class="form-control rounded-0" name="branch_city">
                                    <option value="1" selected>+</option>
                                    <option value="2">-</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Zip Code:</label>
                                <input type="text" class="form-control" placeholder="Enter zip code.." name="branch_zip_code" />
                            </div>
                            
                            <div class="form-group">
                                <label>Full Address:</label>
                                <textarea class="form-control" placeholder="Enter full address.." name="branch_full_address"></textarea>
                            </div>
                        </div>
                        <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" variant="primary">
                                <i class="fa fa-check-circle"></i> Save Branch
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
        
        {{-- begin::Demo Panel 2 --}}
        <div id="kt_modal_KTDatatable_local" class="modal fade show" role="dialog" aria-modal="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-body modal-body-fit">
                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid p-0" id="kt_content">
                            <div class="kt-portlet">
                                <div class="kt-portlet__body kt-portlet__body--fit">
                                    <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
                                        <div class="kt-grid__item kt-wizard-v2__aside" style="flex: 0 0 300px !important;">
                                            <!--begin: Form Wizard Nav -->
                                            <div class="kt-wizard-v2__nav">
                                                <div class="kt-wizard-v2__nav-items">
                                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                                                        <div class="kt-wizard-v2__nav-body">
                                                            <div class="kt-wizard-v2__nav-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlnsxlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                    <g stroke="none" strokewidth="1" fill="none" fillrule="evenodd">
                                                                        <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fillrule="nonzero" opacity="0.3"></path>
                                                                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fillrule="nonzero"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="kt-wizard-v2__nav-label">
                                                                <div class="kt-wizard-v2__nav-label-title">
                                                                    Account Settings
                                                                </div>
                                                                <div class="kt-wizard-v2__nav-label-desc">
                                                                    Setup user account.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                                        <div class="kt-wizard-v2__nav-body">
                                                            <div class="kt-wizard-v2__nav-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                                        <path d="M4.95312427,14.3025791 L3.04687573,13.6974209 C4.65100965,8.64439903 7.67317997,6 12,6 C16.32682,6 19.3489903,8.64439903 20.9531243,13.6974209 L19.0468757,14.3025791 C17.6880467,10.0222676 15.3768837,8 12,8 C8.62311633,8 6.31195331,10.0222676 4.95312427,14.3025791 Z M12,8 C12.5522847,8 13,7.55228475 13,7 C13,6.44771525 12.5522847,6 12,6 C11.4477153,6 11,6.44771525 11,7 C11,7.55228475 11.4477153,8 12,8 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                                        <path d="M5.73243561,6 L9.17070571,6 C9.58254212,4.83480763 10.6937812,4 12,4 C13.3062188,4 14.4174579,4.83480763 14.8292943,6 L18.2675644,6 C18.6133738,5.40219863 19.2597176,5 20,5 C21.1045695,5 22,5.8954305 22,7 C22,8.1045695 21.1045695,9 20,9 C19.2597176,9 18.6133738,8.59780137 18.2675644,8 L14.8292943,8 C14.4174579,9.16519237 13.3062188,10 12,10 C10.6937812,10 9.58254212,9.16519237 9.17070571,8 L5.73243561,8 C5.38662619,8.59780137 4.74028236,9 4,9 C2.8954305,9 2,8.1045695 2,7 C2,5.8954305 2.8954305,5 4,5 C4.74028236,5 5.38662619,5.40219863 5.73243561,6 Z M12,8 C12.5522847,8 13,7.55228475 13,7 C13,6.44771525 12.5522847,6 12,6 C11.4477153,6 11,6.44771525 11,7 C11,7.55228475 11.4477153,8 12,8 Z M4,19 C2.34314575,19 1,17.6568542 1,16 C1,14.3431458 2.34314575,13 4,13 C5.65685425,13 7,14.3431458 7,16 C7,17.6568542 5.65685425,19 4,19 Z M4,17 C4.55228475,17 5,16.5522847 5,16 C5,15.4477153 4.55228475,15 4,15 C3.44771525,15 3,15.4477153 3,16 C3,16.5522847 3.44771525,17 4,17 Z M20,19 C18.3431458,19 17,17.6568542 17,16 C17,14.3431458 18.3431458,13 20,13 C21.6568542,13 23,14.3431458 23,16 C23,17.6568542 21.6568542,19 20,19 Z M20,17 C20.5522847,17 21,16.5522847 21,16 C21,15.4477153 20.5522847,15 20,15 C19.4477153,15 19,15.4477153 19,16 C19,16.5522847 19.4477153,17 20,17 Z" id="Combined-Shape" fill="#000000"/>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="kt-wizard-v2__nav-label">
                                                                <div class="kt-wizard-v2__nav-label-title">
                                                                    Branch
                                                                </div>
                                                                <div class="kt-wizard-v2__nav-label-desc">
                                                                    Select Branch for this user.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                                        <div class="kt-wizard-v2__nav-body">
                                                            <div class="kt-wizard-v2__nav-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                                        <path d="M2,13 L22,13 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,13 Z M18.5,18 C19.3284271,18 20,17.3284271 20,16.5 C20,15.6715729 19.3284271,15 18.5,15 C17.6715729,15 17,15.6715729 17,16.5 C17,17.3284271 17.6715729,18 18.5,18 Z M13.5,18 C14.3284271,18 15,17.3284271 15,16.5 C15,15.6715729 14.3284271,15 13.5,15 C12.6715729,15 12,15.6715729 12,16.5 C12,17.3284271 12.6715729,18 13.5,18 Z" id="Combined-Shape" fill="#000000"/>
                                                                        <path d="M5.79268604,8 L18.207314,8 C18.5457897,8 18.8612922,8.17121884 19.0457576,8.45501165 L22,13 L2,13 L4.95424243,8.45501165 C5.13870775,8.17121884 5.45421032,8 5.79268604,8 Z" id="Rectangle" fill="#000000" opacity="0.3"/>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="kt-wizard-v2__nav-label">
                                                                <div class="kt-wizard-v2__nav-label-title">
                                                                    Device
                                                                </div>
                                                                <div class="kt-wizard-v2__nav-label-desc">
                                                                    Setup user account with devices.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                                        <div class="kt-wizard-v2__nav-body">
                                                            <div class="kt-wizard-v2__nav-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlnsxlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                    <g stroke="none" strokewidth="1" fill="none" fillrule="evenodd">
                                                                        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                        <path d="M15.9497475,3.80761184 L13.0246125,6.73274681 C12.2435639,7.51379539 12.2435639,8.78012535 13.0246125,9.56117394 L14.4388261,10.9753875 C15.2198746,11.7564361 16.4862046,11.7564361 17.2672532,10.9753875 L20.1923882,8.05025253 C20.7341101,10.0447871 20.2295941,12.2556873 18.674559,13.8107223 C16.8453326,15.6399488 14.1085592,16.0155296 11.8839934,14.9444337 L6.75735931,20.0710678 C5.97631073,20.8521164 4.70998077,20.8521164 3.92893219,20.0710678 C3.1478836,19.2900192 3.1478836,18.0236893 3.92893219,17.2426407 L9.05556629,12.1160066 C7.98447038,9.89144078 8.36005124,7.15466739 10.1892777,5.32544095 C11.7443127,3.77040588 13.9552129,3.26588995 15.9497475,3.80761184 Z" id="Combined-Shape" fill="#000000"></path>
                                                                        <path d="M16.6568542,5.92893219 L18.0710678,7.34314575 C18.4615921,7.73367004 18.4615921,8.36683502 18.0710678,8.75735931 L16.6913928,10.1370344 C16.3008685,10.5275587 15.6677035,10.5275587 15.2771792,10.1370344 L13.8629656,8.7228208 C13.4724413,8.33229651 13.4724413,7.69913153 13.8629656,7.30860724 L15.2426407,5.92893219 C15.633165,5.5384079 16.26633,5.5384079 16.6568542,5.92893219 Z" id="Rectangle-2" fill="#000000" opacity="0.3"></path>
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="kt-wizard-v2__nav-label">
                                                                <div class="kt-wizard-v2__nav-label-title">
                                                                    Basic Setup
                                                                </div>
                                                                <div class="kt-wizard-v2__nav-label-desc">
                                                                    Setup basic details of user.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <!--end: Form Wizard Nav -->
                                            
                                        </div>
                                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">
                                            <!--begin: Form Wizard Form-->
                                            <form class="kt-form w-100" id="kt_form">
                                                <!--begin: Form Wizard Step 1-->
                                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                                    <div class="kt-heading kt-heading--md">Account Details</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v2__form">
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" class="form-control" name="name" placeholder="Enter name..">
                                                                        <span class="form-text text-muted">Please enter your name.</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Profile Image</label>
                                                                        <input type="file" class="form-control bg-success" style="padding: 1rem 5rem 4rem 1rem;" name="profile_image"  accept=".png, .jpg, .jpeg" />
                                                                    </div>
                                                                </div>							   
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="form-group">
                                                                        <label>User Name</label>
                                                                        <input type="text" class="form-control" name="user_name" placeholder="Enter user name.." maxlength="10">
                                                                        <p class="form-text text-muted">
                                                                            Please enter your email address here.<br>
                                                                            <small class="text-danger">Please note we will be using this email address for further communication.</small>
                                                                        </p>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input type="password" class="form-control" placeholder="******">
                                                                        <span class="form-text text-muted">Please enter your password.</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Confirm Password</label>
                                                                        <input type="password" class="form-control" name="password" placeholder="******">
                                                                        <span class="form-text text-muted">Please confirm your password.</span>
                                                                    </div>
                                                                </div>							   
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Contact Person</label>
                                                                        <input type="text" class="form-control" name="contact_person" placeholder="Contact Person..">
                                                                        <span class="form-text text-muted">Please enter contact person name.</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Mobile Number</label>
                                                                        <input type="tel" class="form-control" name="mobile_number" placeholder="0000000000">
                                                                        <span class="form-text text-muted">Please enter your 10 digit mobile number.</span>
                                                                    </div>
                                                                </div>							   
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="form-group">
                                                                        <label>Telephone Number</label>
                                                                        <input type="tel" class="form-control" name="telephone_number" placeholder="0000000000">
                                                                        <span class="form-text text-muted">Please enter your telephone number.</span>
                                                                    </div>
                                                                </div>						   
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Country</label>
                                                                        <select class="form-control select2" name="country">
                                                                            @foreach ($countries as $country)
                                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="form-text text-muted">Please choose country.</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>State</label>
                                                                        <select class="form-control select2" name="state">
                                                                            @foreach ($states as $state)
                                                                            <option value="{{$state->id}}">{{$state->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="form-text text-muted">Please choose state.</span>
                                                                    </div>
                                                                </div>						   
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>City</label>
                                                                        <select class="form-control select2" name="city">
                                                                            @foreach ($cities as $city)
                                                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <span class="form-text text-muted">Please choose city.</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Zip Code</label>
                                                                        <input type="text" class="form-control" name="zip_code" placeholder="000000">
                                                                        <span class="form-text text-muted">Please enter zip code.</span>
                                                                    </div>
                                                                </div>						   
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <label for="full_address"></label>
                                                                    <textarea class="form-control" name="full_address" placeholder="Enter full address.."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Form Wizard Step 1-->
                                                
                                                <!--begin: Form Wizard Step 2-->
                                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">Branch Settings</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v2__form">
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
                                                                        <option value="{{$timezone->id}}" {{$loop->iteration == 1 ? 'selected="selected"' : ''}}>{{$timezone->type}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Form Wizard Step 2-->
                                                
                                                <!--begin: Form Wizard Step 2-->
                                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">User Device Settings</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v2__form">
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
                                                                        <option value="{{$timezone->id}}" {{$loop->iteration == 1 ? 'selected="selected"' : ''}}>{{$timezone->type}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Form Wizard Step 2-->
                                                
                                                <!--begin: Form Wizard Step 2-->
                                                <div class="kt-wizard-v2__content" data-ktwizard-type="step-content">
                                                    <div class="kt-heading kt-heading--md">Setup Basic Details</div>
                                                    <div class="kt-form__section kt-form__section--first">
                                                        <div class="kt-wizard-v2__form">
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
                                                                        <option value="{{$timezone->id}}" {{$loop->iteration == 1 ? 'selected="selected"' : ''}}>{{$timezone->type}}</option>
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
                                                                        <option selected>DD-MM-YYYY</option>
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
                                                <!--end: Form Wizard Step 2-->
                                                
                                                <!--begin: Form Actions -->				 
                                                <div class="kt-form__actions">
                                                    <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                                        Previous
                                                    </div>
                                                    <div class="btn btn-primary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                                        SUBMIT NOW
                                                    </div>
                                                    <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                                        Next Step
                                                    </div>
                                                </div>	  
                                                <!--end: Form Actions -->
                                            </form>		 
                                            <!--end: Form Wizard Form-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:: Content -->
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-clean btn-bold btn-upper btn-font-md" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-default btn-bold btn-upper btn-font-md">Submit</button>
                    </div> --}}
                </div>
            </div>
        </div>
        {{-- end::Demo Panel 2 --}}
        {{-- Add Rules Form Ends --}}
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/default.min.css"/>
        <script src="{{asset('assets/assets/app/bundle/app.bundle.js')}}"></script>
        <script src="{{asset('js/user.js')}}"></script>
        <script src="{{asset('rtl/custom/wizard/assets/app/custom/wizard/wizard-v2.js')}}"></script>
        <script src="{!!asset('rtl/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/select2.js')!!}"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
        <script>
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
                $(document).ready(function() {
                    $('.select2').select2();
                });
            </script>
            @endpush
            