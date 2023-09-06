@extends('frontend.layout.rental.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{ __('site.home') }}</a></li>
                        <li><a href="{{ route('rental') }}">{{ __('site.rental') }}</a></li>
                        <li><a href="{{ route('rentals', $c->slug) }}">{{ $c->title }}</a></li>
                        <li class="active">{{ $product->title }}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="font-weight-bold">{{ $product->title }} Verhuur</h1>
                    <p>Wester Park Studio Amsterdam   <stron>{{ __('site.equipment') }}</stron></p>

                    @if(auth()->user())
                        <a href="{{ route('product.edit', $product->id) }}">Ürün Düzenle</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container container-fluid">

        <div class="row">
            <aside class="sidebar col-md-4 col-lg-3 order-2 order-md-1">
                <div class="accordion accordion-default accordion-toggle accordion-style-1" role="tablist">

                    <div class="card">
                        <div class="card-header accordion-header" role="tab" id="categories">
                            <h5 class="mb-0">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#toggleCategories" aria-expanded="false" aria-controls="toggleCategories">Categories</a>
                            </h5>
                        </div>
                        <div id="toggleCategories" class="accordion-body collapse show p-0" role="tabpanel" aria-labelledby="categories">
                            <div class="card-body">
                                <ul class="list list-unstyled list-borders">
                                    @foreach($categories as $item)
                                        <li class="{{ ($item->id == $c->id) ? 'bg-dark-2' : null }}">
                                            <a href="{{ route('rentals', $item->slug) }}" title="{{ $item->title }}"
                                               class="{{ ($item->id == $c->id) ? 'font-weight-semibold text-white' : null }}">
                                                <i class="fas fa-angle-right {{ ($item->id == $c->id) ? 'text-white' : 'text-color-primary' }}  ms-1 me-1 pe-2"></i>
                                                {{ $item->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <img src="/lichtbus-huren-westerpark.jpg" class="img-fluid" title="Amsterdam Lichtbus Huren">
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="col-md-8 col-lg-9 mb-5 mb-md-0 order-1 order-md-2">
                <div class="row mb-5">
                    <div class="col-lg-6 mb-5 mb-lg-0">
                        <span><a onclick="history.back()"><i class="icon-arrow-left-circle icon"></i> Go Back</a></span>
                        <div class="thumb-gallery-wrapper">
                            <div class="thumb-gallery-detail owl-carousel owl-theme manual dots-style-2 nav-style-2 nav-color-dark mb-3">
                                <div>
                                    <img src="{{ (!$product->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $product->getFirstMediaUrl('page')}}"
                                         class="img-fluid" alt="{{ $product->title }}">
                                </div>
                                @foreach($product->getMedia('gallery') as $item)
                                <div>
                                    <img src="{{ $item->getUrl('img') }}"
                                         class="img-fluid" alt="{{ $product->title }}">
                                </div>
                                @endforeach
                            </div>
                            <div class="thumb-gallery-thumbs owl-carousel owl-theme manual thumb-gallery-thumbs">
                                <div>
                                    <span class="d-block">
                                        <img alt="{{ $product->title }} - {{ __('site.equipment') }}"
                                             src="{{ (!$product->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $product->getFirstMediaUrl('page', 'thumb')}}"
                                             class="img-fluid">
                                    </span>
                                </div>
                                @foreach($product->getMedia('gallery') as $item)
                                <div>
                                    <span class="d-block">
                                        <img alt="{{ $product->title }} - {{ __('site.equipment') }}" src="{{ $item->getUrl('thumb') }}" class="img-fluid">
                                    </span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if (session('added'))
                            <div class="alert alertt alert-success text-white">
                               <h5> <img src="/cart-bag.svg" class="img-fluid" alt="{{ $product->title }}"> {!! session('added') !!}</h5>
                                <p><a href="{{ route('cart') }}" title="{{__('site.productpage.gotowishlist')}}"><i class="lnr lnr-arrow-right-circle"></i> {{__('site.productpage.gotowishlist')}}</a></p>
                            </div>
                        @endif
                        <h2 class="line-height-1 font-weight-bold mb-2">
                            {{ $product->title }}
                        </h2>
                        @if(cartControl($product->id) == true)
                        <span class="text-dark"><b>{{ cartControlqty($product->id) }}X </b>{{ (cartControl($product->id) == true) ? 'You have the product in your cart' : null }}</span>
                        @endif
                        <div class="{{ (cartControl($product->id) == true) ? 'bg-success' : 'bg-primary' }}" style="border-radius: 10px">
                             <div class="row d-flex justify-content-between align-items-center p-3">
                                 <div class="col-12 col-md-4 text-center" style="border-right:1px solid gray">
                                     <span class="font-weight-bold text-white text-4">First Day</span><br>
                                     <span class="font-weight-bold text-white text-3">€ {{ (request('extvat') == 1) ? $product->price * 1.21 : $product->price}}</span>
                                 </div>
                                 <div class="col-12 col-md-4 text-center">
                                     <span class="font-weight-bold text-white text-4">Next Day</span><br>
                                     <span class="font-weight-bold text-white text-3">€ {{ (request('extvat') == 1) ? round($product->price * 1.21) / 2 : $product->price / 2}}</span>
                                 </div>
                                 <div class="col-12 col-md-4 p-1 text-center">
                                     <form action="{{ route('addtocart', [$product->slug, $c->slug]) }}" method="POST">
                                     @csrf
                                     <input type="hidden" name="id" value="{{ $product->id }}">
                                     <button type="submit" class="btn btn-rounded btn-outline btn-with-arrow btn-light mb-1">
                                         Add to Cart <br>
                                         <span><i class="fas fa-chevron-right"></i></span>
                                     </button>
                                     </form>
                                     <a class="btn btn-link text-white"
                                        href="{{ (request('extvat') == 1) ? url()->current() : url()->current().'?extvat=1' }}">
                                         {{ (request('extvat') == 1) ? 'Include VAT' : 'Excluding VAT'  }}
                                     </a>
                                 </div>
                             </div>
                        </div>

                        <div id="short" class="mt-3">{!! $product->short  !!}</div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-12 col-md-6 d-flex justify-content-center flex-column">
                                <ul class="list list-unstyled ">
                                    @if($product->status == 1)
                                        <li>{{ __('site.productpage.availability') }}: <strong><span class="badge bg-success">{{ __('site.productpage.available') }}</span></strong></li>
                                    @else
                                        <li>{{ __('site.productpage.availability') }}: <strong><span class="badge bg-danger">{{ __('site.productpage.notavailable') }}</span></strong></li>
                                    @endif
                                    @if($product->sku)
                                    <li>SKU: <strong>{{ $product->sku }}</strong></li>
                                    @endif
                                    <li>{{ __('site.productpage.brand') }} : <strong> {{ $product->getBrand->title }}</strong></li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-center">
                                <a href="{{ route('brand', $product->getBrand->slug) }}" title="{{ $product->getBrand->title }}">
                                    <img src="{{ $product->getBrand->getFirstMediaUrl('page') }}" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        <hr class="my-2">
                        @if($product->external)
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <a href="https://www.cinegear.nl">
                                    <img src="https://cinegear.nl/wp-content/uploads/2023/03/Transparent_Normal_Logo.png" class="img-fluid">
                                </a>
                                <br>If you want, you can buy this product on <a href="https://www.cinegear.nl">cinegear.nl</a>
                            </div>
                        </div>
                        <hr class="my-4">
                        @endif
                        <div class="d-flex align-items-center">
                            <span class="text-2">{{ __('site.productpage.share') }}</span>
                            <ul class="social-icons social-icons-dark social-icons-1 ms-3">
                                <li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                <li class="social-icons-instagram"><a href="http://www.instagram.com/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        <ul class="nav nav-tabs nav-tabs-default" id="productDetailTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold active text-uppercase"
                                   id="productDetailDescTab"
                                   data-bs-toggle="tab"
                                   href="#productDetailDesc"
                                   role="tab"
                                   aria-controls="productDetailDesc"
                                   aria-expanded="true">{{ __('site.productpage.desc') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-uppercase"
                                   id="productDetailReviewsTab"
                                   data-bs-toggle="tab"
                                   href="#productDetailReviews"
                                   role="tab"
                                   aria-controls="productDetailReviews">{{ __('site.productpage.technical') }}</a>
                            </li>
                            @if($product->option3 )
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold text-uppercase"
                                   id="productDetailMoreInfoTab"
                                   data-bs-toggle="tab"
                                   href="#productDetailMoreInfo"
                                   role="tab"
                                   aria-controls="productDetailMoreInfo">{{ __('site.productpage.video') }}
                                </a>
                            </li>
                            @endif

                        </ul>
                        <div class="tab-content" id="contentTabProductDetail">
                            <div class="tab-pane fade pt-4 pb-4 show active" id="productDetailDesc" role="tabpanel" aria-labelledby="productDetailDescTab">
                                {!! $product->desc !!}
                            </div>

                            <div class="tab-pane fade pt-4 pb-4" id="productDetailMoreInfo" role="tabpanel" aria-labelledby="productDetailMoreInfoTab">
                                <iframe width="100%" height="550" src="https://www.youtube.com/embed/{{ $product->option3 }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            </div>

                            <div class="tab-pane fade pt-4 pb-4" id="productDetailReviews" role="tabpanel" aria-labelledby="productDetailReviewsTab">
                                {!! $product->note !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection


@section('customJS')
    <script src="/frontend/js/examples/examples.gallery.js"></script>
    <script>
        $(document).ready(function() {

            $("table").addClass("table table-hover table-striped table-bordered table-responsive");
            $("img").addClass('img-fluid');
            $("#short > ul").addClass('list list-group');
            $("#short > ul > li ").addClass('list-group-item');

            setInterval(function(){ $(".alertt").fadeOut(); }, 6000);
        })

    </script>
@endsection
