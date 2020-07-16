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
    .select2-selection--single {
        height: 100% !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 50%;
    }
    
</style>
@endpush

@section('content')

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    
    {{-- Content Goes Here --}}
    <form action="{{route('object.bulk.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- begin:: Content Head --}}
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    BULK UPLOAD &nbsp;<i class="flaticon-upload"></i>
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
        <div class="kt-content  kt-grid__item kt-grid__item--fluid row w-100" id="kt_content">
            <div class="col-lg-6 col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__body">
                        <div class="form-group">
                            <label for="exampleSelect1">Company</label>
                            <select class="form-control select2" name="company">
                                @foreach ($companies as $company)
                                <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Country</label>
                            <select class="form-control select2" name="country">
                                @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">State</label>
                            <select class="form-control select2" name="state">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">Timezone</label>
                            <select class="form-control select2" name="timezone">
                                @foreach ($timezone as $timezoneItem)
                                <option value="{{$timezoneItem->id}}">{{$timezoneItem->type}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__body col-10">
                        <label class="pb-3" for="bulkFile">Attach file :</label>
                        <input class="dropzone-select btn btn-label-brand btn-bold btn-sm dz-clickable p-5" type="file" name="bulkFile" id="bulkFile">
                    </div>
                    <div class="col-12 py-3 px-4">
                        <a class="btn btn-outline-dark" href="{{asset('files/BulkUploadSampleFile.xlsx')}}" download="BulkUploadSampleFile.xlsx">BulkUploadSampleFile.xlsx</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- end:: Content --}}
    </form>
    {{-- Content Ends Here --}}

</div>
<!--end::Form-->

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
        $('.select2').select2();
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

<script src="{{asset('assets/assets/app/bundle/app.bundle.js')}}"></script>
<script src="{{asset('js/user.js')}}"></script>    

<script>
    /********** Functions Starts **********/

    /********** Functions Ends **********/
</script>
@endpush
    