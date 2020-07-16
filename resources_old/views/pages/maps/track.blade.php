@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{asset('css/maps.css')}}">
<style>
    #kt_header {
        -webkit-box-shadow: 0px #88888869;
        box-shadow: 0px #88888869;
        z-index: 0;
    }
    #kt_demo_panel {
        top: 10.23%;
        width: 25% !important;
    }
</style>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&libraries=geometry"
type="text/javascript"></script>

{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script> --}}
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
@endpush

@section('content')
{{-- Content Goes Here --}}
    {{-- begin:: Content --}}

    {{-- Content Goes Here --}}
    <div id="map" style="height: 89vh;">
        <noscript><p>Indian Auto Company Warning : JavaScript is required to render the Map. Please enable to access live map.</p></noscript>
    </div>
{{-- Content Ends Here --}}
@endsection

@push('scripts')

@php
$locations = [];
@endphp

{{-- {{dd($vehicles)}} --}}
<div id="kt_demo_panel" class="kt-demo-panel px-0 pt-0">
    <div class="kt-demo-panel__head p-3 m-0">
        <h3 class="kt-demo-panel__title maps-search d-none">
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
                    @if(isset($vehicle))
                    {{-- {{dd($vehicle->object->object_type)}} --}}
                        <div class="row">
                            <div class="col-12">
                                @php
                                $vehicleType = strtolower($vehicle->object->object_type);
                                $src = url("/img/objects/car-marker-red.png");
                                $oppositeSrc = url("/img/objects/car-marker-red.png");
                                if($vehicleType == "car") :
                                    $src = url("/img/objects/" . $vehicleType . "-marker-" . ($data->Speed > 0 ? "green" : "red") . ".png");
                                    $oppositeSrc = url("/img/objects/" . $vehicleType . "-marker-" . ($data->Speed <= 0 ? "green" : "red") . ".png");
                                endif;
                                @endphp
                                <div class="d-flex">
                                    <img class="img-responsive" width="70" height="60" src="{{asset($src)}}" alt="{{$vehicle->imei}}" title="{{$vehicle->imei}}">
                                    <div class="autohide_car_image">
                                        <img class="img-responsive" width="70" height="60" src="{{$oppositeSrc}}" />
                                    </div>
                                    <div class="flex-item" title="{{"Vehicle Number - " . $vehicle->object->plate_number ." |  IMEI - " . $vehicle->imei}}">
                                        <h5 class="text-dark">{{$vehicle->object->plate_number}} <small class="text-muted">| {{$vehicle->imei}}</small></h5>
                                        <h5 class="badge badge-{{$data->Speed > 0 ? "success" : "danger"}}">
                                            {{$data->Speed > 0 ? "RUNNING" : "STOP"}}
                                        </h5>
                                    </div>
                                    <div class="align-self-center ml-auto mr-3">
                                        {{-- <i class="fa fa-bell h3"></i> --}}
                                    <a href="{{URL::previous('')}}">
                                        <i class="fa fa-arrow-left h3"></i>
                                    </a>
                                    </div>
                                </div>

                                
                                <div class="d-flex justify-content-between text-center mt-3">
                                        <div class="item-speed card card-body p-1 pt-3 bg-secondary  rounded-0" title="{{$data->Speed}} KM/H">
                                            <h6>CURRENT</h6>
                                            <h6 id="vehicleCurrentSpeed" class="text-{{$data->Speed > 5 ? "success" : "muted"}}">{{$data->Speed}} KM/H</h6>
                                        </div>
                                        <div class="item-speed card card-body p-1 pt-3 bg-secondary  rounded-0" title="{{$avgSpeed}} KM/H">
                                            <h6>AVERAGE</h6>
                                            <h6>{{$avgSpeed}} KM/H</h6>
                                        </div>
                                        <div class="item-speed card card-body p-1 pt-3 bg-secondary  rounded-0" title="{{$maxSpeed}} KM/H">
                                            <h6>MAXIMUM</h6>
                                            <h6>{{$maxSpeed}} KM/H</h6>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-12 w-100">
                                <a class="btn pull-right d-none" href="javascript:;" title="Refresh results.">
                                    <i class="la la-refresh"></i>
                                </a>
                                <div class="item-location px-3">
                                    <h6 class="pt-3">START LOCATION :</h6>
                                    <p class="item-content text-muted small" title="{{$lastLocation}}">{{$lastLocation}}</p>
                                </div>
                                
                                <div class="item-time px-3">
                                    <h6 class="pt-3">STARTED AT :</h6>
                                    <p class="item-content text-muted small" title="{{date("h:i A, d M Y", strtotime($data->created_at))}}">{{date("h:i A, d M Y", strtotime('+330 minutes' , strtotime($data->created_at)))}}</p>
                                </div>

                                <div class="item-time px-3">
                                    <h6 class="pt-3">REACHED AT :</h6>
                                    <p class="item-content text-muted small" id="end_location" title="{{date("h:i A, d M Y", strtotime($data->created_at))}}">{{date("h:i A, d M Y", strtotime('+330 minutes' , strtotime($data->created_at)))}}</p>
                                </div>

                            </div>
                        </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" class="_token" value="{{csrf_token()}}">
<input type="hidden" class="lat" value="{{$data->Lattitude}}">
<input type="hidden" class="long" value="{{$data->Longitude}}">
<input type="hidden" class="vehicle" value="{{$vehicle->object->plate_number}}">
<input type="hidden" class="base_URL" value="{{url('/')}}" />

<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
{{-- <script src="{{asset('js/playback.js')}}"></script> --}}
<script src="{{asset('js/tracking.js')}}"></script>
<script>
$(document).ready(function(){
    trackVehicle({{$vehicle->imei}});

    setTimeout($('.autohide_car_image').hide(), 10000);
});
</script>
@endpush