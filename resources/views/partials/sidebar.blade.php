{{-- begin:: Aside --}}
<button class="kt-aside-close " id="kt_aside_close_btn">
  <i class="la la-close" ></i>
</button>
<div
class="kt-aside kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
id="kt_aside"
>
{{-- begin:: Aside --}}
<div class="kt-aside__brand kt-grid__item" id="kt_aside_brand" style="background-color: #3d073c" >
  <div class="kt-aside__brand-logo">
    <a href="{{route('dashboard')}}">
      <img alt="Logo" src="{{asset('assets/media/logos/logo-4.png')}}" width="100%" />
    </a>
  </div>
</div>
{{-- end:: Aside --}} {{-- begin:: Aside Menu --}}
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper" >
  <div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0" >
    <ul class="kt-menu__nav ">
      <li
      class="kt-menu__item  kt-menu__item--active"
      aria-haspopup="true"
      >
      <a href="{{url('/dashboard')}}" class="kt-menu__link kt_blockui">
        <i class="kt-menu__link-icon flaticon2-analytics-2" ></i>
        <span class="kt-menu__link-text">Dashboard</span>
      </a>
    </li>
    <li
    class="kt-menu__item  kt-menu__item--submenu"
    aria-haspopup="true"
    data-ktmenu-submenu-toggle="hover"
    >
    <a href="{{url('maps')}}" class="kt-menu__link kt_blockui">
      <i class="kt-menu__link-icon flaticon2-lorry" ></i>
      <span class="kt-menu__link-text">Tracking</span>
    </a>
  </li>
  <li class="kt-menu__item d-none" aria-haspopup="true">
    <a href="" class="kt-menu__link kt_blockui">
      <i class="kt-menu__link-icon flaticon2-bell-alarm-symbol" ></i>
      <span class="kt-menu__link-text">Notifications</span>
    </a>
  </li>
  <li
  class="kt-menu__item kt-menu__item--submenu"
  aria-haspopup="true"
  data-ktmenu-submenu-toggle="hover"
  >
  <a
  href="javascript:;"
  class="kt-menu__link kt-menu__toggle"
  >
  <i class="kt-menu__link-icon far fa-newspaper" ></i>
  <span class="kt-menu__link-text">Reports</span>
</a>
<div class="kt-menu__submenu ">
  <span class="kt-menu__arrow" ></span>
  <ul class="kt-menu__subnav">
    <li
    class="kt-menu__item kt-menu__item--parent"
    aria-haspopup="true"
    >
    <span class="kt-menu__link">
      <span class="kt-menu__link-text">
        Travel Summary
      </span>
    </span>
  </li>
  <li class="kt-menu__item" aria-haspopup="true">
    <a href="{{route('report.travel')}}" class="kt-menu__link kt_blockui">
      <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
        <span></span>
      </i>
      <span class="kt-menu__link-text">
        Travel Details
      </span>
    </a>
  </li>
  <li class="kt-menu__item d-none" aria-haspopup="true">
    <a href="{{route('travel-history')}}" class="kt-menu__link kt_blockui">
      <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
        <span></span>
      </i>
      <span class="kt-menu__link-text">
        Travel History
      </span>
    </a>
  </li>
  <li class="kt-menu__item" aria-haspopup="true">
    <a href="{{route('trip-report')}}" class="kt-menu__link kt_blockui">
      <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
        <span></span>
      </i>
      <span class="kt-menu__link-text">
        Trip Details
      </span>
    </a>
  </li>
