<!-- Vendor JS Files -->
<script src="{{ URL::asset('dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('dist/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ URL::asset('dist/vendor/aos/aos.js') }}"></script>
<script src="{{ URL::asset('dist/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('dist/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('dist/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ URL::asset('dist/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('dist/vendor/purecounter/purecounter_vanilla.js') }}"></script>


<!-- Main JS File -->
<script src="{{ URL::asset('dist/js/main.js') }}"></script>
@yield('script')
@yield('script-bottom')
<!-- jQuery 3 -->
<script src="{{ URL::asset('build/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- TOASTR -->
<script src="{{ URL::asset('build/plugins/toastr/toastr.min.js') }}"></script>

<script type="text/javascript">
    @if (session()->has('success'))
        toastr.success('{{ session('success') }}')
    @elseif (session()->has('error'))
        toastr.error('{{ session('error') }}')
    @endif
</script>
