@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/multiple-select@1.3.1/dist/multiple-select.css">
<link rel="stylesheet" href="{{asset('css/reports.css')}}">
<style>
    select {
        display: none !important;
    }
    .multipleselect {
        padding: 0rem 0;
        height: auto;
    }
    .multipleselect button {
        padding: 1.5rem 0;
        border: 0;
        background-color: #f7f7f7;
    }
    .ms-choice > div {
        top: 15% !important;
    }
</style>
@endpush

@section('content')
{{-- Content Goes Here --}}

<div class="kt-portlet kt-portlet--mobile" style="margin-top: -4rem;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-placeholder"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                TRAVEL REPORT
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <div class="dropdown dropdown-inline">
                        <button class="btn btn-sm kt-subheader__btn-daterange btn-outline-brand" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Select custom range" data-placement="left">
                            <span class="kt-subheader__btn-daterange-title" id="change_text">
                                Today
                            </span>
                            <i class="flaticon2-calendar-1"></i>
                        </button>
                    </div>
                    <b data-toggle="kt-tooltip" title="" data-html="true" data-content="ADVANCE <b>FILTERS</b>" data-original-title="&nbsp;&nbsp;<b><i class='fa fa-filter'></i> ADVANCE FILTERS</b>&nbsp;&nbsp;" data-placement="left">
                    <button class="btn btn-sm kt-subheader__btn-daterange" data-toggle="collapse" data-target="#collapseOne8" aria-expanded="false" aria-controls="collapseOne8">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"/>
                                <path d="M7.5,11 L16.5,11 C17.3284271,11 18,11.6715729 18,12.5 C18,13.3284271 17.3284271,14 16.5,14 L7.5,14 C6.67157288,14 6,13.3284271 6,12.5 C6,11.6715729 6.67157288,11 7.5,11 Z M10.5,17 L13.5,17 C14.3284271,17 15,17.6715729 15,18.5 C15,19.3284271 14.3284271,20 13.5,20 L10.5,20 C9.67157288,20 9,19.3284271 9,18.5 C9,17.6715729 9.67157288,17 10.5,17 Z" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg>
                    </button>
                </b>
                &nbsp;
            </div>
        </div>
    </div>
</div>
<div class="kt-portlet__body">

    <div class="accordion accordion-solid accordion-panel accordion-toggle-svg mb-3" id="accordionExample8">
        <div id="collapseOne8" class="collapse border p-3" aria-labelledby="headingOne8" data-parent="#accordionExample8" style="">
            <form class="kt-form kt-form--fit kt-margin-b-20" action="{{route('travel.report.modify')}}" method="POST">
                @csrf
                <div class="row kt-margin-b-20">
                    <div class="col-lg-3">
                        <label>Company:</label>
                        <select class="form-control multipleselect" multiple="multiple" name="company[]">
                            <option value="">Select</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Austria">Austria</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Thailand">Thailand</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Branch:</label>
                        <select class="form-control multipleselect" multiple="multiple" name="branch[]">
                            <option value="">Select</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Austria">Austria</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Thailand">Thailand</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Device Name:</label>
                        <select class="form-control multipleselect" multiple="multiple" name="device_name[]">
                            <option value="">Select</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Austria">Austria</option>
                            <option value="China">China</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Thailand">Thailand</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Status:</label>
                        <select class="form-control multipleselect" multiple="multiple" name="status[]">
                            <option value="">Select</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                            <option value="3">Idle</option>
                            <option value="5">Stopped</option>
                        </select>
                    </div>
                </div>
                <div class="row kt-margin-b-20">
                    <div class="col-lg-3">
                        <label for="daterange">Date:</label>
                        <input class="form-control dateRangeTrigger text-center" readonly type="text" id="daterange" name="daterange">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <button class="btn btn-primary btn-brand--icon" id="kt_search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                        &nbsp;&nbsp;
                        <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--begin: Datatable -->
    <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_1">
        <thead>
            <tr>
                <th>S. No.</th>
                <th>VEHICLE</th>
                <th>DRIVER</th>
                <th>IMEI</th>
                <th>DISTANCE</th>
                <th>RUNNING</th>
                <th>IDLE</th>
                <th>STOP</th>
                <th>INACTIVE</th>
                <th>FIRST IGN ON</th>
                <th>LAST IGN OFF</th>
                <th>AVG</th>
                <th>MAX</th>
                <th>OVERSPEED</th>
                <th>ALERT</th>
                <th>NO. OF TRIPS</th>
                <th>PLAYBACK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->sortByDesc('distance') as $item)
            <tr onclick="callChildRow({{$loop->iteration}})" data-toggle="tooltip" data-html="true" data-value="{{$loop->iteration}}" title="Click to see trips..">
                <td>{{$loop->iteration}}</td>
                <td>{{$item->object}}</td>
                <td>#NA</td>
                <td>{{$item->imei}}</td>
                <td>
                    <span>{{$item->distance}}</span>
                </td>
                <td>
                    <span>{{$item->running}}</span>
                </td>
                <td></td>
                <td>
                    <span>{{$item->stop}}</span>
                </td>
                <td></td>
                <td>
                    <span>{{$item->start_ign_on}}</span>
                </td>
                <td>
                    <span>{{$item->end_ign_off}}</span>
                </td>
                <td>{{$item->average_speed}}</td>
                <td>{{$item->max_speed}}</td>
                <td></td>
                <td></td>
                <td class="text-center"><b class="badge badge-success">{!!$item->tripCount!!}</td>
                <td class="text-center">
                    <span>
                        <a href="{{route('map.playback', $item->imei)}}" target="_blank" title="Playback" class="btn-icon btn-icon-md border-0 bg-secondary btn-circle btn btn-light btn-elevate-hover btn-square">
                            <img src="{{asset('img/playback.png')}}" alt="PLAYBACK" width="30">
                        </a>
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!--end: Datatable -->
    </div>
    <div class="card card-body">
        <div class="container-fluid">
            <div class="row">
                {{$data->links()}}
            </div>
        </div>
    </div>

