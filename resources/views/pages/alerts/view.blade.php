@extends('layouts.layout-users')

@push('styles')
@endpush

@section('content')
{{-- Content Goes Here --}}

<div class="kt-portlet kt-portlet--mobile" style="margin-top: -4rem;">
    <div class="kt-portlet__head kt-portlet__head--lg">
        <div class="kt-portlet__head-label">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-speaker"></i>
            </span>
            <h3 class="kt-portlet__head-title">
                ALERTS
            </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <div class="kt-portlet__head-wrapper">
                &nbsp;
                <div class="dropdown dropdown-inline">
                    <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon2-plus"></i> Add New  	
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="kt-nav">
                            <li class="kt-nav__section kt-nav__section--first">
                                <span class="kt-nav__section-text">Alert:</span>
                            </li>
                            <li class="kt-nav__separator kt-nav__separator--fit">
                            </li>
                            <li class="kt-nav__item">
                                <a href="{{route('alert.create')}}" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-plus-1"></i>
                                    <span class="kt-nav__link-text">CREATE NEW</span>
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
                    <th>Name</th>
                    <th>Vehicle</th>
                    <th>Alert Type</th>
                    <th>View</th>
                    <th>Active</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($alerts as $alert)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$alert->alert_name}}</td>
                    <td>{{$alert->object->name}}</td>
                    <td>
                        <span class="kt-badge kt-badge--{{$alert->alert_type == 1 ? 'danger' : ($alert->alert_type == 2 ? 'info' : 'success')}} kt-badge--inline kt-badge--pill">{{$alert->type->name}}</span>
                    </td>
                    <td>
                        <span>
                            <a title="View" class="btn btn-sm btn-clean btn-icon btn-icon-md pull-left" href="javascript:;" data-toggle="modal" data-target="#viewAlert-{{$alert->id}}">
                                <i class="la la-eye"></i>
                            </a>
                            <div class="modal animated pulse" id="viewAlert-{{$alert->id}}" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title d-flex align-items-center text-uppercase" id="exampleModalLabel">
                                                {{$alert->alert_name}} &nbsp;|
                                                &nbsp;<small>{{$alert->object->name}}</small>
                                            </h5>
                                            <div class="pull-right d-flex align-items-center">
                                                STATUS &nbsp;|&nbsp;&nbsp;
                                                {!!$alert->enabled == 0 ? '<span class="kt-badge kt-badge--dark   kt-badge--inline kt-badge--pill">DISABLED</span>' : '<span class="kt-badge kt-badge--success   kt-badge--inline kt-badge--pill">ENABLED</span>'!!}
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid p-3">
                                                <table class="table col-12">
                                                    {{-- CONTENT GOES HERE --}}
                                                    
                                                    <tr>
                                                        <td class="bg-secondary">Alert Name</td>
                                                        <td class="small">{!! $alert->alert_name !!}</td>
                                                        <td class="border-0">&nbsp;</td>
                                                        <td class="bg-secondary">Vehicle</td>
                                                        <td class="small">{!! $alert->object->name !!}</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td class="bg-secondary">Company</td>
                                                        <td class="small">{!! $alert->company->name !!}</td>
                                                        <td class="border-0">&nbsp;</td>
                                                        <td class="bg-secondary">Branch</td>
                                                        <td class="small">{!! $alert->branch->name !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="bg-secondary">STATUS</td>
                                                        <td class="small">{!! $alert->enabled == '' !!}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="p-3" colspan="5" align="center">ALERT DETAILS</td>
                                                    </tr>
                                                    @if ($alert->alert_type == App\Models\AlertTypeMaster::POWER) {{-- POWER --}}
                                                    <tr>
                                                        <td class="bg-secondary">Alert Message</td>
                                                        <td class="small">{!! $alert->power_message !!}</td>
                                                        <td class="border-0">&nbsp;</td>
                                                        <td class="bg-secondary">Alert Methods</td>
                                                        @php
                                                        $alertsCollectionPower = App\Models\AlertTypeMaster::whereIn('id', explode(',', $alert->power_alert_method))->pluck('name')->toArray();
                                                        $alertsTypeCollection = explode(',', $alert->power_alert_method);
                                                        @endphp
                                                        <td class="small">{!! implode(', ', $alertsCollectionPower) !!}</td>
                                                    </tr>
                                                    @if(count($alertsTypeCollection) > 0)
                                                    @foreach ($alertsTypeCollection as $alertItem)
                                                    @if ($alertItem == 1)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->power_email_addresses!!}</td>
                                                    </tr>
                                                    @elseif ($alertItem == 2)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->power_mobile_number!!}</td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td class="bg-secondary">Alert Notification</td>
                                                        <td class="small">{!!$alert->power_notification_sound!!}</td>                                                                    
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    @elseif ($alert->alert_type == App\Models\AlertTypeMaster::SOS) {{-- SOS --}}
                                                    <tr>
                                                        <td class="bg-secondary">Alert Message</td>
                                                        <td class="small">{!! $alert->sos_message !!}</td>
                                                        <td class="border-0">&nbsp;</td>
                                                        <td class="bg-secondary">Alert Methods</td>
                                                        @php
                                                        $alertsCollectionSOS = App\Models\AlertTypeMaster::whereIn('id', explode(',', $alert->sos_alert_method))->pluck('name')->toArray();
                                                        $alertsTypeCollection = explode(',', $alert->sos_alert_method);
                                                        
                                                        @endphp
                                                        <td class="small">{!! implode(', ', $alertsCollectionSOS) !!}</td>
                                                    </tr>
                                                    @if(count($alertsTypeCollection) > 0)
                                                    @foreach ($alertsTypeCollection as $alertItem)
                                                    @if ($alertItem == 1)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->sos_email_addresses!!}</td>
                                                    </tr>
                                                    @elseif ($alertItem == 2)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->sos_mobile_numbers!!}</td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td class="bg-secondary">Alert Notification</td>
                                                        <td class="small">{!!$alert->sos_notification_sound!!}</td>                                                                
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    @elseif ($alert->alert_type == App\Models\AlertTypeMaster::IGNITION) {{-- IGNITION --}}
                                                    <tr>
                                                        <td class="bg-secondary">Alert Message</td>
                                                        <td class="small">{!! $alert->ign_message !!}</td>
                                                        <td class="border-0">&nbsp;</td>
                                                        <td class="bg-secondary">Alert Methods</td>
                                                        @php
                                                        $alertsCollectionIGN = App\Models\AlertTypeMaster::whereIn('id', explode(',', $alert->ign_alert_method))->pluck('name')->toArray();
                                                        $alertsTypeCollection = explode(',', $alert->ign_alert_method);
                                                        
                                                        @endphp
                                                        <td class="small">{!! implode(', ', $alertsCollectionIGN) !!}</td>
                                                    </tr>
                                                    @if(count($alertsTypeCollection) > 0)
                                                    @foreach ($alertsTypeCollection as $alertItem)
                                                    @if ($alertItem == 1)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->ign_email_addresses!!}</td>
                                                    </tr>
                                                    @elseif ($alertItem == 2)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->ign_mobile_numbers!!}</td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td class="bg-secondary">Alert Notification</td>
                                                        <td class="small">{!!$alert->ign_notification_sound!!}</td>                                                                
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    @elseif ($alert->alert_type == App\Models\AlertTypeMaster::OVERSPEED) {{-- OVERSPEED --}}
                                                    <tr>
                                                        <td class="bg-secondary">Alert Message</td>
                                                        <td class="small">{!! $alert->os_message !!}</td>
                                                        <td class="border-0">&nbsp;</td>
                                                        <td class="bg-secondary">Alert Methods</td>
                                                        @php
                                                        $alertsCollectionOS = App\Models\AlertTypeMaster::whereIn('id', explode(',', $alert->os_alert_method))->pluck('name')->toArray();
                                                        $alertsTypeCollection = explode(',', $alert->os_alert_method);
                                                        
                                                        @endphp
                                                        <td class="small">{!! implode(', ', $alertsCollectionOS) !!}</td>
                                                    </tr>
                                                    @if(count($alertsTypeCollection) > 0)
                                                    @foreach ($alertsTypeCollection as $alertItem)
                                                    @if ($alertItem == 1)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->os_email_addresses!!}</td>
                                                    </tr>
                                                    @elseif ($alertItem == 2)
                                                    <tr>    
                                                        <td class="bg-secondary">Alert Emails</td>
                                                        <td class="small">{!!$alert->os_mobile_numbers!!}</td>
                                                    </tr>
                                                    @else
                                                    <tr>
                                                        <td class="bg-secondary">Alert Notification</td>
                                                        <td class="small">{!!$alert->os_notification_sound!!}</td>                                                                
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    @endif
                                                    {{-- CONTENT ENDS HERE --}}
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">
                                                <i class="la la-close"></i> CLOSE
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <form class="d-inline-block" action="{{route('alert.delete')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{$alert->id}}">
                                <button type="submit" title="Delete" class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                    <i class="la la-trash"></i>
                                </button>
                            </form> --}}
                        </span>
                    </td>
                    <input type="hidden" id="alertID" value="{{$alert->id}}">
                    @php
                        $alertStatus = ( $alert->enabled == 1 ? 'checked="checked"' : "");
                    @endphp
                    <td>
                        <span class="kt-switch kt-switch--default">
                            <label class=" p-0 m-0">
                                <input type="checkbox" {{$alertStatus}} value="1" onchange="changeAlertStatus($(this).val())">
                                <span class="w-auto p-0 m-0" onclick="($(this).parent().parent().find('input').val() == 1 ? $(this).parent().parent().find('input').val('0') : $(this).parent().parent().find('input').val('1'))"></span>
                            </label>
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
                {{$alerts->links()}}
            </div>
        </div>
    </div>
</div>
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script>
    function changeAlertStatus(alertStatus) {
        $.ajax({
            type: "POST",
            url: "{{route('alert.change.status')}}",
            data: {
                "_token": "{!!csrf_token()!!}",
                "alert_id": $('#alertID').val(),
                "status" : alertStatus
            },
            beforeSend: function() {
                KTApp.blockPage({overlayColor:"#000000",type:"v2",state:"success",message:"Please wait..."});
            },
            complete: function(){
                window.location.reload();
            }
        });
    }
</script>
@endpush