@extends('frontend.layout.rental.app')
@section('content')
    <section class="page-header mb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h1 class="font-weight-bold">Brands</h1>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Brands</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container container-fluid mt-5">
        <div class="row">


                @foreach($all as $item)
                <div class="col-sm-6 col-md-3 col-lg-1-5 p-3 mb-5">
                    <div class="portfolio-item hover-effect-3d text-center">
                        <a href="{{ route('brand', $item->slug) }}" title="{{ $item->title }}">
                            <span class="image-frame image-frame-style-1 image-frame-effect-1 mb-3">
                                <span class="image-frame-wrapper">
                                    <img src="{{ $item->getFirstMediaUrl('page', 'thumb') }}" class="img-fluid" alt="{{ $item->title }} Verhuur Amsterdam">
                                    <span class="image-frame-inner-border"></span>
                                    <span class="image-frame-action image-frame-action-effect-1 image-frame-action-sm">
                                        <span class="image-frame-action-icon">
                                            <i class="lnr lnr-link text-color-light"></i>
                                        </span>
                                    </span>
                                </span>
                            </span>
                        </a>
                        <h2 class="font-weight-bold line-height-2 text-2 mb-0">
                            <a href="{{ route('brand', $item->slug) }}" title="{{ $item->title }}" class="link-color-dark">{{ $item->title }}</a>
                        </h2>
                        <span class="text-uppercase text-0">({{ $item->get_product_count }}) Products</span>
                    </div>
                </div>
                @endforeach

        </div>

    </div>
@endsection