</div>
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
<script>
    $('.multipleselect').multipleSelect({
        filter: true
    });
    // Date Range
    $(function() {
        var startDateShow = moment().subtract(0, 'days');
        var endDateShow = moment();
        var customizedDate = "<b class='text-muted'>Today</b>&nbsp;&nbsp;&nbsp;" + startDateShow.format('D MMMM');
        @if(isset($endDate))
        startDateShow = moment(new Date("{{$startDate}}"));
        endDateShow = moment(new Date("{{$endDate}}"));
        var customizedDate = startDateShow.format('D/M/Y') + " - " + endDateShow.format('D/M/Y');
        @endif
        $('#kt_dashboard_daterangepicker span').html(customizedDate);

        $('#kt_dashboard_daterangepicker').daterangepicker({
            startDate: endDateShow,
            endDate: startDateShow,
            buttonClasses: ['btn rounded-0'],
            applyClass: 'btn-small btn-success',
            cancelClass: 'btn-small btn-danger',
            locale: {
                "format": "DD, MMMM YYYY"
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, function cb(start, end) {
            var newForm = jQuery('<form>', {
                'action': "{{route('travel.report.modify')}}",
                'method': 'POST'
            }).append(jQuery('<input>', {
                'name': '_token',
                'value': '{{ csrf_token() }}',
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'from_date',
                'value': ""+end._d.getDate()+"-"+(end._d.getMonth()  + 1)+"-"+end._d.getFullYear()+"",
                'type': 'hidden'
            })).append(jQuery('<input>', {
                'name': 'to_date',
                'value': ""+start._d.getDate()+"-"+(start._d.getMonth()  + 1)+"-"+start._d.getFullYear()+"",
                'type': 'hidden'
            }));
            $('body').append(newForm);
            newForm.submit();
        });
    });
    // Date Range Ends

    // Advance filter Date range picker
    $('.dateRangeTrigger').trigger('change');
    var dateDefault = moment();
    var datePrevious = moment().subtract(1, 'd');
    $('#daterange').daterangepicker({
        alwaysShowCalendars: true,
        startDate: datePrevious,
        endDate: dateDefault,
        locale: {
            "format": "DD, MMMM YYYY"
        },
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    });
</script>
@endpush
