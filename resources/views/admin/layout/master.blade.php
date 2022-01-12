<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ড্যাশবোর্ড - {{ @$website_data->title_bangla }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
    <!-- global css -->
    <link rel="shortcut icon" href="{{ asset('Front') }}/images/svg/logo-white-background.svg" type="image/x-icon">

    <!-- global css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}"> --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link href="{{ asset('css/admin/iCheck/css/all.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin/bootstrap-fileinput/css/fileinput.min.css') }}" media="all" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/formelements.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_css/custom.css') }}">
    <link href="{{ asset('css/custom_css/dashboard1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom_css/dashboard1_timeline.css') }}" rel="stylesheet" /> --}}
</head>


<body class="skin-default">
    <div class="preloader">
        <div class="loader_img"><img src="{{ asset('img/loader.gif') }}" alt="loading..." height="64" width="64">
        </div>
    </div>
    <!-- header logo: style can be found in header-->
    @include('admin.layout.inc.topmenu')

    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->

        @include('admin.layout.inc.left-sidebar')

        <aside class="right-side">

            @yield('header')
            <section class="content">

                <div class="background-overlay waterMarkLogo d-flex justify-content-center">
                    <img src="{{ asset('img/digital_bangladesh.svg') }}" alt="">
                </div>

                 <div class="background-overlay waterMarkLogo d-flex justify-content-center">
                    <img src="{{ asset('img/Digital Bangladesh.svg') }}" alt="">
                </div> 

                @yield('content')

            </section>
            <!-- /.content -->
        </aside>
        <!-- /.right-side -->
    </div>
    <!-- ./wrapper -->
    <!-- global js -->
    <div id="qn"></div>


    <script src="{{ asset('js/admin/app.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('js/admin/iCheck/js/icheck.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap-fileinput/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/vendors/bootstrap-fileinput/js/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/admin/form_elements.js') }}"></script>
    <script src="{{ asset('js/admin/dataTables.responsive.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}

    <!-- Toaster -->

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}

    <script>
        @if (Session::has('message'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{{ session('message') }}");
        @endif
        @if (Session::has('error'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.error("{{ session('error') }}");
        @endif
        @if (Session::has('info'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.info("{{ session('info') }}");
        @endif
        @if (Session::has('warning'))
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.warning("{{ session('warning') }}");
        @endif

        $('[data="tooltip"]').tooltip();
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        // $("#summernote").summernote({
        //     placeholder: 'কাউন্সিলরের বাণী ...',
        //     tabsize: 2,
        //     height: 300,
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link']],
        //         ['view', ['fullscreen', 'codeview']]
        //     ]
        // });
    </script>

    @stack('js')

</body>

</html>
