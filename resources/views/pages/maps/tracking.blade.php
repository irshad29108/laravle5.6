@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{asset('css/maps.css')}}">
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&libraries=geometry"
type="text/javascript"></script>
{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script> --}}
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
@endpush

@section('content')
{{-- Content Goes Here --}}
<div id="map">
    <noscript><p>Indian Auto Company Warning : JavaScript is required to render the Map. Please enable to access live map.</p></noscript>
</div>
<div id="mapLoaderImage" class="d-none">
<img src="{{asset('img/map-loading.gif')}}">
</div>
{{-- Content Ends Here --}}
@endsection

@push('scripts')
{{-- {{dd($locations)}} --}}
<div id="kt_demo_panel" class="kt-demo-panel px-0 pt-0">
    <div class="kt-demo-panel__head p-3 m-0">
        <h3 class="kt-demo-panel__title maps-search">
            <div class="btn-group">
                <a class="btn btn-primary mr-1 rounded" href="{{url('/dashboard')}}">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <div class="kt-input-icon kt-input-icon--left float-right">
                    <input type="text" class="form-control vehicle-search" placeholder="Search vehicle..." id="generalSearch" value="" />
                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                        <span><i class="la la-search"></i></span>
                    </span>
                </div>
            </div>
        </h3>
    </div>
    <div class="kt-quick-panel__content">
        <div class="tab-content">
            <div class="tab-pane fade show kt-scroll active ps ps--active-y" role="tabpanel">
                <div class="kt-notification">
                    @foreach ($vehicles as $iteration => $vehicle)
                    @php
                        $hasLocation = $locations != null ? $locations->where('IMEI', $vehicle->imei)->count() : 0;
                        $vehicleLocation = $hasLocation > 0 ? $locations->where('IMEI', $vehicle->imei)->last() : collect();
                    @endphp
                    @if(isset($vehicleLocation->Speed))
                    @php
                        $vehicleStatus = ($vehicleLocation->Speed > 1 && ((time() - strtotime($vehicleLocation->created_at))/3600 <= 5));
                        $vehicleColor = $vehicleStatus ? 'success' : 'danger';
                        $vehicleActiveStatus = $vehicleStatus ? $vehicle->object->plate_number .' is running' : $vehicle->object->plate_number .' is stopped';
                    @endphp
                    {{-- danger,success and muted --}}
                    {{-- {{route('track', $vehicle->imei)}} --}}
                    <b title="{{$vehicleActiveStatus}}" class="kt-notification__item iacmap-vehicle__item rounded {{$vehicleColor}}">
                        <div class="kt-notification__item-icon mr-3" >
                            <a class="btn btn-light btn-elevate-hover btn-circle btn-icon d-absolute my-2" href="{{route('track', $vehicle->imei)}}" data-toggle="tooltip" style="position:relative;z-index:1000;" title="Track vehicle..">
                                <i class="fa fa-play-circle text-{{$vehicleColor}}"></i>
                            </a>
                        </div>
                        <div style="cursor: pointer;" onclick="mapSetZoom('{{$vehicle->object->plate_number}}')" class="kt-notification__item-details text-dark">
                            <b class="vehicle_number">{{$vehicle->object->plate_number}}</b>
                            <div><small class="badge badge-pill badge-{{$vehicle->object->object_type == 1 ? 'danger' : ($vehicle->object->object_type == 2 ? 'info' : 'success')}}">{{$vehicle->object->object_type}}</small></div>
                            <p class="text-muted">{{date("h:i A, Y-m-d", strtotime('+5 hour +30 minutes', strtotime($vehicleLocation->created_at)))}}</p>
                        </div>
                        <div class="mr-3 float-right">
                            <div class="row pt-2">
                                {{-- danger, success, muted --}}
                                <div class="col text-center text-muted mt-2">
                                    <strong>0</strong>
                                    <p><small> <strong>KM/H</strong> </small></p>
                                </div>
                                @if (0)
                                <div class="col text-success mt-2 text-center">
                                    <i class="fa fa-power-off"></i>
                                    <p><small> <strong>ON</strong> </small></p>
                                </div>
                                @else
                                <div class="col text-danger mt-2 text-center">
                                    <i class="fa fa-power-off"></i>
                                    <p><small> <strong>OFF</strong> </small></p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </b>
                    @else
                        {{-- danger,success and muted --}}
                        {{-- {{route('track', $vehicle->imei)}} --}}
                        @php
                            continue;
                        @endphp
                        <a class="kt-notification__item iacmap-vehicle__item rounded muted"  href="javascript:void(0);" title="No data.." disabled>
                            {{-- <div class="kt-notification__item-icon mb-2">
                                <label class="kt-checkbox kt-checkbox--bold">
                                    <input type="checkbox">
                                    <span class="bg-secondary border-0"></span>
                                    <span class="bg-danger border-0"></span>
                                    <span class="bg-success border-0"></span>
                                </label>
                            </div> --}}
                            <div class="kt-notification__item-details text-dark  ml-3">
                                <b class="vehicle_number">{{$vehicle->object->plate_number}}</b>
                                <div><small class="badge badge-pill badge-{{$vehicle->object->object_type == 1 ? 'danger' : ($vehicle->object->object_type == 2 ? 'info' : 'success')}}">{{$vehicle->object->object_type}}</small></div>
                            <p class="text-muted"></p>
                            </div>
                            <div class="mr-3 float-right">
                                <div class="row pt-2">
                                    {{-- danger, success, muted --}}
                                    <div class="col text-center text-muted mt-2">
                                        <strong>0</strong>
                                        <p><small> <strong>KM/H</strong> </small></p>
                                    </div>
                                    @if (0)
                                    <div class="col text-success mt-2 text-center">
                                        <i class="fa fa-power-off"></i>
                                        <p><small> <strong>ON</strong> </small></p>
                                    </div>
                                    @else
                                    <div class="col text-danger mt-2 text-center">
                                        <i class="fa fa-power-off"></i>
                                        <p><small> <strong>OFF</strong> </small></p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endphp
<input type="hidden" class="lat" value="{{$latArray}}">
<input type="hidden" class="long" value="{{$lngArray}}">
<input type="hidden" class="vehicle" value="{{$vehicleArray}}">
<input type="hidden" class="speed" value="{{$speedArray}}">
<input type="hidden" class="address" value="">
<input type="hidden" class="_token" value="{{csrf_token()}}">
<input type="hidden" class="base_URL" value="{{url('/')}}" />

<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script src="{{asset('js/tracking.js')}}"></script>

<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>
@endpush