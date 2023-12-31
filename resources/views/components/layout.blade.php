<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
@if (auth()->guard('oauth2')->check() && auth()->guard('oauth2')->user()->exists)
    <!-- API Token -->
    <meta name="sso-token" content="{{ auth()->guard('oauth2')->user()->createToken('SSO')->plainTextToken }}">
@endif
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon.ico">
    <link rel="icon" type="image/ico" sizes="32x32" href="/favicon.ico">
    <link rel="mask-icon" href="/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <!-- base css -->
    <link rel="stylesheet" media="screen, print" href="/css/vendors.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/css/app.bundle.css">
    <!-- vendor css -->
    <link rel="stylesheet" media="screen, print" href="/css/datagrid/datatables/datatables.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/css/notifications/sweetalert2/sweetalert2.bundle.css">
    <link rel="stylesheet" media="screen, print" href="/css/formplugins/select2/select2.bundle.css">

    <style type="text/css">

        .info-card-text
        {
            font-size: 1rem;
        }

        .info-card-text > span
        {
            font-size: .75rem;
        }

        .panel-content .btn-add a
        {
            color: inherit;
        }

        table .pointer
        {
            cursor: pointer;
        }

        .modal:not(.js-modal-settings):not(.modal-alert) .modal-header .modal-title
        {
            text-transform: capitalize;
        }

        .fit-image
        {
            object-fit: cover;
            object-position: top;
        }

        #alert-dismissible .fade:not(.show)
        {
            display: none;
        }

    </style>

  </head>
  <body class="mod-bg-1">
    <!-- DOC: script to save and load page settings -->
    <script>
    /**
     *	This script should be placed right after the body tag for fast execution
     *	Note: the script is written in pure javascript and does not depend on thirdparty library
     **/
      'use strict';

      var themeURLDefault = '/css/themes/cust-theme-4.css';
      var themeOptionsDefault = 'mod-bg-1 header-function-fixed nav-function-fixed';

      var classHolder = document.getElementsByTagName("BODY")[0],
        /**
         * Load from localstorage
         **/
        themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
            {themeURL: themeURLDefault},

        themeURL = themeSettings.themeURL || '',
        themeOptions = themeSettings.themeOptions || '';
    /**
     * Load theme options
     **/
      if (themeSettings.themeOptions)
      {
        classHolder.className = themeSettings.themeOptions;
        console.log("%c✔ Theme settings loaded", "color: #148f32");
      }
      else
      {
        console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
      }

      if (themeSettings.themeURL && !document.getElementById('mytheme'))
      {
        var cssfile = document.createElement('link');
        cssfile.id = 'mytheme';
        cssfile.rel = 'stylesheet';
        cssfile.href = themeURL;
        document.getElementsByTagName('head')[0].appendChild(cssfile);
      }
    /**
     * Save to localstorage
     **/
      var saveSettings = function()
      {
        themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
        {
            return /^(nav|header|mod|display)-/i.test(item);
        }).join(' ');
        if (document.getElementById('mytheme'))
        {
            themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
        };
        localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
      }
    /**
     * Reset settings
     **/
      var resetSettings = function()
      {
        localStorage.setItem("themeSettings", "");
      }
    /**
     * Load default theme options
     **/
      if (!themeOptions || (themeOptions === 'mod-bg-1')) {
        classHolder.className = themeOptionsDefault;
        saveSettings();
        console.log("%c✔ Theme settings loaded", "color: #148f32");
      }

    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
      <div class="page-inner">
        <!-- BEGIN Left Aside -->
        <aside class="page-sidebar">
          <div class="page-logo">
            <a href="/" class="press-scale-down d-flex align-items-center position-relative">
              <img class="img-fluid" src="/img/logo.webp" alt="SmartAdmin WebApp" aria-roledescription="logo">
            </a>
          </div>
          <!-- BEGIN PRIMARY NAVIGATION -->
          <nav id="js-primary-nav" class="primary-nav" role="navigation">
            <div class="nav-filter">
              <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                  <i class="fal fa-chevron-up"></i>
                </a>
              </div>
            </div>
