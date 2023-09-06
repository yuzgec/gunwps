@extends('frontend.layout.app')
@section('content')





    <section class="page-header mb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-start">
                    <span class="tob-sub-title text-color-primary d-block">{{ $show->title }}</span>
                    <h1 class="font-weight-bold">{{ $all->title }}</h1>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb justify-content-start justify-content-md-end mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('foto') }}">Foto Gallery</a></li>
                        <li><a href="{{ route('gallery.detail', $show->slug) }}">{{ $show->title }}</a></li>
                        <li class="active">{{ $all->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="lightbox" data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}}">
                    <div class="row">
                        @foreach($all->getMedia('gallery') as $item)
                        <div class="col-md-3 mb-3 ">
                            <a href="{{ $item->getUrl('img') }}">
                                <img class="img-fluid" src="{{ $item->getUrl('thumb') }}" alt="{{ $show->title.' - '.$all->title.' - Wester Park Studio Amsterdam'}}">
                            </a>
                        </div>
                        @endforeach

                        <div class="col-md-12">
                            {!!  $all->desc !!}
                        </div>
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
        })
    </script>
@endsection
