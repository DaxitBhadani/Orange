<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
      <title> Orange </title>
      <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/selectric.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
      <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

   </head>
   <body>
      <div id="app">


         <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
               <div class="sidebar-header">
                  <div class="d-flex">
                     <div class="logo">
                        <a href="{{ url('/index') }}" class="d-flex align-items-center">
                        <img src="{{asset('assets/img/logo.svg')}}" alt="logo">
                        </a>
                     </div>
                     <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i
                           class="bi bi-x bi-middle"></i></a>
                     </div>
                  </div>
               </div>
               <div class="sidebar-menu">
                  <ul class="menu">
                     <li class="sidebar-item">
                        <a href="{{ url('/index') }}" class="sidebar-link {{ request()->is('/' ,'index') ? 'theme-bg' : '' }}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                        </a>
                     </li>
                     <li class="sidebar-item">
                        <a href="{{ url('users') }}"
                           class="sidebar-link {{ request()->is('users', 'addFakeUserView', ) ? 'theme-bg' : '' }}">
                        <i data-feather="users"></i>
                        <span>Users</span>
                        </a>
                     </li>
                  </ul>
               </div>
               <button class="sidebar-toggler btn x">
               <i data-feather="x"></i>
               </button>
            </div>
         </div>
         <div id="main">
            <header class="d-flex align-items-center justify-content-between">
               <a href="#" class="burger-btn d-block ">
               <i data-feather="menu"></i>
               </a>
               <div class="btn-group me-1 mb-1">
                  <div class="dropdown">
                     <button type="button" class="btn btn-success border-0 theme-bg px-4 d-flex align-items-center"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i data-feather="log-out"></i>
                     <span class="ms-2">
                     Logout
                     </span>
                     </button>
                     <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="logout">
                        Log Out
                        </a>
                     </div>
                  </div>
               </div>
            </header>
            <main class="p-4">
               @yield('content')
            </main>
         </div>
      </div>

      <script src="{{ asset('assets/js/feather.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
      <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
      <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
      <script src="{{ asset('assets/js/select2.min.js') }}"></script>
      <script src="{{ asset('assets/js/jquery.selectric.js') }}"></script>
      <script src="{{ asset('assets/js/main.js') }}"></script>

      <script>
         feather.replace();
         // $(document).ready(function() {
         //     $('select').selectric();
         // });
      </script>
      @yield('scripts')
   </body>
</html>