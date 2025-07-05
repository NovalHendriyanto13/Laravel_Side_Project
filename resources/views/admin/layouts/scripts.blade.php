<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

<script src="{{ asset('js/helpers/api_helper.js') }}"></script>
<script src="{{ asset('js/app/default.js') }}"></script>
<script src="{{ asset('js/pages/index.js') }}"></script>
<script>
    const _appUrl = "{{config('app.url')}}";
    const _apiAppUrl = "{{config('app.api_app_url')}}";
</script>

@stack('scripts')