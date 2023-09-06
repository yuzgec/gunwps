@extends('frontend.layout.app')
@section('content')
    <section class="page-header mb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-start">
                    <span class="tob-sub-title text-color-primary d-block">Wester Park Studio</span>
                    <h1 class="font-weight-bold">{{ $show->title }}</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('foto') }}">Foto Gallery</a></li>
                        <li class="active">{{ $show->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row mb-3 mt-4">
            @foreach($all as $item)
            <div class="col-md-4 text-center mb-2">
                <a href="{{ route('foto.detail', [$show->slug,$item->slug]) }}">
                    <div class="image-frame image-frame-border image-frame-style-1 image-frame-effect-2 image-frame-effect-1 overlay overlay-op-4 overlay-show">
                        <div class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-bottom-show image-frame-wrapper-overlay-bottom-shadow image-frame-wrapper-overlay-bottom-shadow-light image-frame-wrapper-align-end">
                            <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}" class="img-fluid" alt="">
                            <div class="image-frame-action flex-column align-items-center">
                                <h4 class="text-color-light font-weight-bold mb-0">{{ $item->title }}</h4>
                                <p class="mb-0 text-color-light font-weight-light">({{ count($all) }}) images</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection
