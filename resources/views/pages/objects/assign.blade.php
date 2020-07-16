@extends('layouts.layout-users')

@push('styles')
@endpush

@section('content')
{{-- Content Goes Here --}}

<div class="kt-portlet kt-portlet--mobile" style="margin-top: -4rem;">
    <form method="POST" action="{{route('objects.assign')}}">
    @csrf
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand fa fa-car"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                ASSIGN VEHICLES
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                <a href="{{route('objects.view')}}" class="btn btn-clean btn-icon-sm">
                    <i class="la la-long-arrow-left"></i>
                    Back
                </a>
                &nbsp;
                <div class="dropdown dropdown-inline">
                @if(Auth::user()->master->type->id == App\Models\Role::COMPANY || Auth::user()->master->type->id == App\Models\Role::SUPER_ADMIN)
                <button type="submit" class="btn btn-success btn-icon-sm" href="{{route('object.bulk.view')}}">
                    <i class="flaticon-share"></i> Bulk Assign
                </button>
                @endif
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__section kt-nav__section--first">
                                <span class="kt-nav__section-text">Objects&nbsp;&nbsp;:</span>
                            </li>
                            <li class="kt-nav__separator kt-nav__separator--fit">
                            </li>
                            <li class="kt-nav__item">
                                <a href="{{route('object.create')}}" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-plus-1"></i>
                                    <span class="kt-nav__link-text">ADD NEW</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body">
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-checkable" id="kt_table_1">
            <thead>
                <tr>
                    <th>Record ID</th>
                    <th>Assigned To</th>
                    <th>IMEI</th>
                    <th>Vehicle No.</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($objects as $object)
                <tr>
                    <td class="text-center text-success kt-datatable__cell--center kt-datatable__cell kt-datatable__cell--check" data-field="RecordID">
                        <span style="width: 20px;">
                        <label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" name="vehicles[]" value="{{$object->id}}">
                        &nbsp;<span></span>
                    </label>
                    </span>
                    </td>
                    <td>{{$object->branch->name}}</td>
                    <td>{{$object->device_master->imei}}</td>
                    <td>{{$object->plate_number}}</td>
                    @php
                        $vehicleIcon =
                        (strtolower($object->object_type) == 'car' ? "fa fa-car-side" :
                        (strtolower($object->object_type) == "truck" ? "fa fa-truck-moving" :
                        (strtolower($object->object_type) == "tempo" ? "flaticon2-lorry" :
                        (strtolower($object->object_type) == "bike" ? "fa fa-motorcycle" : "fa fa-hdd"
                        ))));
                    @endphp
                    <td>
                        @php
                            $vehicleTypePillColor = strtolower($object->object_type) == "car" ? 'success' : ($object->object_type == "Default" ? 'dark' : 'dark');
                        @endphp
                        <span class="kt-badge kt-badge--{{$vehicleTypePillColor}} kt-badge--inline kt-badge--pill">
                            <i class="{!!$vehicleIcon!!}"></i> &nbsp;&nbsp;{{strtoupper($object->object_type)}}
                        </span>
                    </td>
                    <td class="text-center">
                        <span>
                        <a title="View" class="btn btn-sm btn-clean btn-icon btn-icon-md" href="javascript:;" data-toggle="modal" data-target="#viewAlert-{{$object->id}}">
                            <i class="la la-eye"></i>
                        </a>
                            <!-- Modal -->
                            <div class="modal animated pulse" id="viewAlert-{{$object->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog  modal-dialog-centered modal-xl">
                            <!-- Modal content-->
                            <div class="modal-content">
                                {{-- MODAL BODY STARTS --}}
                                    <div class="kt-portlet kt-portlet--tabs mb-0">
                                        <div class="kt-portlet__head">
                                            <div class="kt-portlet__head-label">
                                                <h3 class="kt-portlet__head-title">
                                                    OBJECT DETAILS |&nbsp;&nbsp;
                                                    <span title="{{strtolower($object->object_type)}}" class="px-3 py-1 text-white bg-success rounded-circle">
                                                        <i class="{{$vehicleIcon}}"></i>
                                                    </span>
                                                    <small>{{$object->plate_number}}</small>
                                                </h3>
                                            </div>
                                            <div class="kt-portlet__head-toolbar">
                                                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right" role="tablist">
                                                    <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#iac_vehicles_general_setup_{{$object->id}}" role="tab" aria-selected="true">
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
                                                        <a class="nav-link" data-toggle="tab" href="#iac_vehicles_device_setup_{{$object->id}}" role="tab" aria-selected="false">
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
                                                        <a class="nav-link" data-toggle="tab" href="#iac_vehicles_sensors_{{$object->id}}" role="tab" aria-selected="false">
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
                                                        <a class="nav-link" data-toggle="tab" href="#iac_vehicles_reminders_{{$object->id}}" role="tab" aria-selected="false">
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
                                        <div class="kt-portlet__body text-left">
                                            <div class="tab-content container-fluid">
                                                <div class="tab-pane active row justify-content-around" id="iac_vehicles_general_setup_{{$object->id}}" role="tabpanel">
                                                    {{-- GENERAL SETUP DETAILS --}}
                                                    <table class="table col-12">
                                                        <tr>
                                                            <td class="bg-secondary">Reseller</td>
                                                            <td class="small">{{$object->reseller->name}}</td>
                                                            <td class="bg-white border-0"></td>
                                                            <td class="bg-secondary">Company</td>
                                                            <td class="small">{{$object->company->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg-secondary">Branch</td>
                                                            <td class="small">{{$object->branch->name}}</td>
                                                            <td class="bg-white border-0"></td>
                                                            <td class="bg-secondary">Vehicle Name</td>
                                                            <td class="small">{{$object->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg-secondary">Device Type</td>
                                                            <td class="small">#NA</td>
                                                            <td class="bg-white border-0"></td>
                                                            <td class="bg-secondary">IMEI</td>
                                                            <td class="small">{{$object->device_master->imei}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg-secondary">Server Address</td>
                                                            <td class="small">#NA</td>
                                                            <td class="bg-white border-0"></td>
                                                            <td class="bg-secondary">SIM Number</td>
                                                            <td class="small">{{$object->device_master->sim_number}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg-secondary">Device Timezone</td>
                                                            <td class="small">{{$object->timezone->type}}</td>
                                                            <td class="bg-white border-0"></td>
                                                            <td class="bg-secondary">Distance Counter</td>
                                                            <td class="small">#NA</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg-secondary">Unit Of Distance</td>
                                                            <td class="small">#NA</td>
                                                            <td class="bg-white border-0"></td>
                                                            <td class="bg-secondary">Speed Detection</td>
                                                            <td class="small">#NA</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg-secondary">Odometer</td>
                                                            <td class="small">{{$object->odometer}}</td>
                                                            <td class="bg-white border-0"></td>
                                                            <td class="bg-secondary">LBS Detection Radius</td>
                                                            <td class="small">#NA</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="tab-pane" id="iac_vehicles_device_setup_{{$object->id}}" role="tabpanel">

                                                <table class="table col-12">
                                                    <tr>
                                                        <td class="bg-secondary">Plate Number</td>
                                                        <td class="small">{{$object->plate_number}}</td>
                                                        <td class="bg-white border-0"></td>
                                                        <td class="bg-secondary">Vehicle Type</td>
                                                        <td class="small">
                                                            <span title="{{strtolower($object->object_type)}}" class="px-3 py-1 text-white bg-success rounded-circle">
                                                                <i class="{{$vehicleIcon}}"></i>&nbsp;&nbsp;{{$object->object_type}}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-secondary">Manufacture Date</td>
                                                        <td class="small">{{date("d, M Y", strtotime($object->manufacture_date))}}</td>
                                                        <td class="bg-white border-0"></td>
                                                        <td class="bg-secondary">Purchage Date</td>
                                                        <td class="small">{{date("d, M Y", strtotime($object->purchage_date))}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-secondary">Installation Date</td>
                                                        <td class="small">{{date("d, M Y", strtotime($object->installation_date))}}</td>
                                                        <td class="bg-white border-0"></td>
                                                        <td class="bg-secondary">Registration Number</td>
                                                        <td class="small">{{$object->device_master->registration_number}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-secondary">Mileage based on distance</td>
                                                        <td class="small">#NA</td>
                                                        <td class="bg-white border-0"></td>
                                                        <td class="bg-secondary">Mileage based on duration(Minutes)</td>
                                                        <td class="small">#NA</td>
                                                    </tr>
                                                </table>
                                                </div>
                                                <div class="tab-pane" id="iac_vehicles_sensors_{{$object->id}}" role="tabpanel">
                                                    Not available.
                                                </div>

                                                <div class="tab-pane" id="iac_vehicles_reminders_{{$object->id}}" role="tabpanel">
                                                    Not available.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- MODAL BODY ENDS --}}

                                <div class="modal-footer">
                                    <a title="EDIT VEHICLE" class="btn btn-info rounded-0" href="{{route('object.edit', $object->id)}}">
                                        <i class="fa fa-edit"></i> EDIT
                                    </a>

                                    <button type="button" class="btn" data-dismiss="modal">
                                        <i class="la la-close"></i> CLOSE
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <a title="Edit" class="btn btn-sm btn-clean btn-icon btn-icon-md" href="{{route('object.edit', $object->id)}}">
                            <i class="la la-edit"></i>
                        </a>
                        <a title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                            <i class="la la-trash"></i>
                        </a>
                        </span>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="8"> No Records Found! </td>
                </tr>
                @endforelse
            </tbody>

        </table>
        <!--end: Datatable -->
    </div>
</form>
</div>
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
@endpush
