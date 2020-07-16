{{-- begin:: Header --}}
        <div
          id="kt_header"
          class="kt-header kt-grid__item  kt-header--fixed "
        >
          {{-- begin: Header Menu --}}
          <button
            class="kt-header-menu-wrapper-close"
            id="kt_header_menu_mobile_close_btn"
          >
            <i class="la la-close" ></i>
          </button>
          <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div
              id="kt_header_menu"
              class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab "
            >
              <ul class="kt-menu__nav ">
                <li
                  class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel d-none"
                  data-ktmenu-submenu-toggle="click"
                  aria-haspopup="true"
                >
                  <a
                    href="javascript:;"
                    class="kt-menu__link kt-menu__toggle"
                    id="kt_quick_panel_toggler_btn"
                    style="background: #ddd"
                  >
                    <i class="fa fa-bus" style="font-size:2rem" ></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          {{-- end: Header Menu --}}

          {{-- begin:: Header Topbar --}}
          <div class="kt-header__topbar">
            {{--begin: Search --}}
            <div
              class="kt-header__topbar-item kt-header__topbar-item--search dropdown d-none"
              id="kt_quick_search_toggle"
            >
              <div
                class="kt-header__topbar-wrapper"
                data-toggle="dropdown"
                data-offset="10px,0px"
              >
                <span class="kt-header__topbar-icon">
                  <i class="flaticon2-search-1" ></i>
                </span>
              </div>
              <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-top-unround dropdown-menu-anim dropdown-menu-lg">
                <div
                  class="kt-quick-search kt-quick-search--inline"
                  id="kt_quick_search_inline"
                >
                  <form method="get" class="kt-quick-search__form">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="flaticon2-search-1" ></i>
                        </span>
                      </div>
                      <input
                        type="text"
                        class="form-control kt-quick-search__input"
                        placeholder="Search..."
                      />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="la la-close kt-quick-search__close" ></i>
                        </span>
                      </div>
                    </div>
                  </form>
                  <div
                    class="kt-quick-search__wrapper kt-scroll"
                    data-scroll="true"
                    data-height={300}
                    data-mobile-height={200}
                  ></div>
                </div>
              </div>
            </div>
            {{--end: Search --}}

            {{--begin: Cart --}}
            <div class="kt-header__topbar-item dropdown d-none">
              <div
                class="kt-header__topbar-wrapper"
                data-toggle="dropdown"
                data-offset="10px,0px"
              >
                <span class="kt-header__topbar-icon">
                  <i class="flaticon2-shopping-cart-1" ></i>
                </span>
              </div>
              <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                <form>
                  {{-- begin:: Mycart --}}
                  <div class="kt-mycart">
                    <div
                      class="kt-mycart__head kt-head"
                      style="background-image: url({{asset('assets/media/misc/bg-1.jpg')}})"
                      }}
                    >
                      <div class="kt-mycart__info">
                        <span class="kt-mycart__icon">
                          <i class="flaticon2-shopping-cart-1 kt-font-success" ></i>
                        </span>
                        <h3 class="kt-mycart__title">My Cart</h3>
                      </div>
                      <div class="kt-mycart__button">
                        <button
                          type="button"
                          class="btn btn-success btn-sm"
                        >
                          2 Items
                        </button>
                      </div>
                    </div>
                    <div
                      class="kt-mycart__body kt-scroll"
                      data-scroll="true"
                      data-height="245"
                      data-mobile-height="200"
                    >
                      <div class="kt-mycart__item">
                        <div class="kt-mycart__container">
                          <div class="kt-mycart__info">
                            <a href="#" class="kt-mycart__title">
                              Samsung
                            </a>
                            <span class="kt-mycart__desc">
                              Profile info, Timeline etc
                            </span>
                            <div class="kt-mycart__action">
                              <span class="kt-mycart__price">$ 450</span>
                              <span class="kt-mycart__text">for</span>
                              <span class="kt-mycart__quantity">7</span>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                −
                              </a>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                +
                              </a>
                            </div>
                          </div>
                          <a href="#" class="kt-mycart__pic">
                            <img
                              src="{{asset('assets/media/products/product9.jpg')}}"
                              title="Product"
                            />
                          </a>
                        </div>
                      </div>
                      <div class="kt-mycart__item">
                        <div class="kt-mycart__container">
                          <div class="kt-mycart__info">
                            <a href="#" class="kt-mycart__title">
                              Panasonic
                            </a>
                            <span class="kt-mycart__desc">
                              For PHoto &amp; Others
                            </span>
                            <div class="kt-mycart__action">
                              <span class="kt-mycart__price">$ 329</span>
                              <span class="kt-mycart__text">for</span>
                              <span class="kt-mycart__quantity">1</span>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                −
                              </a>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                +
                              </a>
                            </div>
                          </div>
                          <a href="#" class="kt-mycart__pic">
                            <img
                              src="{{asset('assets/media/products/product13.jpg')}}"
                              title="Product"
                            />
                          </a>
                        </div>
                      </div>
                      <div class="kt-mycart__item">
                        <div class="kt-mycart__container">
                          <div class="kt-mycart__info">
                            <a href="#" class="kt-mycart__title">
                              Fujifilm
                            </a>
                            <span class="kt-mycart__desc">
                              Profile info, Timeline etc
                            </span>
                            <div class="kt-mycart__action">
                              <span class="kt-mycart__price">$ 520</span>
                              <span class="kt-mycart__text">for</span>
                              <span class="kt-mycart__quantity">6</span>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                −
                              </a>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                +
                              </a>
                            </div>
                          </div>
                          <a href="#" class="kt-mycart__pic">
                            <img
                              src="{{asset('assets/media/products/product16.jpg')}}"
                              title="Product"
                            />
                          </a>
                        </div>
                      </div>
                      <div class="kt-mycart__item">
                        <div class="kt-mycart__container">
                          <div class="kt-mycart__info">
                            <a href="#" class="kt-mycart__title">
                              Candy Machine
                            </a>
                            <span class="kt-mycart__desc">
                              For PHoto &amp; Others
                            </span>
                            <div class="kt-mycart__action">
                              <span class="kt-mycart__price">$ 784</span>
                              <span class="kt-mycart__text">for</span>
                              <span class="kt-mycart__quantity">4</span>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                −
                              </a>
                              <a
                                href="#"
                                class="btn btn-label-success btn-icon"
                              >
                                +
                              </a>
                            </div>
                          </div>
                          <a href="#" class="kt-mycart__pic">
                            <img
                              src="{{asset('assets/media/products/product15.jpg')}}"
                              alt="image"
                            />
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="kt-mycart__footer">
                      <div class="kt-mycart__section">
                        <div class="kt-mycart__subtitel">
                          <span>Sub Total</span>
                          <span>Taxes</span>
                          <span>Total</span>
                        </div>
                        <div class="kt-mycart__prices">
                          <span>$ 840.00</span>
                          <span>$ 72.00</span>
                          <span class="kt-font-brand">$ 912.00</span>
                        </div>
                      </div>
                      <div class="kt-mycart__button kt-align-right">
                        <button
                          type="button"
                          class="btn btn-primary btn-sm"
                        >
                          Place Order
                        </button>
                      </div>
                    </div>
                  </div>
                  {{-- end:: Mycart --}}
                </form>
              </div>
            </div>
            {{--end: Cart--}}

            {{--begin: User Bar --}}
            <div class="kt-header__topbar-item kt-header__topbar-item--user">
              <div
                class="kt-header__topbar-wrapper"
                data-toggle="dropdown"
                data-offset="0px,0px"
              >
                <div class="kt-header__topbar-user bg-dark">
                  <img
                    class="rounded-circle"
                    alt="Pic"
                    src="{{asset('img/user_image.jpg')}}"
                  />
                  <span class="kt-header__topbar-username kt-hidden-mobile px-3">
                    @auth ('web')
                    {{str_replace(' ','', Auth::user()->name)}}
                    @endauth
                  </span>
                  {{--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) --}}
                  <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bolder">
                    @auth ('web')
                      {{substr(Auth::user()->name, 0, 1)}}
                    @endauth
                  </span>
                </div>
              </div>
              <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                {{--begin: Head --}}
                <div
                  class="kt-user-card kt-user-card--skin-dark bg-dark kt-notification-item-padding-x"
                  style= "background-image: url({{asset('assets/media/misc/bg-2.jpg')}})"

                  }}
                >
                  <div class="kt-user-card__avatar">
                    <img class="kt-hidden" alt="Pic" src="{{asset('assets/media/users/300_25.jpg')}}"/>
                    {{--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) --}}
                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success ">
                      @auth ('web')
                        {{substr(Auth::user()->name, 0, 1)}}
                      @endauth
                    </span>
                  </div>
                  <div class="kt-user-card__name">
                  @auth ('web')
                    {{strlen(Auth::user()->name) > 25 ? substr(Auth::user()->name, 0, 25) . '..' : Auth::user()->name}}
                    <p><small>LOGGED IN AS : <b class="text-success text-uppercase"> {{Auth::user()->master->type->name}}</b></small></p>
                  @endauth
                </div>
                  <div class="kt-user-card__badge d-none">
                    <span class="btn btn-success btn-sm btn-bold btn-font-md">
                      23 messages
                    </span>
                  </div>
                </div>
                {{--end: Head --}}
                {{--begin: Navigation --}}
                <div class="kt-notification">
                  <a href="{{route('account.edit')}}" class="kt-notification__item">
                    <div class="kt-notification__item-icon">
                      <i class="flaticon2-calendar-3 kt-font-success" ></i>
                    </div>
                    <div class="kt-notification__item-details">
                      <div class="kt-notification__item-title kt-font-bold">
                        My Profile
                      </div>
                      <div class="kt-notification__item-time">
                        Account settings and more
                      </div>
                    </div>
                  </a>
                  <div class="kt-notification__custom">
                  <a href="{{route('logout')}}" class="btn btn-label-brand btn-sm btn-bold">
                      Sign Out
                    </a>
                  </div>
                </div>
                {{--end: Navigation --}}
              </div>
            </div>
            {{--end: User Bar --}}
          </div>
          {{-- end:: Header Topbar --}}
        </div>
        {{-- end:: Header --}}
