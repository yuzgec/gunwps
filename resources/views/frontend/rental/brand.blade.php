@extends('frontend.layout.rental.app')
@section('content')
    <section class="page-header mb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start d-flex">
                    <h1 class="font-weight-bold">{{ $show->title }}</h1>
                    <img src="{{ $show->getFirstMediaUrl('page', 'small') }}" class="img-fluid " title="{{ $show->title }}" style="mix-blend-mode: multiply">
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active"><a href="{{ route('brands') }}">Brands</a></li>
                        <li class="active">{{ $show->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container container-fluid">
        <div class="row">
            <div class="col-md-12 mb-5 mt-5 mb-md-0">
                <div class="row">
                    @foreach($all as $item)
                        @foreach($item->getCategory->take(1) as $category)
                            @php
                                $show = \App\Models\ProductCategory::with('getProduct')->whereHas('translations', function ($query) use ($category) {
                                    $query->where('id', $category->category_id);
                                })->first();
                           //dd($show);
                            @endphp
                            <div class="col-sm-6 col-md-3 mb-3">
                                <div class=""  style="border:1px solid #e3e3e3">
                                    <div class="image-frame image-frame-style-1 image-frame-effect-1 mb-3">
                                        <span class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-light image-frame-wrapper-align-end">
                                            <a href="{{ route('product', [$show->slug, $item->slug]) }}" title="{{ $item->title }}">
                                                <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}" class="img-fluid" alt="">
                                            </a>
                                            <span class="image-frame-action">
                                                <a href="#" class="btn btn-primary btn-rounded font-weight-semibold btn-v-3 btn-fs-2">ADD WISHLIST</a>
                                            </span>
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

                                        <div class="col-4"  style="border:1px solid #e3e3e3">
                                            <span class="price font-primary text-2 font-weight-bold text-black-50">Next Days
                                            <br>€{{ $item->price / 2 }}</span>
                                        </div>
                                        <div class="col-4 text-center" style="border:1px solid #e3e3e3">
                                            <a href="{{ route('brand',$item->getBrand->slug) }}" title="{{ $item->title }} Verhuur Amsterdam">
                                                <img src="{{ $item->getBrand->getFirstMediaUrl('page') }}"
                                                     alt="{{ $item->title }} Verhuur Amsterdam"
                                                     class="img-fluid"
                                                     style="width: 55px"/>
                                            </a>
                                            <span class="badge bg-success" style="font-size:10px">Available</span>
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
