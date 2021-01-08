<html>
    <head>
        <title>App - @yield('title')</title>
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('assets/styles/css/themes/lite-purple.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/styles/vendor/perfect-scrollbar.css')}} ">
        <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/vendor/datepicture/css/bootstrap-datepicker.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">
        <script  src="{{asset('assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset('assets/vendor/datepicture/js/bootstrap-datepicker.min.js')}}"></script>
         <script src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
         <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
        
        
        <style>
        .form-group.required label:after{   
            color: #d00;   
            font-family: 'FontAwesome'; 
            font-weight: normal;
            font-size: 10px;
            content: "*"; 
            top:4px;   
            position: absolute;   
            margin-left: 5px;
        }
        .datepicker {
            font-size: 0.875em;
        }
        /* solution 2: the original datepicker use 20px so replace with the following:*/
        
        .datepicker td, .datepicker th {
            width: 1.5em;
            height: 1.5em;
        }
        
        </style>
    </head>
    
    <body class="text-left">
     <!-- Pre Loader Strat  -->
    <div class='loadscreen' id="preloader">
        <div class="loader spinner-bubble spinner-bubble-primary"></div>
    </div>
    <!-- Pre Loader end  -->
     <div class="app-admin-wrap layout-sidebar-large clearfix">
        @include('layout.header')  
        @include('layout.sidebar')
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            @include('layout.notif')
            @yield('content')
         @include('layout.footer')
        </div>  
    </div>
    </body>
    <script>   
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd'
        });

        $('.select').select2();
    });

   
    </script>
    <script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/perfect-scrollbar.min.js')}}"></script>
   
    <script src="{{asset('assets/js/es5/script.min.js')}}"></script>
    <script src="{{asset('assets/js/es5/sidebar.large.script.min.js')}}"></script>
</html>