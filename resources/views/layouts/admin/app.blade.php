<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- <title>{{ config('app.name') }}</title> -->
    <title>Luxe Montre CRM</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Data table CSS -->
    <link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>


    <link href="{{ asset('vendors/bower_components/datatables.net-responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Toast CSS -->
    <link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">

    <!-- select2 CSS -->
    <link href="{{ asset('vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- switchery CSS -->
    <link href="{{ asset('vendors/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Sweet Alert CSS -->
    <link href="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.css') }}" rel="stylesheet" type="text/css">
    
    <!-- bootstrap-select CSS -->
    <link href="{{ asset('vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- bootstrap-tagsinput CSS -->
    <link href="{{ asset('vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- bootstrap-touchspin CSS -->
    <link href="{{ asset('vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- multi-select CSS -->
    <link href="{{ asset('vendors/bower_components/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Bootstrap Switches CSS -->
    <link href="{{ asset('vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Bootstrap Datetimepicker CSS -->
    <link href="{{ asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css"/>    

    
     <!-- Bootstrap Date range picker CSS -->
     <link href="{{ asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css"/>    

    <!-- Bootstrap Dropzone CSS -->
    <link href="{{ asset('vendors/bower_components/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css"/>
    
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper theme-3-active pimary-color-gold">

        @include('layouts.admin.header')

        @include('layouts.admin.sidebar')

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer container-fluid pl-30 pr-30">
                <div class="row">
                    <div class="col-sm-12">
                        <p>2019 &copy; Luxe Montre</p>
                    </div>
                </div>
            </footer>
            <!-- /Footer -->
        </div>      
    </div>
    <!-- /#wrapper -->
    
    <!-- JavaScript -->


    <script>
        //var getusers_url = '{!! route('get.users') !!}';
    </script>
    
    <!-- jQuery -->
    <script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <!-- Counter Animation JavaScript -->
    <script src="{{ asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>
    
    <!-- Data table JavaScript -->
    <script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/productorders-data.js') }}"></script>
    <!-- <script src="{{ asset('dist/js/dataTables-data.js') }}"></script> -->
    
    <!-- Owl JavaScript -->
    <script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    
    <!-- Switchery JavaScript -->
    <script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>

    <!-- Switchery JavaScript -->
    <script src="{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>
    
    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>
    
    <!-- Sparkline JavaScript -->
    <script src="{{ asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>
    
    <!-- EChartJS JavaScript -->
    <script src="{{ asset('vendors/bower_components/echarts/dist/echarts-en.min.js') }}"></script>

    <script src="{{ asset('vendors/echarts-liquidfill.min.js') }}"></script>
    
    <!-- Toast JavaScript -->
    <script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

    <!-- Switchery JavaScript -->
    <script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>
    
    <!-- Select2 JavaScript -->
    <script src="{{ asset('vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    
    <!-- Bootstrap Select JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    
    <!-- Bootstrap Tagsinput JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    
    <!-- Bootstrap Touchspin JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    
    <!-- Multiselect JavaScript -->
    <script src="{{ asset('vendors/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
    
     
    <!-- Bootstrap Switch JavaScript -->
    <script src="{{ asset('vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>

    <!-- Moment JavaScript -->
	<script type="text/javascript" src="{{ asset('vendors/bower_components/moment/min/moment-with-locales.min.js') }}"></script>
    
    <!-- Bootstrap Datetimepicker JavaScript -->
    <script type="text/javascript" src="{{ asset('vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    
    <!-- Bootstrap Daterangepicker JavaScript -->
	<script src="{{ asset('vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Form Advance Init JavaScript -->
    <script src="{{ asset('dist/js/form-advance-data.js') }}"></script>
    
    <!-- Slimscroll JavaScript -->
    <script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>
    
    <!-- Owl JavaScript -->
    <script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

    <!-- Dropzone JavaScript -->
    <script src="{{ asset('vendors/bower_components/dropzone/dist/dropzone.js') }}"></script>
    
    <!-- Dropzone Init JavaScript -->
    <script src="{{ asset('dist/js/dropzone-data.js') }}"></script>
    
    <!-- Init JavaScript -->
    <script src="{{ asset('dist/js/init.js') }}"></script>
    <script src="{{ asset('dist/js/dashboard3-data.js') }}"></script>


    <!-- For export buttons -->
    <script src="{{ asset('vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/pdfmake/build/vfs_fonts.js') }}"></script>
    
    <script src="{{ asset('vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>