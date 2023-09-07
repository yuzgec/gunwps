@extends('frontend.layout.app')
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('rental') }}">{{ __('site.home') }}</a></li>
                        <li class="active">{{ __('site.studio') }}</li>
                    </ul>
                    <h1 class="font-weight-bold">{{ __('site.studio') }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container container-fluid mt-3">
        <div class="row">
            <div class="col-md-3">
                <ul class="list list-unstyled list-borders">
                    @foreach($services->where('category',3 ) as $item)
                        <li class="mb-2 active"><i class="fas fa-angle-right text-color-primary ms-1 me-1 pe-2"></i>
                            <a href="{{  route('studio.detail', $item->slug )}}" class="">{{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>
                <img src="/lichtbus-huren-westerpark.jpg" class="img-fluid" >
            </div>
            <div class="col-md-9">
                <div class="row">


                    @if($show->getFirstMediaUrl('page'))
                        <img src="{{ $show->getFirstMediaUrl('page') }}" class="img-fluid mb-3" alt="{{ $show->title }} - Westerpark Studio Amsterdam" style="width: 100%">
                    @endif

                    <div class="mb-4">
                        {!! $show->desc !!}
                    </div>


                    @foreach($all->where('category',  3) as $item)
                        <div class="col-sm-6 col-lg-4 bg-white mb-4">
                            <a href="{{  route('studio.detail', $item->slug )}}">

                            <div class="image-frame overlay overlay-show overlay-op-1 image-frame-style-1 image-frame-effect-1 image-frame-style-5 mt-2">
                                <div class="image-frame-wrapper">
                                    <img src="/studio-limbo-amsterdam.jpg" class="img-fluid" alt="ASMTERDAM STUDIO VERHUUR">
                                </div>
                            </div>
                            <h4 class="font-weight-bold text-uppercase m-0 p-0 text-center mt-2">{{ $item->title }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
