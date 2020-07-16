@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{!! asset('css/fa-animate.css') !!}">
<style>
  
  .select2-selection--single {
    height: 100% !important;
  }
  
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 50%;
  }
</style>
@endpush

@section('content')
{{-- {{dd($old)}} --}}
{{-- Content Goes Here --}}
<form action="{{route('add-user.create', $role_id)}}" method="POST" enctype="multipart/form-data">
  @csrf
  {{-- User Type --}}
  <input type="hidden" name="role_id" value="{{$role_id}}">
  {{-- ./ User Type --}}
  {{-- begin:: Content Head --}}
  <div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
      <h3 class="kt-subheader__title text-uppercase">Add {{$page_name}} &nbsp; <i class="fa fa-edit"></i></h3>
      <span class="kt-subheader__separator kt-subheader__separator--v"></span>
    </div>
    <div class="kt-subheader__toolbar">
      <a href="{{route('user', $role_id)}}" class="btn btn-clean btn-icon-sm">
        <i class="la la-long-arrow-left"></i>
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
  {{-- begin:: Content --}}
  <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet kt-portlet--tabs">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
          <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#my_account" role="tab" aria-selected="true">
                <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                  <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                    <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fillRule="nonzero" opacity="0.3"></path>
                    <path
                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                    id="Mask-Copy" fill="#000000" fillRule="nonzero"></path>
                  </g>
                </svg>
                &nbsp; My Account
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#user_setting" role="tab" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" xmlnsXlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                  <g stroke="none" strokeWidth="1" fill="none" fillRule="evenodd">
                    <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                    <path
                    d="M15.9497475,3.80761184 L13.0246125,6.73274681 C12.2435639,7.51379539 12.2435639,8.78012535 13.0246125,9.56117394 L14.4388261,10.9753875 C15.2198746,11.7564361 16.4862046,11.7564361 17.2672532,10.9753875 L20.1923882,8.05025253 C20.7341101,10.0447871 20.2295941,12.2556873 18.674559,13.8107223 C16.8453326,15.6399488 14.1085592,16.0155296 11.8839934,14.9444337 L6.75735931,20.0710678 C5.97631073,20.8521164 4.70998077,20.8521164 3.92893219,20.0710678 C3.1478836,19.2900192 3.1478836,18.0236893 3.92893219,17.2426407 L9.05556629,12.1160066 C7.98447038,9.89144078 8.36005124,7.15466739 10.1892777,5.32544095 C11.7443127,3.77040588 13.9552129,3.26588995 15.9497475,3.80761184 Z"
                    id="Combined-Shape" fill="#000000"></path>
                    <path
                    d="M16.6568542,5.92893219 L18.0710678,7.34314575 C18.4615921,7.73367004 18.4615921,8.36683502 18.0710678,8.75735931 L16.6913928,10.1370344 C16.3008685,10.5275587 15.6677035,10.5275587 15.2771792,10.1370344 L13.8629656,8.7228208 C13.4724413,8.33229651 13.4724413,7.69913153 13.8629656,7.30860724 L15.2426407,5.92893219 C15.633165,5.5384079 16.26633,5.5384079 16.6568542,5.92893219 Z"
                    id="Rectangle-2" fill="#000000" opacity="0.3"></path>
                  </g>
                </svg>
                &nbsp; Basic Setup
              </a>
            </li>
            @if(request()->segment(1) == 4)
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#branches" role="tab" aria-selected="false">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect id="bound" x="0" y="0" width="24" height="24"/>
                    <path d="M4.95312427,14.3025791 L3.04687573,13.6974209 C4.65100965,8.64439903 7.67317997,6 12,6 C16.32682,6 19.3489903,8.64439903 20.9531243,13.6974209 L19.0468757,14.3025791 C17.6880467,10.0222676 15.3768837,8 12,8 C8.62311633,8 6.31195331,10.0222676 4.95312427,14.3025791 Z M12,8 C12.5522847,8 13,7.55228475 13,7 C13,6.44771525 12.5522847,6 12,6 C11.4477153,6 11,6.44771525 11,7 C11,7.55228475 11.4477153,8 12,8 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                    <path d="M5.73243561,6 L9.17070571,6 C9.58254212,4.83480763 10.6937812,4 12,4 C13.3062188,4 14.4174579,4.83480763 14.8292943,6 L18.2675644,6 C18.6133738,5.40219863 19.2597176,5 20,5 C21.1045695,5 22,5.8954305 22,7 C22,8.1045695 21.1045695,9 20,9 C19.2597176,9 18.6133738,8.59780137 18.2675644,8 L14.8292943,8 C14.4174579,9.16519237 13.3062188,10 12,10 C10.6937812,10 9.58254212,9.16519237 9.17070571,8 L5.73243561,8 C5.38662619,8.59780137 4.74028236,9 4,9 C2.8954305,9 2,8.1045695 2,7 C2,5.8954305 2.8954305,5 4,5 C4.74028236,5 5.38662619,5.40219863 5.73243561,6 Z M12,8 C12.5522847,8 13,7.55228475 13,7 C13,6.44771525 12.5522847,6 12,6 C11.4477153,6 11,6.44771525 11,7 C11,7.55228475 11.4477153,8 12,8 Z M4,19 C2.34314575,19 1,17.6568542 1,16 C1,14.3431458 2.34314575,13 4,13 C5.65685425,13 7,14.3431458 7,16 C7,17.6568542 5.65685425,19 4,19 Z M4,17 C4.55228475,17 5,16.5522847 5,16 C5,15.4477153 4.55228475,15 4,15 C3.44771525,15 3,15.4477153 3,16 C3,16.5522847 3.44771525,17 4,17 Z M20,19 C18.3431458,19 17,17.6568542 17,16 C17,14.3431458 18.3431458,13 20,13 C21.6568542,13 23,14.3431458 23,16 C23,17.6568542 21.6568542,19 20,19 Z M20,17 C20.5522847,17 21,16.5522847 21,16 C21,15.4477153 20.5522847,15 20,15 C19.4477153,15 19,15.4477153 19,16 C19,16.5522847 19.4477153,17 20,17 Z" id="Combined-Shape" fill="#000000"/>
                  </g>
                </svg>
                &nbsp;&nbsp; Branch
              </a>
            </li>
            @endif
          </ul>
        </div>
      </div>
      <div class="kt-portlet__body">
        <div class="tab-content">
          {{-- My Profile Starts --}}
          <div class="tab-pane active" id="my_account" role="tabpanel">
            <div class="kt-form kt-form--label-right">
              <div class="kt-form__body pb-4">
                <div class="kt-section kt-section--first">
                  <div class="kt-section__body row">
                    <div class="col-lg-12">
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
                      {{-- {{dd($parent)}} --}}
                      {{-- Alerts Ends --}}
                      @if (count($parent) == 1)
                        {{-- For level One Child --}}
                        @foreach ($parent as $parentChild)
                        <input type="hidden" name="parent_id" value="{{$parentChild->id}}">
                        @endforeach
                        {{-- For level One Child --}}
                      @elseif(count($parent) > 1)
                        {{-- For Multi level Child --}}
                          <div class="form-group col-12">
                            <label class="col-12 col-form-label text-left text-uppercase">
                              Select parent user
                              <span class="text-danger h4" data-toggle="tooltip" title="This filed is required!">*</span>
                              &nbsp; &nbsp;:
                            </label>
                            <div class="row form_group form_group__name">
                                  @foreach ($parent as $index => $parentChild)
                                    @if($loop->iteration == 1)
                                      <input type="hidden" name="parent_id" value="{{$parentChild->id}}">
                                    @else
                                      <div class="col-3">
                                          <select class="form-control" name="parent_id" required>
                                          <option>Select {{$index}}</option>
                                            @forelse ($parentChild as $user)
                                              <option value="{{$user->id}}">{{$user->name}}</option>
                                            @empty
                                              <option value="">No User found</option>
                                            @endforelse
                                          </select>
                                      </div>
                                    @endif
                                  @endforeach
                            </div>
                          </div>
                          {{-- For Multi level Child --}}
                        @else
                          <div class="col-12">
                            <p>Some Error Occured!</p>
                            <a class="btn btn-brand px-4 py-2" href="{{ URL::previous() }}">BACK</a>
                          </div>
                        @endif
                        @if(count($parent) != 1)
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                        @endif
                      </div>
                      {{-- User Being Created For Ends --}}
                    <div class="col-lg-6">
                      <div class="form-group row pl-3 pr-2 mb-0">
                        <label class="col-12 col-form-label text-left">
                          Name
                          <span class="text-danger h4" data-toggle="tooltip" title="This filed is required!">*</span>
                          &nbsp; &nbsp;:
                        </label>
                        <div class="col-12 form_group form_group__name">
                        <input class="form-control" id="name" type="text" placeholder="Divye" name="name" value="{{old('name')}}" />
                        </div>
                      </div>
                      <div class="form-group row pl-3 pr-2">
                        <label class="col-12 col-form-label text-left">
                          User Name <small class="text-primary">(Type your email address here.)</small>
                          <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                          &nbsp; &nbsp;:
                        </label>
                        <div class="col-12">
                          <input class="form-control name_validate" name="user_name" type="text" placeholder="Type Email ID here.." value="{{old('user_name')}}" />
                          <span class="form-text text-muted">
                            This email will also be used by
                            Indian Auto Company for further
                            communication with you via Email.
                          </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Password
                            <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                          </label>
                          <div class="col-12">
                            <div class="input-group">
                              <input class="form-control" autocomplete="off" type="password" placeholder="******" name="password" value="{{old('password')}}" />
                              <div class="input-group-append">
                                <a class="btn btn-secondary" href="javascript:;" onclick="showPassword()">
                                  <i class="flaticon-eye"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Confirm Password
                            <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                          </label>
                          <div class="col-12 form-group">
                            <div class="input-group">
                              <input class="form-control" autocomplete="off" type="password" placeholder="******" name="confirm_password" value="{{old('confirm_password')}}" />
                              <div class="input-group-append">
                                <a class="btn btn-secondary" href="javascript:;" onclick="showPassword()">
                                  <i class="flaticon-eye"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Contact Person
                          </label>
                          <div class="col-12">
                          <input class="form-control" type="text" name="contact_person" placeholder="Enter full name.."  value="{{old('contact_person')}}" />
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Mobile Number
                          </label>
                          <div class="col-12">
                            <input type="text" class="form-control" name="mobile_number" placeholder="Enter mobile number" aria-describedby="basic-addon1" value="{{old('mobile_number')}}" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group row d-none">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Telephone Number
                          </label>
                          <div class="col-12">
                            <input class="form-control" type="text" name="telephone_number" placeholder="Enter telephone number.." value="{{old('telephone_number')}}" />
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Fax Number
                          </label>
                          <div class="col-12">
                            <input type="text" class="form-control" name="fax_number" placeholder="Enter fax number" aria-describedby="basic-addon1" value="{{old('fax_number')}}" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Country
                          </label>
                          <div class="col-12">
                            <select class="form-control select2" name="country">
                              @foreach ($countries as $country)
                              <option value="{{$country->id}}">{{$country->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left" class="state">
                            State
                          </label>
                          <div class="col-12">
                            <select class="form-control select2" name="state">
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            City
                          </label>
                          <div class="col-12">
                            <select class="form-control select2" name="city">
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Zip-code
                          </label>
                          <div class="col-12">
                          <input type="text" class="form-control" name="zip_code" placeholder="Type Zip Code.." value="{{old('zip_code')}}" aria-describedby="basic-addon1" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group form-group-last">
                        <label class="col-12 col-form-label text-left">
                          Full Address&nbsp; &nbsp;:
                        </label>
                        <div class="col-12">
                          <div class="input-group">
                          <textarea type="text" class="form-control" name="full_address" placeholder="Type Full Address here.." aria-describedby="basic-addon1">{{old('full_address')}}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group row">
                        <div class="col-xl-3 col-lg-3 text-center pt-3">
                          <p class="text-center">Profile Image</p>
                          <small class="text-left">Recommended image resolution : 400 X 400.</small>
                        </div>
                        
                        <div class="col-lg-9 col-xl-6">
                          <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_apps_user_add_avatar">
                            <div class="kt-avatar__holder">
                            </div>
                            <label class="kt-avatar__upload" data-toggle="kt-tooltip" title data-original-title="Change avatar">
                              <i class="fa fa-pen"></i>
                              <input type="file" id="profile_image" name="profile_image" accept=".png, .jpg, .jpeg" />
                            </label>
                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title data-original-title="Cancel avatar">
                              <i class="fa fa-times"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- My Profile Ends --}}
          {{-- Basic Setup --}}
          <div class="tab-pane" id="user_setting" role="tabpanel">
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
          </div>
          {{-- Basic Setup Ends --}}
          
          
          
          {{-- Branches --}}
          @if(Request::segment(1) == 4)
          <div class="tab-pane" id="branches" role="tabpanel">
            <div class="kt-form kt-form--label-right">
              <div class="kt-form__body pb-4">
                <div class="kt-section kt-section--first">
                  <div class="kt-section__body row">
                    <div class="col-lg-8">
                      <div class="form-group row pl-3 pr-2 mb-0">
                        <label class="col-12 col-form-label text-left">
                          Branch Name
                          <span class="text-danger h4" data-toggle="tooltip" title="This filed is required!">*</span>
                          &nbsp; &nbsp;:
                        </label>
                        <div class="col-12 form_group form_group__name">
                          <input class="form-control" id="branch_name" type="text" placeholder="Type branch name here.." name="branch_name" value="{{old('branch_name')}}" />
                        </div>
                      </div>
                      
                      <div class="form-group row pl-3 pr-2 py-3">
                        <label class="col-12 col-form-label text-left">
                          Email Address <small class="text-primary">(Type your email address here.)</small>
                          <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                          &nbsp; &nbsp;:
                        </label>
                        <div class="col-12">
                          <input class="form-control" name="branch_email" type="text" placeholder="Type branch Email ID here.." value="{{old('branch_email')}}"/>
                          {{-- <span class="form-text text-muted">
                            This email will also be used by
                            Indian Auto Company for further
                            communication with you via Email.
                          </span> --}}
                        </div>
                      </div>
                      <div class="form-group row pl-3 pr-2">
                        <h5 class="col-12 pl-0 mx-3 pb-3">BRANCH LOGIN CREDENTIALS</h5>
                        <br>
                        <label class="col-12 col-form-label text-left">
                          User Name <small class="text-primary">(Type your email address here.)</small>
                          <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                          &nbsp; &nbsp;:
                        </label>
                        <div class="col-12">
                          <input class="form-control name_validate" name="branch_user_name" type="text" placeholder="Type Email ID here.." value="{{old('branch_user_name')}}" />
                          <span class="form-text text-muted">
                            This email will also be used by
                            Indian Auto Company for further
                            communication with you via Email.
                          </span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Password
                            <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                          </label>
                          <div class="col-12">
                            <input class="form-control" type="password" placeholder="******" name="branch_password" value="{{old('branch_user_name')}}"  />
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Confirm Password
                            <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                          </label>
                          <div class="col-12 form-group">
                            <input class="form-control"  type="password" placeholder="******" name="branch_confirm_password" value="{{old('branch_confirm_password')}}" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Contact Person
                          </label>
                          <div class="col-12">
                            <input class="form-control" type="text" name="branch_contact_person" placeholder="Enter branch full name.." value="{{old('branch_contact_person')}}" />
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Mobile Number
                          </label>
                          <div class="col-12">
                            <input type="text" class="form-control" name="branch_mobile_number" placeholder="Enter branch mobile number" aria-describedby="basic-addon1" value="{{old('branch_mobile_number')}}" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Fax Number
                          </label>
                          <div class="col-12">
                            <input type="text" class="form-control" name="branch_fax_number" placeholder="Enter branch fax number" aria-describedby="basic-addon1" value="{{old('branch_fax_number')}}" />
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Country
                          </label>
                          <div class="col-12">
                            <select class="form-control select2" name="branch_country">
                              @foreach ($countries as $country)
                              <option value="{{$country->id}}">{{$country->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left" class="state">
                            State
                          </label>
                          <div class="col-12">
                            <select class="form-control select2" name="branch_state">
                            </select>
                          </div>
                        </div>
                        <div class="col-6">
                          <label class="col-12 text-left">
                            City
                          </label>
                          <div class="col-12">
                            <select class="form-control select2" name="branch_city">
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-6">
                          <label class="col-12 text-left">
                            Zip-code
                          </label>
                          <div class="col-12">
                          <input type="text" class="form-control" name="branch_zip_code" placeholder="Type Branch Zip Code.." aria-describedby="basic-addon1" value="{{old('branch_zip_code')}}" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group form-group-last">
                        <label class="col-12 text-left">
                          Full Address&nbsp; &nbsp;:
                        </label>
                        <div class="col-12">
                          <div class="input-group">
                            <textarea type="text" class="form-control" name="branch_full_address" placeholder="Type Full Address of branch here.." aria-describedby="basic-addon1">{{old('branch_zip_code')}}</textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endif
          {{-- Branches Ends --}}



        </div>
      </div>
       <!--begin: Form Actions -->					
    <div class="card card-body">
      <div class="kt-form__actions m-3">
        <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
          Previous
        </div>
        <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
          Next Step
        </div>
      </div>
    </div>
    <!--end: Form Actions -->
    </div>
  </div>
  {{-- Payment Gateway Ends --}}
</div>
{{-- {{ dd() }} --}}
</form>
{{-- end:: Content --}}
{{-- Content Ends Here --}}

@endsection

@push('scripts')

<script src="{!!asset('assets/assets/app/custom/general/dashboard.js')!!}"></script>
<script src="{!!asset('rtl/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/select2.js')!!}"></script>
<script src="{!!asset('js/script.js')!!}"></script>
<script src="{!!asset('rtl/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/form-repeater.js')!!}"></script>
<script src="{!! asset('rtl/crud/forms/widgets/assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') !!}" charset="utf-8"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2();
    $('#kt_form_button').click(function() {
      $('#kt_demo_panel').addClass('kt-demo-panel--on');
    });
    $('#kt_demo_panel_close').click(function() {
      $('#kt_demo_panel').removeClass('kt-demo-panel--on');
    });
  });
  
  
  var countrySelect = $('.select2[name="country"], .select2[name="branch_country"]');
  var stateSelect = $('.select2[name="state"], .select2[name="branch_state"]');
  var citySelect = $('.select2[name="city"], .select2[name="branch_city"]');
  stateSelect.html('<option>Please choose country.</option>');
  citySelect.html('<option>Please choose state.</option>');
  // COUNTRY SELECTION
  countrySelect.on("select2:select", function (e) {
    stateSelect.html('<option>Select State.</option>');
    citySelect.html('<option>Please choose state.</option>');
    let selectedCountry = e.params.data.id;
    $.ajax({
      type: "POST",
      url: "{{route('getStates')}}",
      data: {
        _token: "{{csrf_token()}}",
        country_id: selectedCountry
      },
      success: function(response) {
        if(response.length > 0) {
          response.forEach(function($value){
            stateSelect.append("<option value='"+$value.id+"'>" + $value.district + "</option>");
          });
        } else {
          stateSelect.html('<option>Please choose country.</option>');
          citySelect.html('<option>Please choose state.</option>');
        }
      }
    });
  });

  // STATE SELECTION
  stateSelect.on("select2:select", function (e) {
    citySelect.html('<option>Select City.</option>');
    let selectedState = e.params.data.id;
    $.ajax({
      type: "POST",
      url: "{{route('getCities')}}",
      data: {
        _token: "{{csrf_token()}}",
        state_id: selectedState
      },
      success: function(response) {
        if(response.length > 0) {
          response.forEach(function($value){
            citySelect.append("<option value='"+$value.id+"'>" + $value.name + "</option>");
          });
        } else {
          citySelect.html('<option>Please choose state.</option>');
        }
      }
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
        <div class="">
          <div class="form-group">
            <label>
              Rule Name
              <span class="text-danger h4 mt-1" data-toggle="tooltip" title="This field is required!">*</span>
              :
            </label>
            <input type="text" class="form-control" placeholder="Enter rule name" name="rule_name" />
          </div>
          <div class="form-group">
            <label>Description:</label>
            <textarea class="form-control" placeholder="Write here.." name="description"></textarea>
            {{-- <span class="form-text text-muted">
              We'll never share your email with anyone else
            </span> --}}
          </div>
          <div class="form-group">
            <label>
              Valid From
              <span class="text-danger h4 mt-1" data-toggle="tooltip" title="This field is required!">*</span>
              :
            </label>
            <input type="text" class="form-control" id="kt_datepicker_1" placeholder="Valid from.." name="valid_from" />
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
                <select class="form-control rounded-0" name="device_dictance_variation_sign">
                  <option value="">Select Sign</option>
                  <option value="1">+</option>
                  <option value="2">-</option>
                </select>
              </div>
              <input type="hidden" name="device_dictance_variation_sign" value="">
              <select class="form-control rounded-0" name="device_dictance_variation">
                <option value="">Select Variation</option>
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
                <input type="checkbox" name="show_cluster" /> Show Cluster
                <span></span>
              </label>
            </div>
          </div>
          
          <div class="form-group">
            <label>Set Startup Screen :</label>
            <select class="form-control col-5" name="startup_screen">
              <option value="">Select</option>
              <option value="1">Dashboard</option>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.css">

<script src="{{asset('js/user.js')}}"></script>
<script>
// var input_parent = document.querySelectorAll('[name="parent_id[]"]');
// console.log(input_parent);

// if(input_parent.length != 0) {
//   $.alert({
//     title: '<h3 class="border-bottom border-danger pb-3">Sorry!!</h3><small style="color: #e74c3c;">You cannot access this screen.</small>',
//     content: 'Please note if you are a admin or company then you need to make at lease one company or branch to create their respective branch or user!',
//     type: 'red',
//     buttons: {
//       somethingElse: {
//             text: 'MY DASHBOARD',
//             btnClass: 'btn-red rounded-0',
//             keys: ['enter', 'shift'],
//             action: function(){
//               window.location.replace('/dashboard');
//             }
//         }
//     }
//   });
// }
</script>
@endpush
