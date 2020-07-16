@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/account.css') }}">
<link rel="stylesheet" href="{!! asset('css/fa-animate.css') !!}">
<style>
  #kt_content{
    margin-top: -40px;
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 50%;
  }
  .select2-container--default {
    width: 100% !important;
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
        {{-- My Profile Starts --}}
        <div class="kt-portlet kt-portlet--height-fluid px-4 py-5">
          <form action="{{route('account.update.details', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
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
              {{-- User Being Created For Ends --}}
              <div class="col-lg-6">
                <div class="form-group row pl-3 pr-2 mb-0">
                  <label class="col-12 col-form-label text-left">
                    Name
                    <span class="text-danger h4" data-toggle="tooltip" title="This filed is required!">*</span>
                    &nbsp; &nbsp;:
                  </label>
                  <div class="col-12 form_group form_group__name">
                    <input class="form-control" id="name" type="text" placeholder="Divye" name="name" value="{{$user->name}}" />
                  </div>
                </div>
                <div class="form-group row pl-3 pr-2">
                  <label class="col-12 col-form-label text-left">
                    User Name <small class="text-primary">(Type your email address here.)</small>
                    <span class="text-danger h4" data-toggle="tooltip" title="This field is required!">*</span>
                    &nbsp; &nbsp;:
                  </label>
                  <div class="col-12">
                    <input class="form-control name_validate" name="user_name" type="text" placeholder="Type Email ID here.." value="{{$user->user_name}}" />
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-6">
                    <label class="col-12 text-left">
                      Contact Person
                    </label>
                    <div class="col-12">
                      <input class="form-control" type="text" name="contact_person" placeholder="Enter full name.."  value="{{$user->contact_person}}" />
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="col-12 text-left">
                      Mobile Number
                    </label>
                    <div class="col-12">
                      <input type="text" class="form-control" name="mobile_number" placeholder="Enter mobile number" aria-describedby="basic-addon1" value="{{$user->mobile_number}}" />
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
                        <option value="{{$country->id}}" {{$country->id == $city->countries->id ? "selected='selected'" : ""}}>{{$country->name}}</option>
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
                        <option value="{{$city->id}}">{{$city->district}}</option>
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
                        <option value="{{$city->id}}">{{$city->name}}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">
                    <label class="col-12 text-left">
                      Zip-code
                    </label>
                    <div class="col-12">
                      <input type="text" class="form-control" name="zip_code" placeholder="Type Zip Code.." value="{{$user->zipcode}}" aria-describedby="basic-addon1" />
                    </div>
                  </div>
                </div>
                <div class="form-group form-group-last">
                  <label class="col-12 col-form-label text-left">
                    Full Address&nbsp; &nbsp;:
                  </label>
                  <div class="col-12">
                    <div class="input-group">
                      <textarea type="text" class="form-control" name="full_address" placeholder="Type Full Address here.." aria-describedby="basic-addon1">{{$user->full_address}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 m-auto pt-5 bg-secondary rounded">
                <div class="form-group row text-center">
                  <div class="col-xl-3 col-lg-3 text-center pt-3 mx-auto">
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
            <div class="kt-portlet__foot mt-5">
              <div class="kt-form__actions">
                <div class="row">
                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-brand btn-bold">
                      <i class="fa fa-check-circle"></i>  Save
                    </button>&nbsp;
                    <a href="{{route('account.edit')}}" class="btn btn-secondary">
                      <i class="la la-times"></i> Cancel
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        {{-- My Profile Ends --}}
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.css">

<script src="{{asset('js/user.js')}}"></script>
<script>
  @if($user->photo)
  $(document).ready(function() {
    $('.kt-avatar__holder').css('background-image', "url('{!!'/' . decrypt($user->photo)!!}')");
  });
  @endif
  var countrySelect = $('.select2[name="country"], .select2[name="branch_country"]');
  var stateSelect = $('.select2[name="state"], .select2[name="branch_state"]');
  var citySelect = $('.select2[name="city"], .select2[name="branch_city"]');
  // COUNTRY SELECTION
  countrySelect.on("select2:select", function (e) {
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
@endpush