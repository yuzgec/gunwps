<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 155, 'stickySetTop': '-185px'}">
    <div class="header-body">
        @include('frontend.layout.topbar')
        <div class="header-container container">
            <div class="header-row justify-content-between">

                <div class="header-column">
                    <div class="header-logo">
                        <a href="{{ route('home') }}">
                            <img alt="{{ config('app.name') }}" width="200px" src="/logo.jpg">
                        </a>
                    </div>



                </div>

                <div class="header-column justify-content-end">

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
                    <form class="search-form d-none d-md-block" action="{{ route('search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="q" placeholder="Search..." aria-label="Search...">
                            <span class="input-group-btn">
                                <button class="btn" type="submit"><i class="lnr lnr-magnifier"></i></button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="header-column justify-content-end">
                    <a href="{{ route('login') }}" class="btn btn-link text-color-default font-weight-bold order-3 ms-md-auto me-2 pt-1 text-1">
                        <i class="lnr lnr-user font-weight-semibold mt-1"></i> Login
                    </a>
                </div>
            </div>

            @include('frontend.layout.rental.menu')
        </div>
    </div>
</header>
