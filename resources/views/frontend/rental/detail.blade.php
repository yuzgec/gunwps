@extends('frontend.layout.rental.app')
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{ __('site.home') }}</a></li>
                        <li><a href="{{ route('rental') }}">{{ __('site.rental') }}</a></li>
                        <li class="active">{{ $show->title }}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="font-weight-bold">{{ $show->title }} - {{ __('site.rental') }}</h1>
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
                                        <li class="{{ ($item->id == $show->id) ? 'bg-dark-2' : null }}">
                                            <a href="{{ route('rentals', $item->slug) }}" title="{{ $item->title }}"
                                               class="{{ ($item->id == $show->id) ? 'font-weight-semibold text-white' : null }}">
                                                <i class="fas fa-angle-right {{ ($item->id == $show->id) ? 'text-white' : 'text-color-primary' }}  ms-1 me-1 pe-2"></i>
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
                    <span class="mb-2">({{ count($all) }}) products are listed</span>
                    @foreach($all as $item)
                        <div class="col-sm-6 col-md-4 mb-3">
                            <div style="{{ (cartControl($item->id) == true) ? 'border:1px solid green' : 'border:2px solid #e3e3e3' }}">
                                <div class=" mb-3">
                                    <span class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-light image-frame-wrapper-align-end">
                                        <a href="{{ route('product', [$show->slug, $item->slug]) }}"
                                           title="{{ $item->title }} Verhuur">
                                            <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}"

                                                 class="img-fluid" alt="{{ $item->title.' - '.__('site.equipment') }} ">
                                        </a>
                                    </span>
                                </div>

                                <h3 class="text-color-default text-3 line-height-2 d-flex align-items-center justify-content-center text-center"
                                    style="margin-left:8px;min-height: 35px">
                                    <a  href="{{ route('product', [$show->slug, $item->slug]) }}"
                                        title="{{ $item->title }}"
                                        >
                                        {{ $item->title }}
                                    </a>
                                </h3>

                                <div class="row d-flex align-items-center justify-content-center m-0" >
                                    <div class="col-4" style="border:1px solid #e3e3e3">
                                        <span class="price font-primary text-2 font-weight-bold text-black">First Day
                                        <br>€{{ $item->price }}</span>
                                    </div>

                                    <div class="col-4" style="border:1px solid #e3e3e3">
                                        <span class="price font-primary text-2 font-weight-bold text-black-50">Next Days
                                        <br>€{{ $item->price / 2 }}</span>
                                    </div>
                                    <div class="col-4 text-center " style="border:1px solid #e3e3e3;height: 46px">
                                        <a href="{{ route('brand',$item->getBrand->slug) }}" title="{{ $item->title }} Verhuur Amsterdam">
                                            <img src="{{ $item->getBrand->getFirstMediaUrl('page') }}"
                                                 alt="{{ $item->title }} Verhuur Amsterdam"
                                                 class="img-fluid"
                                                 style="width: 55px"/>
                                        </a>
                                        @if($item->status == 1)
                                            <span class="badge bg-success" style="font-size:10px;margin-top:-5px">{{ __('site.productpage.available') }}</span>
                                        @else
                                            <span class="badge bg-danger" style="font-size:10px;margin-top:-5px">{{ __('site.productpage.notavailable') }}</span>
                                        @endif
                                    </div>

                                </div>
                                <div class="product-info ">
                                    <div class="product-info-title">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr class="mt-5 mb-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mb-3 mb-sm-0">
                        <span>Showing ({{ count($all) }}) results</span>
                    </div>
                    <div class="col-auto">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('customJS')
    <script>
        $(document).ready(function() {
            $("table").addClass("table table-hover table-striped table-bordered table-responsive");
            $("img").addClass('img-fluid');
        })
    </script>
@endsection
