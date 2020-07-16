@extends('layouts.layout-users')

@push('styles')
<style>
    .kt-datatable__body::-webkit-scrollbar {
        width: 5px;
    }
</style>
@endpush

@section('content')
{{-- Content Goes Here --}}
{{-- begin:: Content Head --}}
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <span class="kt-portlet__head-icon">
                <i class="kt-font-brand flaticon2-avatar h3 px-3"></i>
            </span>
            <h3 class="kt-subheader__title text-uppercase">{{$page_name}}</h3>
            <span class="kt-subheader__separator kt-subheader__separator--v"></span>
            <div class="kt-subheader__group" id="kt_subheader_search">
                <span class="kt-subheader__desc" id="kt_subheader_total">
                    {{$userMaster->count()}} Total
                </span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    &nbsp; <i class="flaticon2-plus"></i> ADD NEW &nbsp;
                </button>
                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(113px, 35px, 0px);">
                    <ul class="kt-nav">
                        @if(Auth::user()->master->role_id < App\Models\Role::ADMIN)
                        <li class="kt-nav__item">
                            <a href="../{{App\Models\Role::ADMIN}}/add-user" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon2-user"></i>
                                <span class="kt-nav__link-text">ADMIN</span>
                            </a>
                        </li>                            
                        @endif
                        @if(Auth::user()->master->role_id < App\Models\Role::RESELLER)
                        <li class="kt-nav__item">
                            <a href="../{{App\Models\Role::RESELLER}}/add-user" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon-users-1"></i>
                                <span class="kt-nav__link-text">RE-SELLER</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->master->role_id < App\Models\Role::COMPANY)
                        <li class="kt-nav__item">
                            <a href="../{{App\Models\Role::COMPANY}}/add-user" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon-presentation"></i>
                                <span class="kt-nav__link-text">COMPANY</span>
                            </a>
                        </li>
                        @endif
						@if(Auth::user()->master->role_id < App\Models\Role::USER)
                        <li class="kt-nav__item">
                            <a href="../{{App\Models\Role::USER}}/add-user" class="kt-nav__link">
                                <i class="kt-nav__link-icon flaticon-presentation"></i>
                                <span class="kt-nav__link-text">USER</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>


        </div>
    </div>
    
    {{-- Content Goes Here --}}
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid p-3">
        <div class="kt-portlet kt-portlet--mobile">
            {{--begin: Page Name --}}
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title text-uppercase">
                        {{$page_name}} List
                    </h3>
                </div>
            </div>
            {{--end: Search Form --}}
            <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--subtable kt-datatable--loaded">
                <table class="table table-striped table-bordered table-hover table-checkable" id="kt_table_2">
                    <thead>
                        <tr>
                            <th></th>
                            <th>S. No.</th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>City</th>
                            <th>Contact Person</th>
                            <th>Mobile Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userMaster as $i => $user)
                        @php
                        $childs = (Request::segment(1) == '2' ? $user->resellers() : (Request::segment(1) == 3 ? $user->companies() : (Request::segment(1) == 4 ? $user->branches() : collect())));
                        // dd($user);
                        @endphp
                        <tr>
                            <td class="kt-datatable__cell--center kt-datatable__cell" data-field="RecordID" style="vertical-align:middle">
                                @if ($childs->count() > 0)
                                <a class="btn btn-block" href="javaScript:void(0)" onclick="callChildRow({{$i}})" data-toggle="tooltip" data-html="true" data-value="{{$i}}" title="Expand" style="width: 30px;">
                                    <i style="width: 30px;" class="fa fa-caret-right">
                                    </i>
                                </a>
                                @endif
                            </td>
                            <td style="vertical-align:middle">{{$loop->iteration}}</td>
                            <td title="{{$user->name}}">
                                <div class="kt-user-card-v2">
                                    <div class="kt-user-card-v2__pic">
                                        <div class="kt-badge kt-badge--xl kt-badge--primary">
                                            {{-- <span>{{substr($user->Name, 0, 2)}}</span> --}}
                                            <img src="{{asset($user->photo != '' ? decrypt($user->photo) : '/img/user_image.jpg')}}" alt="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="kt-user-card-v2__details">
                                        <span class="kt-user-card-v2__name">{{$user->name}}</span>
                                        <a href="#" class="kt-user-card-v2__email kt-link">{{$user->user_name}}</a>
                                    </div>
                                </div>
                            </td>
                            <td title="{{$user->user_name}}">{{isset($user->user_name) && ($user->user_name != "") ? $user->user_name : "#NA"}}</td>
                            <td title="{{$user->password}}">{{isset($user->password) && ($user->password != "") ? $user->password : "#NA"}}</td>
                            <td title="{{isset($user->cityMaster->name) ? $user->cityMaster->name : "#NA"}}">{{isset($user->cityMaster->name) ? $user->cityMaster->name : "#NA"}}</td>
                            <td title="{{$user->contact_person}}">{{isset($user->contact_person) && ($user->contact_person != "") ? $user->contact_person : "#NA"}}</td>
                            <td title="{{$user->mobile_number}}">{{isset($user->mobile_number) && ($user->mobile_number != "") ? $user->mobile_number : "#NA"}}</td>
                            <td nowrap>
                                <span class="dropdown">
                                    <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right m-0" x-placement="bottom-end">
                                        <a class="dropdown-item" href="#"><i class="la la-edit text-success"></i> EDIT </a>
                                        <a class="dropdown-item" href="{{route('user.settings', [Request::segment(1), encrypt($user->id)])}}"><i class="la la-gear text-primary"></i> SETTINGS</a>
                                        @if(Request::segment(1) == 4)
                                            <a class="dropdown-item" href="{{route('company.add.user', [Request::segment(1), encrypt($user->id)])}}"><i class="la la-user-plus text-danger"></i> CREATE BRANCH </a>
                                        @endif
                                        {{-- <a class="dropdown-item" href="#"><i class="la la-trash text-danger"></i> Delete</a> --}}
                                    </div>
                                </span>
                            </td>
                        </tr>
                        @if ($childs->count() > 0)
                        @php
                        $childName = App\Models\Role::where('id', Request::segment(1) + 1)->first()->name;
                        // dd($childs);
                        $childDetails = $childs->get()->where('parent_id', $user->id);
                        @endphp
                        <tr class="table table-striped table-bordered table-hover table-checkable shadow-lg" data-table-row="{{$i}}" style="display: none;">
                            <td class="kt-datatable__subtable bg-secondary" colspan="9">
                                <div id="child_data_local_1" class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--scroll kt-datatable--loaded" style="">
                                    <div class="kt-portlet__head kt-portlet__head--lg bg-warning shadow">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title text-capitlize text-white">
                                                {{-- {{$user->name}}  --}}
                                                {{substr($childName, -1) == 'y' ? substr($childName, 0, -1) . 'ies' : (substr($childName, -1) == 'h' ? substr($childName, 0, -1) . 'es' : $childName . 's')}}
                                            </h3>
                                        </div>
                                    </div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="border border-dark bg-secondary">
                                                    <span>S. No.</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>{{$childName}} Name</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>User Name</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Password</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Date</span>
                                                </th>
                                                <th class="border border-dark bg-secondary">
                                                    <span>Action</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="kt-datatable__body" style="overflow-y:scroll; max-height: 300px; width:100%">
                                            @php
                                            $iteration = 1;
                                            @endphp
                                            @forelse ($childDetails as $item)
                                            <tr class="kt-datatable__row bg-white">
                                                <td title="{{$iteration++}}">
                                                    <span>{{$iteration++}}</span>
                                                </td>
                                                <td title="{{$item->name}}">
                                                    <span>{{$item->name}}</span>
                                                </td>
                                                <td title="{{$item->user_name}}">
                                                    <span>{{$item->user_name}}</span>
                                                </td>
                                                <td title="{{$item->password}}">
                                                    <span>{{$item->password}}</span>
                                                </td>
                                                <td title="{{date('d, M Y h:i A', strtotime($item->created_at))}}">
                                                    <span>{{date('d, M Y h:i A', strtotime($item->created_at))}}</span>
                                                </td>
                                                <td nowrap>
                                                    <span class="dropdown">
                                                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="la la-ellipsis-h"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right m-0" x-placement="bottom-end">
                                                            <a class="dropdown-item" href="#">
                                                                <i class="la la-edit text-success"></i>
                                                                EDIT
                                                            </a>
                                                            <a class="dropdown-item" href="{{route('user.settings', [Request::segment(1), encrypt($item->id)])}}">
                                                                <i class="la la-gear text-primary"></i>
                                                                SETTINGS
                                                            </a>
                                                            <a class="dropdown-item text-uppercase" href="{{route('add-user', [(Request::segment(1) + 2), $item->id])}}">
                                                                <i class="la la-user-plus text-danger"></i>
                                                                CREATE {{App\Models\Role::where('id', (Request::segment(1) + 2))->first()->name}}
                                                            </a>
                                                            {{-- <a class="dropdown-item" href="#"><i class="la la-trash text-danger"></i> Delete</a> --}}
                                                        </div>
                                                    </span>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr> No Records Found </tr>
                                            @endforelse
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
</div>
{{-- end:: Content --}}
{{-- Content Ends Here --}}
@endsection

@push('scripts')
<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script>
    function callChildRow(row) {
        var table = $('#kt_table_2');
        if (table.find('tr:nth-child('+(row + 1)+') td:eq(0) a i').hasClass("fa-caret-right")) {
            table.find('tr:nth-child('+(row + 1)+') td:eq(0) a i.fa-caret-right').removeClass('fa-caret-right').addClass('fa-caret-down');
        } else {
            table.find('tr:nth-child('+(row + 1)+') td:eq(0) a i.fa-caret-down').removeClass('fa-caret-down').addClass('fa-caret-right');
        }
        const el = $('tr[data-table-row="'+row+'"]');
        if(el.css('display') === 'none') {
            el.css('display', 'table-row');
        } else {
            el.css('display', 'none');
        }
    }
</script>
@endpush
