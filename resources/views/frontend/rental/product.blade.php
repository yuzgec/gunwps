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
                    <h1 class="font-weight-bold">{{ $product->title.' '.__('site.rental')  }} </h1>
                    <p>Westerpark Studio Amsterdam   <strong>{{ __('site.equipment') }}</strong></p>

                    @if(auth()->user() && auth()->user()->is_admin == 1)
                        <a href="{{ route('product.edit', $product->id) }}">Ürün Düzenle</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="container container-fluid">
        <div class="row">
            <aside class="sidebar col-md-3 order-2 order-md-1">

                    @if ($product->getRelated->where('name', 'included')->count() > 0)
                    <div class="mb-4">
                        <h5>{{ __('site.included') }}</h5>
                        @foreach($product->getRelated->where('name', 'included') as $item)
                            @php $p = \App\Models\Product::where('id', $item->related_id)->first() @endphp
                            <div style="border: 1px solid #e4e4e4;border-radius: 15px;overflow: hidden" class="mb-2">
                                <div class="row">
                                    <div class="col-md-4 col-3 bg-white d-flex justify-content-center">
                                        <div class="">
                                            <img src="{{ (!$p->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $p->getFirstMediaUrl('page', 'small')}}"
                                                 class="img-fluid" alt="{{ $p->title }}"  width="75px" height="75px">
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-9 bg-success d-flex align-items-center" style="border-left: 1px solid white;">
                                        <h5 class="text-white text-2">{{ $p->title }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                    @if(($product->getRelated->where('name', 'related')->count() > 0))
                    <div>
                        <h5>{{ __('site.related') }}</h5>
                        @foreach($product->getRelated->where('name', 'related') as $item)
                            @php $p = \App\Models\Product::with('categories')->where('id', $item->related_id)->first() @endphp
                            <div style="border: 1px solid black;border-radius: 15px;overflow: hidden" class="mb-2">
                                <div class="">
                                    <div class="row flex justify-content-center align-items-center">
                                        <div class="col-md-4 col-3 bg-white text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img src="{{ (!$p->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $p->getFirstMediaUrl('page', 'small')}}"
                                                     class="img-fluid" alt="{{ $p->title }}"  width="75px" height="75px">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-7">
                                            <div class="p-3">
                                                <h5><a href="{{ route('product', [$p->categories->slug, $p->slug]) }}"> {{ $p->title }}</a> </h5>
                                                <span>€{{ $p->price }} <del>${{ $p->price / 2 }}</del></span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-2 position-relative" style="right: 20px">
                                            <button class="btn btn-success p-1">
                                                <i class="fas fa-shopping-basket pt-1"></i>{{ (cartControl($p->id) == true) ? '('.cartControl($p->id).')' : null }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                     @endif

                <div class="accordion accordion-default accordion-toggle accordion-style-3 mb-2" role="tablist">

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
            <div class="col-md-9 mb-5 mb-md-0 order-1 order-md-2">
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
                                 <div class="col-6 col-md-4 text-center mb-1" style="border-right:1px solid gray">
                                     <span class="font-weight-bold text-white text-4">First Day</span><br>
                                     <span class="font-weight-bold text-white text-3">€ {{ (request('extvat') == 1) ? $product->price * 1.21 : $product->price}}</span>
                                 </div>
                                 <div class="col-6 col-md-4 mb-1 text-center">
                                     <span class="font-weight-bold text-white text-4">Next Day</span><br>
                                     <span class="font-weight-bold text-white text-3">€ {{ (request('extvat') == 1) ? round($product->price * 1.21) / 2 : $product->price / 2}}</span>
                                 </div>
                                 <div class="col-12 col-md-4 p-1 text-center">
                                     @if($product->status == 0 )
                                     <button class="btn btn-rounded btn-with-arrow btn-danger mb-1 disable text-1">
                                         {{ __('site.productpage.notavailable') }}<br>
                                     </button>
                                    @else
                                    {{--<livewire:add-cart :product="$product" :c="$c"/>--}}
                                     <form action="{{ route('addtocart', [$product->slug, $c->slug]) }}" method="POST">
                                     @csrf
                                     <input type="hidden" name="id" value="{{ $product->id }}">
                                     <button type="submit" class="btn btn-rounded btn-outline btn-with-arrow btn-light mb-1">
                                         Add {{ (cartControl($product->id) == true) ? '('.cartControl($product->id).')' : null }} <br>
                                         <span><i class="fas fa-chevron-right"></i></span>
                                     </button>
                                     </form>
                                     @endif
                                     <a class="btn btn-link text-white"
                                        href="{{ (request('extvat') == 1) ? url()->current() : url()->current().'?extvat=1' }}">
                                         {{ (request('extvat') == 1) ? 'Include VAT' : 'Excluding VAT'  }}
                                     </a>
                                 </div>
                             </div>
                        </div>

                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <a class="btn btn-dark btn-block" href="{{ route('contactus', 'product='.$product->title) }}" title="Quik Message">
                                        <i class="far fa-envelope"></i> Quik Message
                                    </a>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <a class="btn btn-secondary btn-block"
                                       target="_blank"
                                       href="https://api.whatsapp.com/send?phone=31634026844&text=Hello, I would like to get information about {{ $product->title }} product rental."
                                       title="Whatsapp Information"
                                    >
                                        <i class="fab fa-whatsapp"></i> Whatsapp Info
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
                                        <li>{{ __('site.productpage.notavailable') }}: <strong><span class="badge bg-danger">{{ __('site.productpage.notavailable') }}</span></strong></li>
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
                        @if($product->extarnal)
                        <div class="row">
                            <div class="col-12 col-md-3 d-flex align-items-center justify-content-center">
                                <a href="https://www.cinegear.nl">
                                    <img src="https://cinegear.nl/wp-content/uploads/2023/03/Transparent_Normal_Logo.png" class="img-fluid">
                                </a>
                            </div>
                            <div class="col-12 col-md-9 d-flex align-items-center justify-content-center">
                                If you want, you can buy this product on
                                <a class="btn btn-rounded btn-outline btn-with-arrow btn-dark mb-2" href="https://www.cinegear.nl">to product
                                    <span><i class="fas fa-chevron-right"></i></span>
                                </a>
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