@if (auth()->guard('oauth2')->check())
            <div class="info-card">
              <img src="/img/avatars/avatar-male.png" alt="profile photo" class="profile-image rounded">
              <div class="info-card-text w-100 ml-0 text-center">
                <span class="fs-lg text-truncate text-truncate-sm text-uppercase d-inline-block">
                  {{ auth()->guard('oauth2')->user()->first_name }}
                </span>
@if (auth()->guard('oauth2')->user()->exists)
                <span class="d-block">
                  {!! nl2br(ucwords(auth()->guard('oauth2')->user()->userRoles()->with('role')->get()->pluck('role.name')->join("\n"))) !!}
                </span>
@endif
              </div>
              <img src="/img/backgrounds/bg-3.png" class="cover" alt="cover">
              <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
              </a>
            </div>
            <ul id="js-nav-menu" class="nav-menu">
              <li>
                <a href="{{ url()->to('/') }}" title="Dashboard" data-filter-tags="dashboard">
                  <i class="fal fa-chart-pie"></i>
                  <span class="nav-link-text" data-i18n="nav.dashboard">Dashboard</span>
                </a>
              </li>
              <li>
                <a href="#" title="SME" data-filter-tags="sme">
                  <i class="ni ni-notebook"></i>
                  <span class="nav-link-text" data-i18n="nav.theme_settings">SME</span>
                </a>
                <ul>
                  <li>
                    <a href="{{ route('SME.logbook.index') }}" title="Logbook" data-filter-tags="sme logbook">
                      <span class="nav-link-text" data-i18n="nav.sme_logbook">Logbook</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('SME.assignment.index') }}" title="Assignment" data-filter-tags="sme assignment">
                      <span class="nav-link-text" data-i18n="nav.sme_assignment">Assignment</span>
                    </a>
                  </li>
                  <li>
                    <a href="{{ route('SME.approval') }}" title="CRS Management &amp; Approval" data-filter-tags="sme crs management approval">
                      <span class="nav-link-text" data-i18n="nav.sme_approval">CRS Management &amp; Approval</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#" title="Commercial" data-filter-tags="commercial">
                  <i class="fal fa-book"></i>
                  <span class="nav-link-text" data-i18n="nav.commercial">Commercial</span>
                </a>
                <ul>
                  <li>
                    <a href="{{ route('SME.logbook.index') }}" title="Logbook" data-filter-tags="commercial logbook">
                      <span class="nav-link-text" data-i18n="nav.commercial_logbook">Logbook</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="{{ route('users.index') }}" title="Users" data-filter-tags="users">
                  <i class="fal fa-user"></i>
                  <span class="nav-link-text" data-i18n="nav.users">Users</span>
                </a>
              </li>
            </ul>
@endif
            <div class="filter-message js-filter-message bg-success-600"></div>
          </nav>
          <!-- END PRIMARY NAVIGATION -->
        </aside>
        <!-- END Left Aside -->
        <div class="page-content-wrapper">
          <!-- BEGIN Page Header -->
          <header class="page-header" role="banner">
            <!-- DOC: nav menu layout change shortcut -->
            <div class="hidden-md-down dropdown-icon-menu position-relative">
              <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                <i class="ni ni-menu"></i>
              </a>
            </div>
            <!-- DOC: mobile button appears during mobile width -->
            <div class="hidden-lg-up">
              <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                <i class="ni ni-menu"></i>
              </a>
            </div>
            <div class="search">
              <form class="app-forms hidden-xs-down" role="search" action="/search" autocomplete="off" method="get">
                <input type="text" id="search-field" name="query" placeholder="Search for anything" class="form-control" tabindex="1">
              </form>
            </div>
            <div class="ml-auto d-flex">
              <!-- activate app search icon (mobile) -->
              <div class="hidden-sm-up">
                <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
                  <i class="fal fa-search"></i>
                </a>
              </div>
              <!-- app settings -->
              <div class="hidden-md-down">
                <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                  <i class="fal fa-cog"></i>
                </a>
              </div>
