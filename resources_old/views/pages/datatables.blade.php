@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{asset('rtl/crud/datatables/basic/assets/vendors/custom/datatables/datatables.bundle.rtl.css')}}">
<style>
    .kt-grid__item.kt-grid__item--fluid.kt-grid.kt-grid--hor {
        margin-top: -2.1rem;
    }
    .dt-buttons {
        display: none;
    }
    .dataTables_filter {
        z-index: 10;
        position: inherit;
    }
    #laravel-pagination {
        margin-bottom: -4rem;
        z-index: 1;
    }
    #kt_table_1_filter {
        padding-left: 1rem;
        padding-top: 1rem;
    }
</style>
@endpush

@section('content')
{{-- Content Goes Here --}}
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-line-chart"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                {{$pageName}}
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <div class="kt-portlet__head-actions">
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="la la-download"></i> Export
                        </button>
                        {{-- Select Date Time --}}
                        <button
                        class="btn kt-subheader__btn-daterange btn-outline-brand"
                        id="kt_dashboard_daterangepicker"
                        data-toggle="kt-tooltip"
                        title="Select custom range"
                        data-placement="left">
                        <span class="kt-subheader__btn-daterange-title" id="change_text">
                            Today
                        </span>
                        <i class="flaticon2-calendar-1"></i>
                    </button>
                    {{-- Selection daterange ends --}}
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__section kt-nav__section--first">
                                <span class="kt-nav__section-text">Choose an option</span>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="#" id="export_print">
                                    <i class="kt-nav__link-icon la la-print"></i>
                                    <span class="kt-nav__link-text">Print</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="#" id="export_copy">
                                    <i class="kt-nav__link-icon la la-copy"></i>
                                    <span class="kt-nav__link-text">Copy</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="#" id="export_excel">
                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                    <span class="kt-nav__link-text">Excel</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="#" id="export_csv">
                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                    <span class="kt-nav__link-text">CSV</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a class="kt-nav__link" href="#" id="export_pdf">
                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                    <span class="kt-nav__link-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                &nbsp;
                    {{-- <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                        <i class="la la-plus"></i>
                        New Record
                    </a> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile pt-4">
            <div class="col-12 d-none px-3" id="laravel-pagination">
                <div class="pull-right">{{$data->links()}}</div>
            </div>
            <div class="kt-portlet__body px-0">
                <!--begin: Datatable -->
                <table class="table table-striped table-bordered table-hover table-responsive border-0 w-100 h-100" id="kt_table_1">
                    <thead>
                        <tr>
                            @foreach ($columns as $column)
                            <th>{{$column}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr>
                            @foreach ($row as $row_value)
                            <td>{{$row_value}}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end: Datatable -->
</div>
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script src="{{asset('rtl/crud/datatables/basic/assets/vendors/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('js/datatables.js')}}"></script>
<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#laravel-pagination').removeClass('d-none');
        $("#export_print").on("click", function() {
            $('.buttons-print').trigger('click');
        }),
        $("#export_copy").on("click", function() {
            $('.buttons-copy').trigger('click');
        }),
        $("#export_excel").on("click", function() {
            $('.buttons-excel').trigger('click');
        }),
        $("#export_csv").on("click", function() {
            $('.buttons-csv').trigger('click');
        }),
        $("#export_pdf").on("click", function() {
            $('.buttons-pdf').trigger('click');
        });



        // Date Range
        $(function() {

            var start = moment().subtract(0, 'days');
            var end = moment();


            $('#kt_dashboard_daterangepicker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#kt_dashboard_daterangepicker').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, function cb(start, end) {
                $('#kt_dashboard_daterangepicker span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                var newForm = jQuery('<form>', {
                    'action': "{{route('travel-details-by-date')}}",
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
    });

</script>
@endpush