</ul>
</div>
</li>
<li
class="kt-menu__item  kt-menu__item--submenu d-none"
aria-haspopup="true"
data-ktmenu-submenu-toggle="hover"
>
<a
href="javascript:;"
class="kt-menu__link kt-menu__toggle"
>
<i class="kt-menu__link-icon flaticon2-analytics-2" ></i>
<span class="kt-menu__link-text">Advanced</span>
</a>
<div class="kt-menu__submenu ">
  <span class="kt-menu__arrow"></span>
  <ul class="kt-menu__subnav">
    <li
    class="kt-menu__item  kt-menu__item--parent"
    aria-haspopup="true"
    ></li>
    <li class="kt-menu__item " aria-haspopup="true">
      <a href="" class="kt-menu__link kt_blockui">
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
          <span></span>
        </i>
        <span class="kt-menu__link-text">Route Path</span>
      </a>
    </li>
    <li class="kt-menu__item " aria-haspopup="true">
      <a href="" class="kt-menu__link kt_blockui">
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
          <span></span>
        </i>
        <span class="kt-menu__link-text">
          Route Path Allocation
        </span>
      </a>
    </li>
    <li class="kt-menu__item " aria-haspopup="true">
      <a href="" class="kt-menu__link kt_blockui">
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
          <span></span>
        </i>
        <span class="kt-menu__link-text">POI</span>
      </a>
    </li>
    <li class="kt-menu__item " aria-haspopup="true">
      <a href="" class="kt-menu__link kt_blockui">
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
          <span></span>
        </i>
        <span class="kt-menu__link-text">
          Geo Ference
        </span>
      </a>
    </li>

    <li class="kt-menu__item " aria-haspopup="true">
      <a href="" class="kt-menu__link kt_blockui">
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
          <span></span>
        </i>
        <span class="kt-menu__link-text">
          User Access
        </span>
      </a>
    </li>

    <li class="kt-menu__item " aria-haspopup="true">
      <a href="" class="kt-menu__link kt_blockui">
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
          <span></span>
        </i>
        <span class="kt-menu__link-text">
          Immobilizer
        </span>
      </a>
    </li>
    {{-- <li
      class="kt-menu__item kt-menu__item--submenu"
      data-ktmenu-submenu-toggle="hover"
      aria-haspopup="true"
      >
      <a
      href="javascript:;"
      class="kt-menu__link kt-menu__toggle"
      >
      <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
        <span></span>
      </i>
      <span class="kt-menu__link-text">
        Multi-level Tabs
      </span>
      <i class="kt-menu__hor-arrow la la-angle-right" ></i>
      <i class="kt-menu__ver-arrow la la-angle-right" ></i>
    </a>
    <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
      <ul class="kt-menu__subnav">
        <li class="kt-menu__item " aria-haspopup="true">
          <a
          href="/metronic/preview/demo3/components/base/tabs/bootstrap.html"
          class="kt-menu__link "
          >
          <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
            <span></span>
          </i>
          <span class="kt-menu__link-text">
            Bootstrap Tabs
          </span>
        </a>
      </li>
      <li class="kt-menu__item " aria-haspopup="true">
        <a
        href="/metronic/preview/demo3/components/base/tabs/line.html"
        class="kt-menu__link "
        >
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
          <span></span>
        </i>
        <span class="kt-menu__link-text">
          Line Tabs
        </span>
      </a>
    </li>
  </ul>
</div>
</li> --}}
</ul>
</div>
</li>
<li
class="kt-menu__item  kt-menu__item--submenu"
aria-haspopup="true"
data-ktmenu-submenu-toggle="hover"
>
<a
href="javascript:;"
class="kt-menu__link kt-menu__toggle"
>
<i class="kt-menu__link-icon flaticon2-gear" ></i>
<span class="kt-menu__link-text">Settings</span>
</a>
<div class="kt-menu__submenu ">
  <span class="kt-menu__arrow" ></span>
  <ul class="kt-menu__subnav">
    <li
    class="kt-menu__item kt-menu__item--submenu"
    data-ktmenu-submenu-toggle="hover"
    aria-haspopup="true"
    >
    <a
    href="javascript:;"
    class="kt-menu__link kt-menu__toggle"
    >
    <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
      <span></span>
    </i>
    <span class="kt-menu__link-text">Users</span>
    <i class="kt-menu__hor-arrow la la-angle-right" ></i>
    <i class="kt-menu__ver-arrow la la-angle-right" ></i>
  </a>
  {{-- {{dd(Auth::user())}} --}}
  <div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
    <ul class="kt-menu__subnav">
      @foreach (App\Models\Role::where('id', '>', Auth::user()->master->role_id)->get() as $user)
      <li class="kt-menu__item " aria-haspopup="true">
        <a href="{{url(''.$user->id.'/user/')}}" class="kt-menu__link {{$user->id == 5? 'd-none' : ''}}" >
          <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
            <span></span>
          </i>
          <span class="kt-menu__link-text">
            {{$user->name}}
          </span>
        </a>
      </li>
      @endforeach
    </ul>
  </div>
