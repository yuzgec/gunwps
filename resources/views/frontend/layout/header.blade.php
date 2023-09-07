<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 155, 'stickySetTop': '-185px'}">
    <div class="header-body">
        @include('frontend.layout.topbar')
        <div class="header-container container">
            <div class="header-row"> <a href="{{ route('home') }}">
                    <div class="header-column justify-content-start d-none d-md-flex">
                        <a href="{{ route('home') }}">
                            <img alt="{{ config('app.name') }}" src="/blank.jpg" title="{{ config('app.name') }}">
                        </a>
                    </div>
                </a>
                <div class="header-column justify-content-start d-none d-md-flex">
                 {{--   <form class="search-form d-none d-md-block" method="GET">
                        <div class="input-group">
                            <input type="text" name="s" placeholder="Search..." aria-label="Search..." value="">
                            <span class="input-group-btn">
                                <button class="btn" type="submit"><i class="lnr lnr-magnifier"></i></button>
                            </span>
                        </div>
                    </form>--}}
                </div>
                <div class="header-column justify-content-md-center d-none d-md-flex">
                  {{--  <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img alt="{{ config('app.name') }}" src="/logo.jpg">
                        </a>
                    </div>--}}
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img alt="Amsterdam Westerpark Studio" src="/logo.jpg" width="250px">
                        </a>
                    </div>

                    <button class="header-btn-collapse-nav ms-3" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                        <span class="hamburguer">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                                    <span class="close">
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
            @include('frontend.layout.menu')
        </div>
    </div>
</header>
