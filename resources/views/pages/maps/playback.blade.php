@extends('layouts.layout-users')

@push('styles')
<link rel="stylesheet" href="{{asset('css/maps.css')}}">
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFqrV7p6S7j-eORKH7RHeOTEwFSZeuImc&libraries=geometry"
type="text/javascript"></script>

{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script> --}}
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
@endpush

@section('content')
{{-- Content Goes Here --}}
{{-- begin:: Content --}}
<div id="tools mt-5" style="margin-left: 20rem;margin-top: 1rem;">
    start:
    <input class="p-2" type="text" name="start" id="start" value="union square, NY" />
    end:
    <input class="p-2" type="text" name="end" id="end" value="times square, NY" />
    <button id="routeSubmit">SUBMIT</button>
  </div>
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
                    $vehicleLocation = $vehicle->locations->last();
                    
                    if($vehicleLocation != null) {
                        $locations['lat'][] = $vehicleLocation->Lattitude;
                        $locations['long'][] = $vehicleLocation->Longitude;
                    }
                    @endphp
                    @if(1)
                    <a href="javsscript:;" onclick="changeMapCenter({{$iteration}})" class="kt-notification__item iacmap-vehicle__item rounded {{(isset($vehicleLocation) ? ($vehicleLocation->Speed == 0 ? 'danger' : 'success') : 'muted')}}">
                        <div class="kt-notification__item-icon mb-2">
                            <label class="kt-checkbox kt-checkbox--bold">
                                <input type="checkbox">
                                <span class="bg-{{(isset($vehicleLocation) ? ($vehicleLocation->Speed == 0 ? 'danger' : 'success') : 'secondary')}} border-0"></span>
                            </label>
                        </div>
                        <div class="kt-notification__item-details text-dark">
                            <b>{{$vehicle->imei}}</b>
                            <small class="text-warning">{{$vehicle->name}}</small>
                            <p class="text-muted">10-05-2019 14:50:12</p>
                        </div>
                        <div class="mr-3 float-right">
                            <div class="row pt-2">
                                <div class="col text-center text-{{(isset($vehicleLocation) ? ($vehicleLocation->Speed == 0 ? 'danger' : 'success') : 'muted')}} mt-2">
                                    <strong>{{isset($vehicleLocation)  ? $vehicleLocation->Speed : '0'}}</strong>
                                    <p><small> <strong>KM/H</strong> </small></p>
                                </div>
                                @if (isset($vehicleLocation) && $vehicleLocation->IgnitionStatus != 0)
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

<script src="{{asset('assets/assets/app/custom/general/dashboard.js')}}"></script>
<script src="{{asset('js/playback.js')}}"></script>
@endpush