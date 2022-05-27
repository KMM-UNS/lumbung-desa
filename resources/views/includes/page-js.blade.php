<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/js/app.min.js"></script>
<script src="/assets/js/theme/default.min.js"></script>
<script src="{{ $cdn ?? asset('vendor/sweetalert/sweetalert.all.js')  }}"></script>
<!-- ================== END BASE JS ================== -->

<script src="/assets/js/custom/select2.autofocus.fix.js"></script>
@include('sweetalert::alert')
@stack('scripts')