</li>
<li
class="kt-menu__item kt-menu__item--submenu"
data-ktmenu-submenu-toggle="hover"
aria-haspopup="true"
>
<a
href="javascript:;"
class="kt-menu__link kt-menu__toggle d-none"
>
<i class="kt-menu__link-bullet kt-menu__link-bullet--line">
  <span></span>
</i>
<span class="kt-menu__link-text">
  System Configuration
</span>
<i class="kt-menu__hor-arrow la la-angle-right" ></i>
<i class="kt-menu__ver-arrow la la-angle-right" ></i>
</a>
<div class="kt-menu__submenu kt-menu__submenu--classic kt-menu__submenu--right">
  <ul class="kt-menu__subnav">
    <li class="kt-menu__item " aria-haspopup="true">
      <a
      href="/metronic/preview/demo3/components/base/tabs/bootstrap.html"
      class="kt-menu__link "
      >
      <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
        <span></span>
      </i>
      <span class="kt-menu__link-text">
        GPS Module
      </span>
    </a>
  </li>
  <li class="kt-menu__item " aria-haspopup="true">
    <a
    href="/metronic/preview/demo3/components/base/tabs/line.html"
    class="kt-menu__link "
    >
    <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
      <span></span>
    </i>
    <span class="kt-menu__link-text">
      SIM Provider
    </span>
  </a>
</li>
<li class="kt-menu__item " aria-haspopup="true">
  <a
  href="/metronic/preview/demo3/components/base/tabs/bootstrap.html"
  class="kt-menu__link "
  >
  <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
    <span></span>
  </i>
  <span class="kt-menu__link-text">
    Tariff Plan
  </span>
</a>
</li>
<li class="kt-menu__item " aria-haspopup="true">
  <a
  href="/metronic/preview/demo3/components/base/tabs/line.html"
  class="kt-menu__link "
  >
  <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
    <span></span>
  </i>
  <span class="kt-menu__link-text">
    Rename Labels
  </span>
</a>
</li>
<li class="kt-menu__item " aria-haspopup="true">
  <a
  href="/metronic/preview/demo3/components/base/tabs/line.html"
  class="kt-menu__link "
  >
  <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
    <span></span>
  </i>
  <span class="kt-menu__link-text">
    Report Customization
  </span>
</a>
</li>
</ul>
</div>
</li>
<li class="kt-menu__item " aria-haspopup="true">
  <a href="{{route('objects.view')}}" class="kt-menu__link kt_blockui">
    <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
      <span></span>
    </i>
    <span class="kt-menu__link-text">Vehicles</span>
  </a>
</li>
<li class="kt-menu__item " aria-haspopup="true">
  <a href="{{route('alerts.view')}}" class="kt-menu__link kt_blockui">
    <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
      <span></span>
    </i>
    <span class="kt-menu__link-text">Alerts</span>
  </a>
</li>
<li class="kt-menu__item d-none" aria-haspopup="true">
  <a href="" class="kt-menu__link kt_blockui">
    <i class="kt-menu__link-bullet kt-menu__link-bullet--line">
      <span></span>
    </i>
    <span class="kt-menu__link-text">Payment</span>
  </a>
</li>
</ul>
</div>
</li>
</ul>
</div>
</div>
{{-- end:: Aside Menu --}}
</div>
{{-- end:: Aside --}}
