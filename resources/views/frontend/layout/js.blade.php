@livewireScripts
<script src="/frontend/vendor/jquery/jquery.min.js"></script>
<script src="/frontend/vendor/jquery.appear/jquery.appear.min.js"></script>
<script src="/frontend/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="/frontend/vendor/jquery.cookie/jquery.cookie.js"></script>
<script src="/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/frontend/vendor/common/common.min.js"></script>
<script src="/frontend/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
<script src="/frontend/vendor/isotope/jquery.isotope.min.js"></script>
<script src="/frontend/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="/frontend/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/frontend/vendor/vide/jquery.vide.min.js"></script>
<script src="/frontend/vendor/vivus/vivus.min.js"></script>
<script src="/frontend/js/theme.js"></script>
<script src="/frontend/vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="/frontend/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="/frontend/js/custom.js"></script>
<script async src="/frontend/js/theme.init.js"></script>
<script src="/frontend/js/examples/examples.lightboxes.js"></script>


@section('customJS')
    <script>
        $(document).ready(function() {
         setInterval(function(){ $(".alertt").fadeOut(); }, 6000);
        })
    </script>
@endsection

