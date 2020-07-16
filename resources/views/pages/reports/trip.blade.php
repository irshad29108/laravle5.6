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
                TRIP REPORT
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
</div> {{-- Content Goes Here --}}
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid p-3">
    <div class="kt-portlet kt-portlet--mobile">
        {{--begin: Page Name --}}
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title text-uppercase">
                    TRIP List
                </h3>
            </div>
        </div>
        {{--end: Search Form --}}
        {{-- {{dd()}} --}}
        <div class="kt-datatable kt-datatable--default">
            <table class="table table-bordered table-hover table-checkable" id="kt_table_1">
                <thead>
                    <tr>
                        <th></th>
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
                        @if(!isset($item->object))
                            @php
                                continue;
                            @endphp
                        @endif
                        <tr onclick="callChildRow({{$loop->iteration}})"
                            data-toggle="tooltip"
                            data-html="true"
                            data-value="{{$loop->iteration}}"
                            title="Click to see trips..">
                            <td class="kt-datatable__cell--center kt-datatable__cell" data-field="RecordID" style="vertical-align:middle">
                                <i style="width: 30px;" class="fa fa-caret-right btn">
                                </i>
                            </td>
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
                            <td class="text-center">{!!$item->trips->count() > 0 ? '<b class="badge badge-success">' . $item->trips->count() .'</b>' : $item->trips->count()!!}</td>
                            <td></td>
                        </tr>
                        @if($item->trips->count() > 0)
                        <tr style="display:none;" data-table-row="{{$loop->iteration}}">
                            <td class="kt-datatable__subtable bg-secondary" colspan="18">
                                <div id="child_data_local_1" class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded" style="">
                                    <div class="kt-portlet__head kt-portlet__head--lg bg-dark shadow">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title text-capitlize text-white">
                                                TRIP DETAILS
                                            </h3>
                                        </div>
                                    </div>
                                    <table  class="table table-striped table-bordered table-hover table-checkable shadow-lg">
                                        <thead>
                                            <tr>
                                                <th class="border border-dark bg-secondary">
                                                    <span>S. No.</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>IMEI</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Average Speed</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Distance</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Start Location</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Running</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Stop</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>End Location</span>
                                                </th>
                                                <th class="border border-dark bg-secondary d-none">
                                                    <span>Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="kt-datatable__body" style="overflow-y:scroll; max-height: 300px; width:100%">
                                            @foreach ($item->trips as $trip)
                                            <tr class="kt-datatable__row bg-white">
                                                <td>
                                                    <span>{{$loop->iteration}}</span>
                                                </td>
                                                <td>
                                                    <span>{{$trip->imei}}</span>
                                                </td>
                                                <td>
                                                    <span>{{ number_format($trip->average_speed, 2)}} KM/H</span>
                                                </td>
                                                <td>
                                                    <span>{{$trip->distance}}</span>
                                                </td>
                                                <td>
                                                    <span>{{$trip->from_location}}</span>
                                                </td>
                                                <td>
                                                    <span>{{$trip->running}}</span>
                                                </td>
                                                <td>
                                                    <span>{{$trip->stop}}</span>
                                                </td>

                                                <td>
                                                    <span>{{$trip->to_location}}</span>
                                                </td>
                                                <td class="d-none" nowrap>
                                                    <span class="dropdown">
                                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="la la-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right m-0" x-placement="bottom-end">
                                                            <a class="dropdown-item" href="#">
                                                                <i class="la la-edit text-success"></i>
                                                                EDIT
                                                            </a>
                                                            <a class="dropdown-item" href="#">
                                                                <i class="la la-gear text-primary"></i>
                                                                SETTINGS
                                                            </a>
                                                            {{-- <a class="dropdown-item" href="#"><i class="la la-trash text-danger"></i> Delete</a> --}}
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card card-body">
        <div class="container-fluid">
            <div class="row">
                {{$data->links()}}
            </div>
        </div>
    </div>
</div>
{{-- end:: Content --}}
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
<script src="{{asset('js/reports.js')}}"></script>
<script>
    $('.multipleselect').multipleSelect({
        filter: true
    });
    // Date Range
    $(function() {
        var startDateShow = moment().subtract(0, 'days');
        var endDateShow = moment();
        var customizedDate = "<b class='text-muted'>Today</b>&nbsp;&nbsp;&nbsp;" + startDateShow.format('DD-MM-YY');
        @if(isset($endDate))
        startDateShow = moment(new Date("{{$startDate}}"));
        endDateShow = moment(new Date("{{$endDate}}"));
        var customizedDate = startDateShow.format('DD-MM-YY') + " - " + endDateShow.format('DD-MM-YY');
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
                'action': "{{route('trip.report.modify')}}",
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

    // TRIPS HIDE/SHOW
    function callChildRow(row) {
        var table = $('#kt_table_1');
        const el = $('tr[data-table-row="'+row+'"]');
            var caret = $('tr[data-value="'+row+'"] td.kt-datatable__cell i');
        if(el.css('display') === 'none') {
            caret.removeClass('fa fa-caret-right').addClass('fa fa-caret-down');
            el.css('display', 'table-row');
        } else {
            el.css('display', 'none');
            caret.removeClass('fa fa-caret-down').addClass('fa fa-caret-right');
        }
    }
</script>
@endpush
