<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title_for_layout')</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    {{-- <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    {{-- <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css"/>
    {{-- <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css"/>
    
    {{-- <link rel="stylesheet" href="../assets/css/demo.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Vendors CSS -->
    {{-- <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    {{-- <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" /> --}}

    <!-- Page CSS -->

    <!-- Helpers -->
    {{-- <script src="../assets/vendor/js/helpers.js"></script> --}}
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    {{-- <script src="../assets/js/config.js"></script> --}}
    <script src="{{ asset('assets/js/config.js') }}"></script>

    @yield('css')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img width="70px" src="{{ asset('assets/img/utt-removebg-preview.png') }}"/>
              </span>
              <span style="text-transform: initial" class="app-brand-text demo menu-text fw-bolder ms-2">UTT</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
              <li class="menu-item menu-statistical ">
                <a href="{{route('home')}}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Thống kê</div>
                </a>
              </li>
              
              @if(Auth::user()->TacVu == 1)

              <li class="menu-item current-room ">
                <a href="{{route('rooms.current')}}" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div data-i18n="Analytics">Phòng ở</div>
                </a>
              </li>
              @endif
            <!-- Layouts -->
            @if(Auth::user()->TacVu != 1)
            <li class="menu-item menu-register">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Đăng Ký</div>
              </a>

              <ul class="menu-sub">
                
                <li class="menu-item menu-item-register-student">
                  <a href="{{ route('register.student') }}" class="menu-link">
                    <div data-i18n="Without menu">Cho Sinh Viên</div>
                  </a>
                </li>
                @if(Auth::user()->TacVu == 3)
                  <li class="menu-item menu-item-register-employee">
                    <a href="{{ route('register.employee') }}" class="menu-link">
                      <div data-i18n="Without navbar">Cho Nhân Viên</div>
                    </a>
                  </li>
                @endif
                
              </ul>
            </li>
            @endif
            @if(Auth::user()->TacVu != 1)
            <li class="menu-item menu-room">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Phòng ở</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item menu-item-list-room">
                    <a href="{{ route('rooms.list') }}" class="menu-link">
                      <div data-i18n="Without menu">Danh sách</div>
                    </a>
                  </li>
                </ul>
              </li>
            @endif
            @if(Auth::user()->TacVu == 1)
              <li class="menu-item bill-owe">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Hóa đơn đang nợ</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item menu-item-list-bill-owe">
                    <a href="{{ route('student.bill_owe') }}" class="menu-link">
                      <div data-i18n="Without menu">Danh sách</div>
                    </a>
                  </li>
                </ul>
              </li>
             
              <li class="menu-item room-owe">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Tiền phòng nợ</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item menu-item-room-owe">
                    <a href="{{ route('student.room_owe') }}" class="menu-link">
                      <div data-i18n="Without menu">Danh sách</div>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              <li class="menu-item student-list">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Danh sách sinh viên</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item menu-item-student">
                    <a href="{{ route('student.list') }}" class="menu-link">
                      <div data-i18n="Without menu">Danh sách</div>
                    </a>
                  </li>
                </ul>
              </li>
              @if(Auth::user()->TacVu == 1)
              
              <li class="menu-item contract">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Gia hạn hợp đồng</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item menu-item-contract">
                    <a href="{{ route('student.contract') }}" class="menu-link">
                      <div data-i18n="Without menu">Hợp đồng</div>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              @if(Auth::user()->TacVu == 3)
              <li class="menu-item employee-list">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Danh sách nhân viên</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item menu-item-employee">
                    <a href="{{ route('employee.list') }}" class="menu-link">
                      <div data-i18n="Without menu">Danh sách</div>
                    </a>
                  </li>
                </ul>
              </li>
              @endif
              <li class="menu-item employee-time-list">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                  <i class="menu-icon tf-icons bx bx-layout"></i>
                  <div data-i18n="Layouts">Lich ca làm việc</div>
                </a>
  
                <ul class="menu-sub">
                  <li class="menu-item menu-item-employee-time">
                    <a href="{{ route('employee.schedule_work') }}" class="menu-link">
                      <div data-i18n="Without menu">Danh sách</div>
                    </a>
                  </li>
                </ul>
              </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              {{-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div> --}}
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  {{-- <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  > --}}
                  {{ Auth::user()->owner->HoTen }} - {{ Auth::user()->ten_tac_vu }}
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ Auth::user()->owner->Anh }}" alt class="w-px-40 h-px-40 rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                <img src="{{ Auth::user()->owner->Anh }}" alt class="w-px-40 h-px-40 rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->owner->HoTen }}</span>
                            <small class="text-muted">{{ Auth::user()->ten_tac_vu }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('profile')}}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Hồ sơ</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Đăng xuất</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
            </div>
          </div>
            <!-- / Content -->

            <!-- Footer -->
            {{-- <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    >Documentation</a
                  >

                  <a
                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                    target="_blank"
                    class="footer-link me-4"
                    >Support</a
                  >
                </div>
              </div>
            </footer> --}}
            <!-- / Footer -->

            {{-- <div class="content-backdrop fade"></div> --}}
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    {{-- <script src="../assets/vendor/js/bootstrap.js"></script> --}}
    {{-- <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script> --}}

    {{-- <script src="../assets/vendor/js/menu.js"></script> --}}
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    {{-- <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script> --}}
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable-basic.init.js') }}"></script>
    <link href="{{ asset('assets/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Main JS -->
    {{-- <script src="../assets/js/main.js"></script> --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    {{-- <script src="../assets/js/dashboards-analytics.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
            case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
            case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
            case 'success':
            // toastr.options.positionClass = 'toast-bottom-right';
            toastr.success("{{ Session::get('message') }}");
            break;
            case 'error':
            // toastr.options.positionClass = 'toast-bottom-right';
            toastr.error("{{ Session::get('message') }}");
            break;
            }
        @endif


        if ($(location).attr('pathname').split("/")[1] === 'dang-ky' && $(location).attr('pathname').split("/")[2] ===
            'sinh-vien') {
            $('.menu-register').addClass('open active')
            $('.menu-register .menu-item-register-student').addClass('active')
        } else if ($(location).attr('pathname').split("/")[1] === 'dang-ky' && $(location).attr('pathname').split("/")[
                2] === 'nhan-vien') {
            $('.menu-register').addClass('open active')
            $('.menu-register .menu-item-register-employee').addClass('active')
        }

        if ($(location).attr('pathname').split("/")[1] === 'phong' && $(location).attr('pathname').split("/")[2] ===
            'danh-sach') {
            $('.menu-room').addClass('open active')
            $('.menu-room .menu-item-list-room').addClass('active')
        }

        if ($(location).attr('pathname').split("/")[1] === 'hoa-don-no' && $(location).attr('pathname').split("/")[2] ===
            'danh-sach') {
            $('.bill-owe').addClass('open active')
            $('.bill-owe .menu-item-list-bill-owe').addClass('active')
        }

        if ($(location).attr('pathname').split("/")[1] === 'tien-phong-no' && $(location).attr('pathname').split("/")[2] ===
            'danh-sach') {
            $('.room-owe').addClass('open active')
            $('.room-owe .menu-item-room-owe').addClass('active')
        }

        if ($(location).attr('pathname').split("/")[1] === 'danh-sach' && $(location).attr('pathname').split("/")[2] ===
            'sinh-vien') {
            $('.student-list').addClass('open active')
            $('.student-list .menu-item-student').addClass('active')
        }

        if ($(location).attr('pathname').split("/")[1] === 'danh-sach' && $(location).attr('pathname').split("/")[2] ===
            'nhan-vien') {
            $('.employee-list').addClass('open active')
            $('.employee-list .menu-item-employee').addClass('active')
        }
        if ($(location).attr('pathname') == '/') {
            $('.menu-statistical').addClass('open active')
            // $('.employee-list .menu-item-employee').addClass('active')
        }

        if ($(location).attr('pathname').split("/")[1] === 'ca-lam-viec' && $(location).attr('pathname').split("/")[2] ===
            'danh-sach') {
              console.log(11)
            $('.employee-time-list').addClass('open active')
            $('.employee-time-list .menu-item-employee-time').addClass('active')
        }

        if ($(location).attr('pathname').split("/")[1] === 'hop-dong') {
              console.log(11)
            $('.contract').addClass('open active')
            $('.contract .menu-item-contract').addClass('active')
        }
        if ($(location).attr('pathname').split("/")[1] === 'phong-sinh-vien' && $(location).attr('pathname').split("/")[2] ===
            'hien-tai') {
              console.log(11)
            $('.current-room').addClass('open active')
            // $('.current-room .menu-item-employee-time').addClass('active')
        }
        // menu-statistical
    </script>
    
     @stack('after-scripts')
  </body>
</html>
