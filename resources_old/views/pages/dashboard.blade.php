@extends('layouts.layout-users')

@push('styles')
@endpush

@section('content')
{{-- begin:: Content Head --}}
<div class="kt-subheader kt-grid__item">
  <div class="kt-subheader__main">
    <h4 class="text-dark p-3">
      <strong>Dashboard</strong>
    </h4>
    <span class="kt-subheader__separator kt-subheader__separator--v" ></span>
    <small>VEHICLES - {{$vehicles->count()}}</small>
    {{-- <a
      href="#"
      class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10"
      >
      Add New
    </a>--}}
    <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
      <input type="text" class="form-control" placeholder="Search order..." id="generalSearch" />
      <span class="kt-input-icon__icon kt-input-icon__icon--right">
        <span>
          <i class="flaticon2-search-1" ></i>
        </span>
      </span>
    </div>
  </div>
  {{-- <div class="kt-subheader__toolbar">
    <div class="kt-subheader__wrapper">
      <a href="#" class="btn kt-subheader__btn-secondary">
        Today
      </a>
      <a href="#" class="btn kt-subheader__btn-secondary">
        Month
      </a>
      <a href="#" class="btn kt-subheader__btn-secondary">
        Year
      </a>
      <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
        <span class="kt-subheader__btn-daterange-title">
          Today
        </span>
        &nbsp;
        <span class="kt-subheader__btn-daterange-date">
          Aug 16
        </span>
        <i class="flaticon2-calendar-1"></i>
      </a>
      <div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="Quick actions">
        <div class="dropdown-menu dropdown-menu-right">
          <ul class="kt-nav">
            <li class="kt-nav__section kt-nav__section--first">
              <span class="kt-nav__section-text">
                Add new:
              </span>
            </li>
            <li class="kt-nav__item">
              <a href="#" class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-graph-1" ></i>
                <span class="kt-nav__link-text">
                  Order
                </span>
              </a>
            </li>
            <li class="kt-nav__item">
              <a href="#" class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-calendar-4" ></i>
                <span class="kt-nav__link-text">
                  Event
                </span>
              </a>
            </li>
            <li class="kt-nav__item">
              <a href="#" class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-layers-1" ></i>
                <span class="kt-nav__link-text">
                  Report
                </span>
              </a>
            </li>
            <li class="kt-nav__item">
              <a href="#" class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-calendar-4" ></i>
                <span class="kt-nav__link-text">
                  Post
                </span>
              </a>
            </li>
            <li class="kt-nav__item">
              <a href="#" class="kt-nav__link">
                <i class="kt-nav__link-icon flaticon2-file-1" ></i>
                <span class="kt-nav__link-text">
                  File
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div> --}}
</div>
{{-- end:: Content Head --}}
{{-- ********************begin:: Content****************** --}}
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
  {{--Begin::Dashboard 3--}}
  {{--Begin::Section--}}
  <div class="kt-portlet">
    <div class="kt-portlet__body  kt-portlet__body--fit">
      <div class="row row-no-padding row-col-separator-xl">
        <div class="col-lg-4">
          {{--begin:: Widgets/Vehicle Summary--}}
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
              <div class="kt-widget14__header">
                <h3 class="kt-widget14__title">
                  VEHICLE SUMMARY
                </h3>
                <span class="kt-widget14__desc">
                  Vehicle Summary for all vehicles.
                </span>
              </div>
              <div class="kt-widget14__content">
                <div class="kt-widget14__chart">
                  <canvas id="vehicle_summery_company" style="height: 140px; width: 140px; display: block" width="175" height="175" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="kt-widget14__legends">
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-success" ></span>
                    <span class="kt-widget14__stats" id="Vehicle_Summery_Running" data="{!!$vehicleStatuses->running!!}">
                      {!!$vehicleStatuses->running!!} Running
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-warning" ></span>
                    <span class="kt-widget14__stats" id="Vehicle_Summery_Idle" data="{!!$vehicleStatuses->idle!!}">
                      {!!$vehicleStatuses->idle!!} Idle
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-danger" ></span>
                    <span class="kt-widget14__stats" id="Vehicle_Summery_Stop" data="{!!$vehicleStatuses->stop!!}">
                      {!!$vehicleStatuses->stop!!} Stop
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-brand" ></span>
                    <span class="kt-widget14__stats" id="Vehicle_Summery_Inactive" data="{!!$vehicleStatuses->inactive!!}">
                      {!!$vehicleStatuses->inactive!!} Inactive
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet bg-secondary" ></span>
                    <span class="kt-widget14__stats" id="Vehicle_Summery_NoData" data="{!!($vehicleStatuses->nodata != 0 ? $vehicleStatuses->nodata : ($vehicles->count() - ($vehicleStatuses->running + $vehicleStatuses->idle + $vehicleStatuses->stop + $vehicleStatuses->inactive)))!!}">
                      {!!($vehicleStatuses->nodata != 0 ? $vehicleStatuses->nodata : ($vehicles->count() - ($vehicleStatuses->running + $vehicleStatuses->idle + $vehicleStatuses->stop + $vehicleStatuses->inactive)))!!} No Data
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{--end:: Widgets/Vehicle Summary--}}
        </div>
        <div class="col-lg-4">
          {{--begin:: Widgets/Distance Per Day--}}
          <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-widget14">
              <div class="kt-widget14__header">
                <h3 class="kt-widget14__title">
                  VEHICLES WITH DISTANCE
                </h3>
                <span class="kt-widget14__desc">
                  Vehicle distance as per today's travel.
                </span>
              </div>
              @php
                  $distanceLessThan50 = $vehicles->count() - ($distanceData->range50to100 + $distanceData->range100to200 + $distanceData->range200to500 + $distanceData->greaterThan500);
              @endphp
              <div class="kt-widget14__content">
                <div class="kt-widget14__chart">
                  <div id="company_vehicles_distance" style="height: 150px; width: 150px"></div>
                </div>
                <div class="kt-widget14__legends">
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-success" ></span>
                    <span class="kt-widget14__stats" id="CompanyDistance_0_50" data="{{$distanceLessThan50}}">
                      ({{$distanceLessThan50}}) &nbsp;&nbsp; 0-50 KM
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-warning" ></span>
                    <span class="kt-widget14__stats" id="CompanyDistance_50_100" data="{{$distanceData->range50to100}}">
                      ({{$distanceData->range50to100}}) &nbsp;&nbsp; 50-100 KM
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-danger" ></span>
                    <span class="kt-widget14__stats" id="CompanyDistance_100_200" data="{{$distanceData->range100to200}}">
                      ({{$distanceData->range100to200}}) &nbsp;&nbsp; 100-200 KM
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-brand" ></span>
                    <span class="kt-widget14__stats" id="CompanyDistance_200_500" data="{{$distanceData->range200to500}}">
                      ({{$distanceData->range200to500}}) &nbsp;&nbsp; 200-500 KM
                    </span>
                  </div>
                  <div class="kt-widget14__legend">
                    <span class="kt-widget14__bullet kt-bg-dark" ></span>
                    <span class="kt-widget14__stats" id="CompanyDistance_500" data="{{$distanceData->greaterThan500}}">
                      ({{$distanceData->greaterThan500}}) &nbsp;&nbsp; ++500 KM
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{--end:: Widgets/Distance Per Day--}}
        </div>
        <div class="col-lg-4">
          <div class="card card-body text-right d-block kt-widget14 px-0 pb-0">
            <div class="text-left d-block kt-widget14__header p-3">
              <h3 class="kt-widget14__title">
                Fuel Consumption
              </h3>
              <span class="kt-widget14__desc">
                Fuel consumption monthly.
              </span>
              <div class="p-3" style="color: rgb(118, 33, 150);">
                <h1>
                  <strong>Not available</strong>
                </h1>
                <h5>
                  <strong>0 Vehicles</strong>
                </h5>
              </div>
            </div>
            <img src="{{asset('./assets/img/petrol.png')}}" style="width: 25%;height: auto;top: 15%;position: absolute;right: 10%" />
            <div class="kt-widget4__chart">
              <canvas id="kt_chart_bandwidth2" width="537" height="162" class="chartjs-render-monitor" style= "display: block; height: 130px;width: 430px;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{--End::Section--}}
  {{--Begin::Section--}}
  <div class="row">
    <div class="col-lg-8">
      <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
        <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Vehicle Alerts
            </h3>
          </div>
          <div class="kt-portlet__head-toolbar">
            <div class="dropdown dropdown-inline">
              <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="flaticon-more-1" ></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <ul class="kt-nav">
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-line-chart" ></i>
                      <span class="kt-nav__link-text">
                        Reports
                      </span>
                    </a>
                  </li>
                  <li class="kt-nav__item">
                    <a href="#" class="kt-nav__link">
                      <i class="kt-nav__link-icon flaticon2-settings" ></i>
                      <span class="kt-nav__link-text">
                        Settings
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="kt-portlet__body kt-portlet__body--fit">
          {{--begin: Datatable --}}
          {{-- <div class="kt-datatable" id="kt_datatable_latest_orders"></div> --}}
          {{--end: Datatable --}}
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      {{--begin:: Widgets/Last Updates--}}
      <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Reminder Alerts
            </h3>
          </div>
          <div class="kt-portlet__head-toolbar">
            <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
              Today
            </a>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
              <ul class="kt-nav">
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-line-chart" ></i>
                    <span class="kt-nav__link-text">
                      Today
                    </span>
                  </a>
                </li>
                {{-- <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-send" ></i>
                    <span class="kt-nav__link-text">
                      Tomorrow
                    </span>
                  </a>
                </li>
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-pie-chart-1" ></i>
                    <span class="kt-nav__link-text">
                      This Week.
                    </span>
                  </a>
                </li>
                <li class="kt-nav__item">
                  <a href="#" class="kt-nav__link">
                    <i class="kt-nav__link-icon flaticon2-avatar" ></i>
                    <span class="kt-nav__link-text">
                      Next 30 Days
                    </span>
                  </a>
                </li> --}}
              </ul>
            </div>
          </div>
        </div>
        <div class="kt-portlet__body bg-secondary">
          <div class="kt-widget4">
            {{-- <div class="kt-widget4__item">
              <span class="kt-widget4__icon">
                <i class="flaticon-car kt-font-info" ></i>
              </span>
              <a
              href="#"
              class="kt-widget4__title kt-widget4__title--light"
              >
              Tire Pressure!
            </a>
            <span class="kt-widget4__number kt-font-info">
              +500
            </span>
          </div>
          <div class="kt-widget4__item">
            <span class="kt-widget4__icon">
              <i class="fa fa-car kt-font-warning" ></i>
            </span>
            <a
            href="#"
            class="kt-widget4__title kt-widget4__title--light"
            >
            Car Service!
          </a>
          <span class="kt-widget4__number kt-font-warning">
            +1260
          </span>
        </div>
        <div class="kt-widget4__item">
          <span class="kt-widget4__icon">
            <i class="fa fa-burn text-danger" ></i>
          </span>
          <a href="#" class="kt-widget4__title kt-widget4__title--light">
            Fuel!
          </a>
          <span class="kt-widget4__number kt-font-danger">
            +13%
          </span>
        </div> --}}
        
      </div>
    </div>
    
    <button class="btn btn-success btn-sm w-100 p-3" onclick="alert('Comming Soon!')">
      <i class="fa fa-plus" ></i> Add Reminder Alert
    </button>
  </div>
  {{--end:: Widgets/Last Updates--}}
</div>
</div>
{{--End::Section--}}
{{--End::Dashboard 3--}}
</div>
{{-- end:: Content --}}
</div>

@endsection

@push('scripts')
<script src="{{asset('js/company_dashboard.js')}}"></script>
@endpush
