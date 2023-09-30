<div>
    <div class="mini-cart order-4 me-3 me-sm-0 d-none d-sm-block ">
        <div class="d-flex">

            <span class="font-weight-bold font-primary d-none d-sm-block">
                <a href="{{ route('cart') }}">
                    <span class="cart-total">
                        € {{ Cart::instance('shopping')->priceTotal()}}
                    </span>
               </a>
            </span>
            <div class="mini-cart-icon">
                <img src="/frontend/img/icons/cart-bag.svg" class="img-fluid " alt="WesterPark Studio Amsterdam" />
                <span class="badge badge-primary rounded-circle" style="margin-left:15px">{{ Cart::instance('shopping')->content()->count() }}</span>
            </div>

        </div>
    @if (Cart::instance('shopping')->content()->count() > 0)
        <div class="mini-cart-content">
            <div class="inner-wrapper bg-light rounded">
                <div class="mini-cart-product" style="overflow-y: scroll;overflow-x: hidden;height: 30vh">
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
                                    <img src="{{ $c->options->image }}" class="img-fluid rounded" alt="{{$c->name}}" style="width: 40px"/>
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
