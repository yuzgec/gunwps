@extends('frontend.layout.rental.app')
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('rental') }}">{{ __('site.home') }}</a></li>
                        <li class="active">{{ __('site.equipment') }}</li>
                    </ul>
                    <h1 class="font-weight-bold">{{ __('site.equipment') }}</h1>
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
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#toggleCategories" aria-expanded="false" aria-controls="toggleCategories">
                                    {{ __('site.categories') }}
                                </a>
                            </h5>
                        </div>
                        <div id="toggleCategories" class="accordion-body collapse show p-0" role="tabpanel" aria-labelledby="categories">
                            <div class="card-body">
                                <ul class="list list-unstyled list-borders">
                                    @foreach($categories as $item)
                                    <li>
                                        <a href="{{ route('rentals', $item->slug) }}" title="{{ $item->title }}">
                                            <i class="fas fa-angle-right text-color-primary ms-1 me-1 pe-2"></i>
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="col-md-8 col-lg-9 order-1 order-md-2 mb-5 mb-md-0">
                <div class="row">
                    @foreach($categories as $item)
                    <div class="col-sm-6 col-md-4 col-6 mb-4">
                        <div class="image-frame image-frame-border image-frame-style-1 image-frame-effect-2 image-frame-effect-1 overlay overlay-op-1 overlay-show">
                            <div class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-bottom-show image-frame-wrapper-overlay-bottom-shadow image-frame-wrapper-overlay-bottom-shadow-light image-frame-wrapper-align-end">
                                <a href="{{ route('rentals', $item->slug) }}"
                                   title="{{ $item->title }}"
                                   >
                                <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}"
                                     class="img-fluid"
                                     alt="{{ $item->title }} - Wester Park Studio Amsterdam">
                                </a>
                                    <div class="image-frame-action flex-column align-items-center">
                                    <h4 class="text-color-light font-weight-bold mb-0 bg-dark p-1 rounded">
                                        <a href="{{ route('rentals', $item->slug) }}"
                                           title="{{ $item->title }}"
                                           class="text-color-light">
                                            {{ $item->title }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr class="mt-5 mb-4">
            </div>
        </div>

        <div class="row pb-2 mb-2 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
            <div class="col">
                <div class="owl-carousel owl-theme nav-style-3 nav-arrows-thin nav-color-dark" data-plugin-options="{'responsive': {'0': {'items': 2}, '575': {'items': 2}, '767': {'items': 3}, '991': {'items': 6}, '1199': {'items': 8}}, 'loop': true, 'autoplay': false, 'nav': true, 'dots': false, 'margin': 20, 'autoplayHoverPause': true, 'autoHeight': true}">
                    @foreach($brand as $item)
                        <div>
                            <a href="{{ route('brand', $item->slug) }}" title="{{ $item->title }}">
                                <div class="d-flex flex-column align-items-center justify-content-center bg-dark">
                                    <img src="{{ $item->getFirstMediaUrl('page', 'thumb') }}">
                                    {{--  <h4 class="font-alternative text-color-light font-weight-bold text-4 mt-2">{{ $item->title }}</h4>
                                      <span class="text-white text-0">({{ $item->get_product_count }}) Products</span>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>



@endsection
