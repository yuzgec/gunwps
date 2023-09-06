@extends('frontend.layout.app')
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('rental') }}">{{ __('site.home') }}</a></li>
                        <li class="active">F.A.Q</li>
                    </ul>
                    <h1 class="font-weight-bold">Frequently Asked Questions</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="start" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 mb-5 mb-md-0 appear-animation" data-appear-animation="fadeInRightShorter">
                    <div id="toggleDefault" class="accordion accordion-light accordion-default accordion-toggle p-5" role="tablist">
                        @foreach($all as $item)
                        <div class="card">
                            <div class="card-header accordion-header" role="tab" id="toggleDefault{{ $item->id }}">
                                <h5 class="mb-0">
                                    <a href="#"  data-bs-toggle="collapse" data-bs-target="#toggleDefaultCollapse{{ $item->id }}"
                                       aria-expanded="false" aria-controls="toggleDefaultCollapse{{ $item->id }}">
                                       {{$item->title}}
                                    </a>
                                </h5>
                            </div>
                            <div id="toggleDefaultCollapse{{ $item->id }}" class="collapse {{ ($loop->first) ? 'show' :  null }} " role="tabpanel" aria-labelledby="toggleDefault{{ $item->id }}">
                                <div class="card-body">
                                   {!! $item->desc !!}
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
