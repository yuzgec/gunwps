<div class="header-top header-top header-top-colored bg-primary">
    <div class="header-top-container container container-fluid">
        <div class="header-row">
            <div class="header-column justify-content-start">
                <span class="d-none d-sm-flex align-items-center">
                    <i class="lnr lnr-map-marker me-1"></i>
                    Amsterdam
                </span>
                <span class="d-none d-sm-flex align-items-center" style="margin-left:15px">
                    <i class="lnr lnr-phone me-2"></i>
                    +31 (0)6 3402 6844
                </span>
            </div>
            <div class="header-column justify-content-end">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{ __('site.about') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link dropdown-menu-toggle py-2 text-uppercase" id="dropdownLanguage"
                           data-bs-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="true">
                            {{ config('app.locale') }}	<i class="fas fa-angle-down fa-sm"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownLanguage">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="text-white no-skin"
                                       rel="alternate"
                                       hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, '/', [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="header-top-social-icons social-icons social-icons-transparent d-none d-md-block">
                    <li class="social-icons-facebook">
                        <a href="https://www.facebook.com/p/Westerpark-Studio-100064032037856/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="social-icons-instagram">
                        <a href="https://www.instagram.com/westerparkstudio/" target="_blank" title="Instragram"><i class="fab fa-instagram"></i></a>
                    </li>
                </ul>
                <a href="https://www.cinegear.nl" target="_blank" class="btn btn-light btn-3 font-weight-bold text-1 rounded-0 ms-3 text-dark gap-1">
                    <i class="lnr lnr-camera text-dark font-weight-semibold "></i> cinegear.nl
                </a>
            </div>
        </div>
    </div>
</div>
