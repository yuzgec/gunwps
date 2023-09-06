@extends('frontend.layout.app')
@section('content')

    <section class="page-header">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('rental') }}">{{ __('site.home') }}</a></li>
                        <li class="active">{{ __('site.fotogallery') }}</li>
                    </ul>
                    <h1 class="font-weight-bold">{{ __('site.fotogallery') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row mb-3 mt-4">
            @foreach($all as $item)
                <div class="col-md-4 text-center mb-2">
                    <a href="{{ route('gallery.detail', $item->slug) }}">
                        <div class="image-frame image-frame-border image-frame-style-1 image-frame-effect-2 image-frame-effect-1 overlay overlay-op-4 overlay-show">
                            <div class="image-frame-wrapper image-frame-wrapper-overlay-bottom image-frame-wrapper-overlay-bottom-show image-frame-wrapper-overlay-bottom-shadow image-frame-wrapper-overlay-bottom-shadow-light image-frame-wrapper-align-end">
                                <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}" class="img-fluid" alt="">
                                <div class="image-frame-action flex-column align-items-center">
                                    <h4 class="text-color-light font-weight-bold mb-0">{{ $item->title }} <small>({{ $item->get_gallery_count }})</small> </h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
