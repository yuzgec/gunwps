<section class="section bg-dark-4 py-3 mt-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 col-12">
                <h2 class="text-color-light text-4">{{ __('site.newsletter') }}</h2>
            </div>
            <div class="col-md-6 col-12 text-white">
                <p class="text-white"> Subscribe to our newsletter.<br> Be the first to benefit from discounts and campaigns</p>
            </div>
            <div class="col-md-4 col-12">
                <form class="newsletter-form" action="{{ route('mailsubscribe') }}" method="POST">
                    @csrf
                    <div class="input-group bg-light rounded">
                        <input type="email" name="email" class="newsletter-email form-control border-0 rounded" placeholder="{{ __('site.enteremail') }}" required>
                        <span class="input-group-btn p-1">
                            <button class="btn btn-primary font-weight-semibold btn-h-2 rounded h-100" type="submit">{{ __('site.subscribe') }}</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer id="footer" class="footer-hover-links-light" data-plugin-image-background data-plugin-options="{'imageUrl': '/footerback.jpg', 'bgPosition': 'center 100%'}">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 text-center text-lg-start mb-5 mb-lg-0">
                <a href="{{ route('home') }}">
                    <img alt="{{ config('app.name') }}" src="/logo.jpg" class="img-fluid" style="mix-blend-mode: multiply;">
                </a>
                <p class=" text-white">WESTERPARK STUDIO, Amsterdam'da birçok olasılığa sahip, yenilenmiş ve kapsamlı bir arabalı film ve fotoğraf stüdyosudur.</p>

                <p class=" text-white"> Üretim de her şey dahil hizmetlerimizin bir parçası haline geldi. Stüdyo alanını kiralamak, ışık ve ekipman kiralamak, ayrıca set ve ekip teslimatı yapmak mümkündür.</p>
            </div>

            <div class="col-lg-3 text-center text-lg-start mb-5 mb-lg-0">
                <h4 class="font-weight-bold text-4-5 pb-1 mb-3">Get In Touch</h4>
                <ul class="list list-unstyled">
                    <li class="text-color-light pb-1 mb-2">
                        <span class="d-block font-weight-semibold line-height-1 text-color-grey">ADDRESS</span> Zeebergweg 2
                        1051DE Amsterdam / The Netherlands
                    </li>
                    <li class="text-color-light pb-1 mb-2">
                        <span class="d-block font-weight-semibold line-height-1 text-color-grey">PHONE</span>
                        <a href="tel:+31 (0)6 3402 6844" class="link-color-light">+31 (0)6 3402 6844</a>
                    </li>
                    <li class="text-color-light pb-1 mb-2">
                        <span class="d-block font-weight-semibold line-height-1 text-color-grey">
                            EMAIL</span> <a href="mailto:info@westerparkstudio.nl" class="link-color-light">info@westerparkstudio.nl</a>
                    </li>
                    <li class="text-color-light pb-1 mb-2">
                        <span class="d-block font-weight-semibold line-height-1 text-color-grey">
                            WORKING DAYS/HOURS</span> Mon - Sun / 9:00AM - 8:00PM
                    </li>
                    <li class="text-color-light pb-1 mb-2">
                        <span class="d-block font-weight-semibold line-height-1 text-color-grey">
                            KVK</span> 719.228.06
                    </li>
                    <li class="text-color-light pb-1 mb-2">
                        <span class="d-block font-weight-semibold line-height-1 text-color-grey">
                            BTW</span> NL.8589.04.986.B01
                    </li>
                    <li class="text-color-light pb-1 mb-2"><span class="d-block font-weight-semibold line-height-1 text-color-grey">
                            BANK</span> NL89ABNA0474406849
                    </li>

                </ul>

                <ul class="list list-unstyled mb-3">
                    <li>
                        <a href="{{ route('home') }}" title="About Us" class="text-white">
                            <i class="fas fa-angle-right text-color-light ms-1 me-1 pe-2"></i> About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('brands') }}" title="About Us" class="text-white">
                            <i class="fas fa-angle-right text-color-light ms-1 me-1 pe-2"></i> Brands
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contactus') }}" title="About Us" class="text-white">
                            <i class="fas fa-angle-right text-color-light ms-1 me-1 pe-2"></i> Contact Us
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 text-center text-lg-start mb-5 mb-lg-0">
                @foreach($servicecategories->whereNotIn('id', 5 ) as $item)

                <h4 class="font-weight-bold text-4-5 pb-1 mb-1">{{ $item->title }}</h4>
                <ul class="list list-unstyled mb-3">
                    @foreach($services->where('category', $item->id) as $row)
                    <li>
                        <a href="{{ route('studio.detail', $row->slug) }}" title="{{ $row->title }}" class="text-white">
                            <i class="fas fa-angle-right text-color-light ms-1 me-1 pe-2"></i> {{ $row->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endforeach
            </div>

            <div class="col-lg-3 text-center text-lg-start mb-5 mb-lg-0">
                <h4 class="font-weight-bold text-4-5 pb-1 mb-3 text-color-light">Apparatuur Verhuur</h4>
                <ul class="list list-unstyled mb-0">
                    @foreach($categories as $item)
                    <li>
                        <a href="{{ route('rentals', $item->slug) }}" title="{{ $item->title }}" class="text-white">
                            <i class="fas fa-angle-right text-color-light ms-1 me-1 pe-2"></i>{{ $item->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row text-center text-md-start align-items-center">
                <div class="col-md-6 col-lg-6">
                    <ul class="social-icons social-icons-transparent social-icons-icon-light social-icons-lg">
                        <li class="social-icons-facebook">
                            <a href="https://www.facebook.com/p/Westerpark-Studio-100064032037856/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="social-icons-instagram">
                            <a href="https://www.instagram.com/westerparkstudio/" target="_blank" title="Instragram"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-6">
                    <p class="text-md-end pb-0 mb-0 text-1 text-white">{{ config('app.name') }} © {{ date('Y') }}. {{__('site.footer.allrights')}}</p>
                </div>
            </div>
        </div>
    </div>
</footer>
