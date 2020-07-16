<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Telematics @yield('title')</title>
  <link rel="shortcut icon" type="image/png" src="{{asset('/img/favicon.png')}}" />
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('asset/style.bundle.css') }}" />
  <link rel="stylesheet" href="{{ asset('asset/vendors.bundle.css') }}" />
  <link rel="stylesheet" href="{{ asset('asset/styles.css') }}" />
  @stack('styles')
</head>
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
  {{-- begin:: Page --}}
  @include('partials.navbar-mobile')
  <div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
      {{-- begin:: Aside --}}
      @include('partials.sidebar')
      {{-- end:: Aside --}}
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" >
        @include('partials.navbar')
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
          
          
          @section('content')
          @show
          
          
          @include('partials.footer')
        </div>
      </div>
    </div>
    {{-- end:: Page --}}
    
    
    {{-- begin::Scrolltop --}}
    <div id="kt_scrolltop" class="kt-scrolltop">
      <i class="fa fa-arrow-up" ></i>
    </div>
    {{-- end::Scrolltop --}}
    {{-- </div> --}}
    <!-- begin >>Global Config(global config for global JS sciprts) -->
    <script>
      var KTAppOptions = {
        colors: {
          state: {
            brand: "#2c77f4",
            light: "#ffffff",
            dark: "#282a3c",
            primary: "#5867dd",
            success: "#34bfa3",
            info: "#36a3f7",
            warning: "#ffb822",
            danger: "#fd3995"
          },
          base: {
            label: ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
            shape: ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
          }
        }
      };
    </script>
    
    <!-- end >>Global Config -->
    
    <!--begin >>Global Theme Bundle(used by all pages) -->
    <script
    src="{{asset('assets/assets/vendors/base/vendors.bundle.js')}}"
    type="text/javascript"
    crossorigin
    ></script>
    <script
    src="{{asset('assets/assets/demo/demo3/base/scripts.bundle.js')}}"
    type="text/javascript"
    crossorigin
    ></script>
    <script
    src="{{asset('assets/assets/app/bundle/app.bundle.js')}}"
    crossorigin
    ></script>
    <!--end >>Global Theme Bundle -->
    
    <!--begin >>Page Vendors(used by this page) -->
    <script
    src="{{asset('assets/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}"
    type="text/javascript"
    crossorigin
    ></script>
    <!--end >>Page Vendors -->
    
    @stack('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    @if(Session::has('success'))
    toastr.options = {
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "fadeIn": 300,
      "fadeOut": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000
    }    
    toastr.success("{{ Session::get('success') }}");
    @elseif(Session::has('info'))
    toastr.options = {
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "fadeIn": 300,
      "fadeOut": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000
    }    
    toastr.info("{{ Session::get('info') }}");
    @elseif(Session::has('warning'))
    toastr.options = {
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "fadeIn": 300,
      "fadeOut": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000
    }    
    toastr.warning("{{ Session::get('warning') }}");
    @elseif(Session::has('error'))
    toastr.options = {
      "debug": false,
      "positionClass": "toast-bottom-right",
      "onclick": null,
      "fadeIn": 300,
      "fadeOut": 1000,
      "timeOut": 5000,
      "extendedTimeOut": 1000
    }    
    toastr.error("{{ Session::get('error') }}");
    @endif
  </script>
  
<script src="{{asset('rtl/components/extended/assets/app/custom/general/components/extended/blockui.js')}}"></script>
<script>
  $('.kt_blockui').click(() => {
    KTApp.blockPage({overlayColor:"#000000",type:"v2",state:"success",message:"Please wait..."});
  });
</script>
  </body>
  </html>
  