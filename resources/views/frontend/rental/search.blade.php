@extends('frontend.layout.rental.app')
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{__('site.home')}}</a></li>
                        <li class="active">{{ $q }}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-5">Search results related to the word <span class="font-weight-bold">"{{ $q }}" </span></p>
                </div>
            </div>
        </div>
    </section>

    <div class="container container-fluid">
            <div class="row">
                <div class="col-md-12 mb-5 mb-md-0">
                    <div class="row">
                        @foreach($all as $item)
                           @foreach($item->getCategory->take(1) as $category)
                           @php
                                $show = \App\Models\ProductCategory::where('id', $category->category_id)->first();
                            @endphp
                            <div class="col-sm-6 col-md-4 mb-3">
                                <div style="border:1px solid #e3e3e3">
                                    <div class="mb-3">
                                        <span class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-light image-frame-wrapper-align-end">
                                            <a href="{{ route('product', [$show->slug, $item->slug]) }}" title="{{ $item->title }}">
                                                <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}" class="img-fluid" alt="{{ $item->title }}">
                                            </a>
                                        </span>
                                    </div>

                                    <h3 class="text-color-default text-3 line-height-1 d-flex align-items-center justify-content-center text-center" style="margin-left:8px;min-height: 35px">
                                        <a href="{{ route('product', [$show->slug, $item->slug]) }}" title="{{ $item->title }}">
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
                                        <div class="col-4 text-center" style="border:1px solid #e3e3e3">
                                            <img src="{{ $item->getBrand->getFirstMediaUrl('page') }}" alt="" class="img-fluid" style="width: 60px">
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