@if (auth()->guard('oauth2')->check())
              <!-- app user menu -->
              <div>
                <a href="#" data-toggle="dropdown" title="{{ auth()->guard('oauth2')->user()->email }}" class="header-icon d-flex align-items-center justify-content-center ml-2">
                  <img src="/img/avatars/avatar-male.png" width="32" height="32" class="profile-image rounded-circle fit-image" alt="User Avatar">
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                  <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                      <span class="mr-2">
                        <img src="/img/avatars/avatar-male.png" class="rounded-circle profile-image" alt="User Avatar">
                      </span>
                      <div class="info-card-text">
                        <div class="fs-lg text-truncate text-truncate-lg">
                          {{
                            (string) (
                                \Illuminate\Support\Str::of(auth()->guard('oauth2')->user()->first_name)
                                ->when(auth()->guard('oauth2')->user()->last_name, function($string) {
                                    return $string->append(' ', auth()->guard('oauth2')->user()->last_name);
                                })
                                ->title()
                                ->whenEmpty( function($string) {
                                    return auth()->guard('oauth2')->user()->email;
                                })
                            )
                          }}
                        </div>
                        <span class="text-truncate text-truncate-md opacity-80">{{ auth()->guard('oauth2')->user()->email }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown-divider m-0"></div>
                  <a href="#" class="dropdown-item" data-action="app-reset">
                    <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                  </a>
                  <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                    <span data-i18n="drpdwn.settings">Settings</span>
                  </a>
                  <div class="dropdown-divider m-0"></div>
                  <a href="#" class="dropdown-item" data-action="app-fullscreen">
                    <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                    <i class="float-right text-muted fw-n">F11</i>
                  </a>
                  <a href="#" class="dropdown-item" data-action="app-print">
                    <span data-i18n="drpdwn.print">Print</span>
                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                  </a>
                  <div class="dropdown-divider m-0"></div>
                  <a class="dropdown-item fw-500 pt-3 pb-3" href="#">
                    <span data-i18n="drpdwn.page-logout">Logout</span>
                    <span class="float-right fw-n">&commat;idn.ccb.com</span>
                  </a>
                </div>
              </div>
@endif
            </div>
          </header>
          <!-- END Page Header -->
          <!-- BEGIN Page Content -->
{{ $slot }}
          <!-- END Page Content -->
          <!-- BEGIN Modal Alert -->
          <div class="modal modal-alert fade" id="modal-alert" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">
                    Are you sure?
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                  </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END Modal Alert -->
          <!-- BEGIN Page Footer -->
          <footer class="page-footer" role="contentinfo">
            <div class="d-flex align-items-center flex-1 text-muted">
              <span class="hidden-md-down fw-700">
                2022 © {{ config('app.name') }}. Developed by IT System Development CCBI.
              </span>
            </div>
            <div>
              <ul class="list-table m-0">
                <li><a href="#about" class="text-secondary fw-700">About</a></li>
                <li class="pl-3"><a href="#license" class="text-secondary fw-700">License</a></li>
                <li class="pl-3"><a href="#documentation" class="text-secondary fw-700">Documentation</a></li>
                <li class="pl-3 fs-xl"><a href="#help" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </footer>
          <!-- END Page Footer -->
          <!-- BEGIN Color profile -->
          <!-- this area is hidden and will not be seen on screens or screen readers -->
          <!-- we use this only for CSS color refernce for JS stuff -->
          <p id="js-color-profile" class="d-none">
            <span class="color-primary-50"></span>
            <span class="color-primary-100"></span>
            <span class="color-primary-200"></span>
            <span class="color-primary-300"></span>
            <span class="color-primary-400"></span>
            <span class="color-primary-500"></span>
            <span class="color-primary-600"></span>
            <span class="color-primary-700"></span>
            <span class="color-primary-800"></span>
            <span class="color-primary-900"></span>
            <span class="color-info-50"></span>
            <span class="color-info-100"></span>
            <span class="color-info-200"></span>
            <span class="color-info-300"></span>
            <span class="color-info-400"></span>
            <span class="color-info-500"></span>
            <span class="color-info-600"></span>
            <span class="color-info-700"></span>
            <span class="color-info-800"></span>
            <span class="color-info-900"></span>
            <span class="color-danger-50"></span>
            <span class="color-danger-100"></span>
            <span class="color-danger-200"></span>
            <span class="color-danger-300"></span>
            <span class="color-danger-400"></span>
            <span class="color-danger-500"></span>
            <span class="color-danger-600"></span>
            <span class="color-danger-700"></span>
            <span class="color-danger-800"></span>
            <span class="color-danger-900"></span>
            <span class="color-warning-50"></span>
            <span class="color-warning-100"></span>
            <span class="color-warning-200"></span>
            <span class="color-warning-300"></span>
            <span class="color-warning-400"></span>
            <span class="color-warning-500"></span>
            <span class="color-warning-600"></span>
            <span class="color-warning-700"></span>
            <span class="color-warning-800"></span>
            <span class="color-warning-900"></span>
            <span class="color-success-50"></span>
            <span class="color-success-100"></span>
            <span class="color-success-200"></span>
            <span class="color-success-300"></span>
            <span class="color-success-400"></span>
            <span class="color-success-500"></span>
            <span class="color-success-600"></span>
            <span class="color-success-700"></span>
            <span class="color-success-800"></span>
            <span class="color-success-900"></span>
            <span class="color-fusion-50"></span>
            <span class="color-fusion-100"></span>
            <span class="color-fusion-200"></span>
            <span class="color-fusion-300"></span>
            <span class="color-fusion-400"></span>
            <span class="color-fusion-500"></span>
            <span class="color-fusion-600"></span>
            <span class="color-fusion-700"></span>
            <span class="color-fusion-800"></span>
            <span class="color-fusion-900"></span>
          </p>
          <!-- END Color profile -->
        </div>
      </div>
    </div>
    <!-- END Page Wrapper -->
    <!-- BEGIN Quick Menu -->
    <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
    <nav class="shortcut-menu d-none d-sm-block">
      <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
      <label for="menu_open" class="menu-open-button ">
        <span class="app-shortcut-icon d-block"></span>
      </label>
      <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
        <i class="fal fa-arrow-up"></i>
      </a>
      <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
        <i class="fal fa-sign-out"></i>
      </a>
      <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
        <i class="fal fa-expand"></i>
      </a>
      <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
        <i class="fal fa-print"></i>
      </a>
      <a href="#" class="menu-item btn" data-action="app-voice" data-toggle="tooltip" data-placement="left" title="Voice command">
        <i class="fal fa-microphone"></i>
      </a>
    </nav>
    <!-- END Quick Menu -->
    <!-- BEGIN Page Settings -->
    <div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-right modal-md">
        <div class="modal-content">
          <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
            <h4 class="m-0 text-center color-white">
              Layout Settings
              <small class="mb-0 opacity-80">User Interface Settings</small>
            </h4>
            <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fal fa-times"></i></span>
            </button>
          </div>
          <div class="modal-body p-0">
            <div class="settings-panel">
              <div class="mt-4 d-table w-100 px-5">
                <div class="d-table-cell align-middle">
                  <h5 class="p-0">
                    App Layout
                  </h5>
                </div>
              </div>
              <div class="list" id="fh">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
                <span class="onoffswitch-title">Fixed Header</span>
                <span class="onoffswitch-title-desc">header is in a fixed at all times</span>
              </div>
              <div class="list" id="nff">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
                <span class="onoffswitch-title">Fixed Navigation</span>
                <span class="onoffswitch-title-desc">left panel is fixed</span>
              </div>
              <div class="list" id="nfm">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
                <span class="onoffswitch-title">Minify Navigation</span>
                <span class="onoffswitch-title-desc">Skew nav to maximize space</span>
              </div>
              <div class="list" id="nfh">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
                <span class="onoffswitch-title">Hide Navigation</span>
                <span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
              </div>
              <div class="list" id="nft">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
                <span class="onoffswitch-title">Top Navigation</span>
                <span class="onoffswitch-title-desc">Relocate left pane to top</span>
              </div>
              <div class="list" id="mmb">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
                <span class="onoffswitch-title">Boxed Layout</span>
                <span class="onoffswitch-title-desc">Encapsulates to a container</span>
              </div>
              <div class="expanded">
                <ul class="">
                  <li>
                    <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                  </li>
                  <li>
                    <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                  </li>
                  <li>
                    <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                  </li>
                  <li>
                    <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                  </li>
                </ul>
                <div class="list" id="mbgf">
                  <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
                  <span class="onoffswitch-title">Fixed Background</span>
                </div>
              </div>
              <div class="mt-4 d-table w-100 px-5">
                <div class="d-table-cell align-middle">
                  <h5 class="p-0">
                    Mobile Menu
                  </h5>
                </div>
              </div>
              <div class="list" id="nmp">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
                <span class="onoffswitch-title">Push Content</span>
                <span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
              </div>
              <div class="list" id="nmno">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
                <span class="onoffswitch-title">No Overlay</span>
                <span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
              </div>
              <div class="list" id="sldo">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
                <span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
                <span class="onoffswitch-title-desc">Content overlaps menu</span>
              </div>
              <div class="mt-4 d-table w-100 px-5">
                <div class="d-table-cell align-middle">
                  <h5 class="p-0">
                    Accessibility
                  </h5>
                </div>
              </div>
              <div class="list" id="mbf">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
                <span class="onoffswitch-title">Bigger Content Font</span>
                <span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
              </div>
              <div class="list" id="mhc">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
                <span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
                <span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
              </div>
              <div class="list" id="mcb">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
                <span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
                <span class="onoffswitch-title-desc">color vision deficiency</span>
              </div>
              <div class="list" id="mpc">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
                <span class="onoffswitch-title">Preloader Inside</span>
                <span class="onoffswitch-title-desc">preloader will be inside content</span>
              </div>
              <div class="mt-4 d-table w-100 px-5">
                <div class="d-table-cell align-middle">
                  <h5 class="p-0">
                    Global Modifications
                  </h5>
                </div>
              </div>
              <div class="list" id="mcbg">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
                <span class="onoffswitch-title">Clean Page Background</span>
                <span class="onoffswitch-title-desc">adds more whitespace</span>
              </div>
              <div class="list" id="mhni">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
                <span class="onoffswitch-title">Hide Navigation Icons</span>
                <span class="onoffswitch-title-desc">invisible navigation icons</span>
              </div>
              <div class="list" id="dan">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
                <span class="onoffswitch-title">Disable CSS Animation</span>
                <span class="onoffswitch-title-desc">Disables CSS based animations</span>
              </div>
              <div class="list" id="mhic">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
                <span class="onoffswitch-title">Hide Info Card</span>
                <span class="onoffswitch-title-desc">Hides info card from left panel</span>
              </div>
              <div class="list" id="mlph">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
                <span class="onoffswitch-title">Lean Subheader</span>
                <span class="onoffswitch-title-desc">distinguished page header</span>
              </div>
              <div class="list" id="mnl">
                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
                <span class="onoffswitch-title">Hierarchical Navigation</span>
                <span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
              </div>
              <div class="list mt-1">
                <span class="onoffswitch-title">Global Font Size <small>(RESETS ON REFRESH)</small> </span>
                <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                  <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
                    <input type="radio" name="changeFrontSize"> SM
                  </label>
                  <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
                    <input type="radio" name="changeFrontSize" checked=""> MD
                  </label>
                  <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
                    <input type="radio" name="changeFrontSize"> LG
                  </label>
                  <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
                    <input type="radio" name="changeFrontSize"> XL
                  </label>
                </div>
                <span class="onoffswitch-title-desc d-block mb-0">Change <strong>root</strong> font size to effect rem values</span>
              </div>
              <hr class="mb-0 mt-4">
              <div class="mt-2 d-table w-100 pl-5 pr-3">
                <div class="fs-xs text-muted p-2 alert alert-warning mt-3 mb-2">
                  <i class="fal fa-exclamation-triangle text-warning mr-2"></i>The settings below uses localStorage to load
                  the external CSS file as an overlap to the base css. Due to network latency and CPU utilization, you may
                  experience a brief flickering effect on page load which may show the intial applied theme for a split
                  second. Setting the prefered style/theme in the header will prevent this from happening.
                </div>
              </div>
              <div class="mt-2 d-table w-100 pl-5 pr-3">
                <div class="d-table-cell align-middle">
                  <h5 class="p-0">
                    Theme colors
                  </h5>
                </div>
              </div>
              <div class="expanded theme-colors pl-5 pr-3">
                <ul class="m-0">
                  <li>
                    <a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-1.css" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-2.css" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-3.css" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-4.css" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-5.css" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-6.css" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-7.css" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-8.css" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-9.css" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-10.css" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-11.css" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-12.css" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>
                  </li>
                  <li>
                    <a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="/css/themes/cust-theme-13.css" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a>
                  </li>
                </ul>
              </div>
              <hr class="mb-0 mt-4">
              <div class="pl-5 pr-3 py-3 bg-faded">
                <div class="row no-gutters">
                  <div class="col-6 pr-1">
                    <a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>
                  </div>
                  <div class="col-6 pl-1">
                    <a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>
                  </div>
                </div>
              </div>
            </div> <span id="saving"></span>
          </div>
        </div>
      </div>
    </div>
    <!-- END Page Settings -->
    <script src="/js/vendors.bundle.js"></script>
    <script src="/js/app.bundle.js"></script>
    <script src="/js/datagrid/datatables/datatables.bundle.js"></script>
    <script src="/js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
    <script src="/js/formplugins/select2/select2.bundle.js"></script>
    <script src="/js/moment/min/moment.min.js"></script>

@stack('scripts')

@if (auth()->guard('oauth2')->check())
    <script type="text/javascript">
        $(document).ready(function()
        {
            var nav = [
//@@can('viewAny', 'App\SalesDeal')
                'nav.dashboard',
                'nav.sme_logbook',
                'nav.sme_assignment',
                'nav.sme_approval',
                'nav.users'
//@@endcan
            ];

            $('#js-nav-menu span[data-i18n]').each(function(key, element) {
                $(element).closest('li').addClass('collapse');

                if ($.inArray(element.getAttribute('data-i18n'), nav) >= 0) {
                    $(element).closest('li').addClass('show');

                    if ($(element).has('ul')) {
                        $(element).closest('ul').closest('li').addClass('show');
                    }

                }
            })

            const profileImage = new Image;

            profileImage.onload = function() {
                $(document).find('img.profile-image').each( function(key, element) {
                    element.src = profileImage.src;
                })
            }

            profileImage.onerror = function() {
                profileImage.onerror = null;

                profileImage.src = ('/img/avatars/avatar-')
                    .concat(@json(strtolower(trim(auth()->guard('oauth2')->user()->gender))))
                    .concat('.png');

                profileImage.onload = function() {
                    $(document).find('img.profile-image').each( function(key, element) {
                        element.src = profileImage.src;
                    })
                }
            }

            profileImage.src = @json(auth()->guard('oauth2')->user()->photo);

            initApp.destroyNavigation(myapp_config.navHooks);
            $(document).find(String('a[href="').concat(@json(url()->current())).concat('"]')).parent().attr('class', 'active');

            if ($(document).find(String('a[href="').concat(@json(url()->current())).concat('"]')).parent().parent().parent().is('li')) {
                $(document).find(String('a[href="').concat(@json(url()->current())).concat('"]')).parent().parent().parent()
                .attr('class', 'active open');
            }

            initApp.buildNavigation(myapp_config.navHooks);

        });

        var controls = {
            leftArrow: '<i class="fal fa-angle-left" style="font-size: 1.25rem"></i>',
            rightArrow: '<i class="fal fa-angle-right" style="font-size: 1.25rem"></i>'
        }

    </script>

    <script type="text/javascript">
        $(document).find('.page-link[aria-label="Previous"]').on('click', function() {
            window.history.back();
        })

    </script>
@endif

  </body>
</html>
