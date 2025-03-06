<!DOCTYPE html>
<html lang="en" dir="ltr">
<style>
    .table-striped > tbody > tr:nth-of-type(odd) > * {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: #292b2e !important;
}
</style>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Projector Cabinet - Admin Dashboard eCommerce HTML Template.">

    <title>Projector Cabinet - Admin Dashboard eCommerce HTML Template.</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800;900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ url('/') }}/admin/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="{{ url('/') }}/admin/assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
<!-- Data Tables -->
<link href='{{ url('/') }}/admin/assets/plugins/data-tables/datatables.bootstrap5.min.css' rel='stylesheet'>
<link href='{{ url('/') }}/admin/assets/plugins/data-tables/responsive.datatables.min.css' rel='stylesheet'>
    <!-- Projector Cabinet CSS -->
    <link id="ekka-css" href="{{ url('/') }}/admin/assets/css/ekka.css" rel="stylesheet" />

    <!-- FAVICON -->
    <link href="{{ url('/') }}/admin/assets/img/favicon.png" rel="shortcut icon" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

    <!--  WRAPPER  -->
    <div class="wrapper">

        <!-- LEFT MAIN SIDEBAR -->

        @include ('admin.layouts.leftsidebar')

        <!--  PAGE WRAPPER -->
        <div class="ec-page-wrapper">

            <!-- Header -->

            @include ('admin.layouts.header')

            <!-- CONTENT WRAPPER -->

            @yield('content')

            <!-- Footer -->

            @include ('admin.layouts.footer')

        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->

    <!-- Common Javascript -->
    <script src="{{ url('/') }}/admin/assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/plugins/simplebar/simplebar.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/plugins/jquery-zoom/jquery.zoom.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/plugins/slick/slick.min.js"></script>
    <!-- Data Tables -->
    <script src='{{ url('/') }}/admin/assets/plugins/data-tables/jquery.datatables.min.js'></script>
    <script src='{{ url('/') }}/admin/assets/plugins/data-tables/datatables.bootstrap5.min.js'></script>
    <script src='{{ url('/') }}/admin/assets/plugins/data-tables/datatables.responsive.min.js'></script>

    <!-- Chart -->
    <script src="{{ url('/') }}/admin/assets/plugins/charts/Chart.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/chart.js"></script>

    <!-- Google map chart -->
    <script src="{{ url('/') }}/admin/assets/plugins/charts/google-map-loader.js"></script>
    <script src="{{ url('/') }}/admin/assets/plugins/charts/google-map.js"></script>

    <!-- Date Range Picker -->
    <script src="{{ url('/') }}/admin/assets/plugins/daterangepicker/moment.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="{{ url('/') }}/admin/assets/js/date-range.js"></script>

    <!-- Option Switcher -->
    <script src="{{ url('/') }}/admin/assets/plugins/options-sidebar/optionswitcher.js"></script>

    <!-- Projector Cabinet Custom -->
    <script src="{{ url('/') }}/admin/assets/js/ekka.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 800, // Set editor height
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
    @stack('script')
</body>

</html>
