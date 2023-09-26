<div class="header-row ">
    <div class="header-column justify-content-start ">
        <div class="header-nav header-nav-border-top header-nav-light-dropdown header-nav-top-line justify-content-start">
            <div class="header-nav-main header-nav-main-uppercase header-nav-main-effect-1 header-nav-main-sub-effect-1">
                <nav class="collapse">
                    <ul class="nav flex-column flex-lg-row" id="mainNav">
                        <li class="order-1 dropdown dropdown-mega">
                            <a class="dropdown-item dropdown-toggle " href="{{ route('home') }}">
                                {{ __('site.home') }}
                            </a>
                        </li>
                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle" href="{{ route('studio') }}">
                                {{ __('site.studio') }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($services->where('category', 3) as $item)
                                    <li>
                                        <a href="{{  route('studio.detail', $item->slug )}}">{{ $item->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle active" href="{{ route('rental') }}">
                                {{ __('site.equipment') }}
                            </a>
                        </li>

                        @foreach($services->where('category',5 ) as $item)
                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle" href="{{  route('studio.detail', $item->slug )}}">
                                {{ $item->title }}
                            </a>
                        </li>
                        @endforeach

                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle" href="{{ route('services') }}">
                                {{ __('site.services') }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($services->where('category',4 ) as $item)
                                    <li>
                                        <a href="{{  route('studio.detail', $item->slug )}}">{{ $item->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle" href="#">
                                Gallery
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('video') }}">Video's Gallery</a>
                                </li>
                                <li>
                                    <a href="{{ route('foto') }}">Foto Gallery</a>
                                </li>
                                <li>
                                    <a href="{{ route('project') }}">Project</a>
                                </li>
                            </ul>
                        </li>

                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle" href="{{ route('faq') }}">
                                F.A.Q
                            </a>
                        </li>

                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle" href="#">
                                Kinefinity
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($services->where('category',6 ) as $item)
                                    <li>
                                        <a href="{{  route('studio.detail', $item->slug )}}">{{ $item->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="order-3 dropdown">
                            <a class="dropdown-item dropdown-toggle" href="{{ route('contactus') }}">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="header-column justify-content-end d-none d-sm-block">
</div>
    <div class="mini-cart order-4 me-3 me-sm-0 d-none d-sm-block ">
        <div class="d-flex">
            <span class="font-weight-bold font-primary d-none d-sm-block">
                <span class="cart-total">
                    € {{ Cart::instance('shopping')->priceTotal()}}
                </span>
            </span>
            <div class="mini-cart-icon">
                <img src="/frontend/img/icons/cart-bag.svg" class="img-fluid " alt="WesterPark Studio Amsterdam" />
                <span class="badge badge-primary rounded-circle" style="margin-left:15px">{{ Cart::instance('shopping')->content()->count() }}</span>
            </div>
        </div>

        @if (Cart::instance('shopping')->content()->count() > 0)
            <div class="mini-cart-content">
                <div class="inner-wrapper bg-light rounded">
                    <div class="mini-cart-product">
                        @foreach(Cart::instance('shopping')->content() as $c)
                            <div class="row">
                                <div class="col-7">

                                    <h2 class="text-color-default font-secondary text-1 mt-3 mb-0">
                                        <a href="{{ route('product', [$c->options->category,$c->options->url]) }}" title="{{$c->name}}">
                                            {{$c->name}}
                                        </a>
                                    </h2>
                                    <strong class="text-color-dark">
                                        <span class="qty">{{$c->qty}}x</span>
                                        <span class="product-price">€{{$c->price}}</span>
                                        <span class="product-price">{{$c->options->brand}}</span>
                                    </strong>
                                </div>
                                <div class="col-5">
                                    <div class="product-image d-flex justify-content-center align-items-center">
                                        <img src="{{ $c->options->image }}" class="img-fluid rounded" alt="{{$c->name}}" style="width: 175px"/>
                                        <form id="form" method="post" action="{{route('deletecart',$c->rowId )}}">
                                            @csrf
                                            <a href="javascript:{}"
                                               onclick="document.getElementById('form').submit()"
                                               class="btn btn-light btn-rounded justify-content-center align-items-center">
                                                <i class="fas fa-times text-white bg-dark p-2 rounded"></i>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mini-cart-total">
                        <div class="row">
                            <div class="col">
                                <strong class="text-color-dark">SUBTOTAL:</strong>
                            </div>
                            <div class="col text-end">
                                <strong class="total-value text-color-dark">€{{ Cart::instance('shopping')->priceTotal()}} </strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong class="text-color-dark">TAX %21:</strong>
                            </div>
                            <div class="col text-end">
                                <strong class="total-value text-color-dark">€{{ Cart::instance('shopping')->tax()}} </strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong class="text-color-dark">TOTAL:</strong>
                            </div>
                            <div class="col text-end">
                                <strong class="total-value text-color-dark">€{{ Cart::instance('shopping')->total() }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="mini-cart-actions">
                        <div class="row">
                            {{--   <div class="col ps-1">
                                   <a href="{{ route('cart') }}" class="btn btn-primary font-weight-bold rounded text-0">BASKET</a>
                               </div>--}}
                            <div class="col ps-1">
                                <a href="{{ route('cart') }}" class="btn btn-primary font-weight-bold rounded text-0">{{ __('site.equipmentlist') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
</div>

