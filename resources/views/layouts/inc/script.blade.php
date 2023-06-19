    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('admin') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('admin') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('admin') }}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('admin') }}/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin') }}/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('admin_script')
