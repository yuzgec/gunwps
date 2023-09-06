@extends('frontend.layout.app')

@section('content')


    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('rental') }}">{{ __('site.home') }}</a></li>
                        <li class="active">{{ __('site.services') }}</li>
                        <li class="active">{{ $show->title }}</li>
                    </ul>
                    <h1 class="font-weight-bold">{{ $show->title }}</h1>
                </div>
            </div>
        </div>
    </section>


    <div class="container container-fluid mt-3">
        <div class="row">
            <div class="col-md-3 order-2 order-md-1">
                <ul class="list list-unstyled list-borders">
                    @foreach($services->where('category',$show->category ) as $item)
                        <li class="mb-2 active"><i class="fas fa-angle-right text-color-primary ms-1 me-1 pe-2"></i>
                            <a href="{{  route('studio.detail', $item->slug )}}" class="">{{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>

                <h2 class="font-weight-bold text-3 mb-3">Quik Contact</h2>
                <form class="contact-form form-style-2" action="{{ route('contact') }}" method="POST">
                    <input type="hidden" value="{{ $show->title }}" name="service">
                    <input type="hidden" value="{{ config('app.locale') }}" name="lang">
                    @csrf
                    <div class="form-row row">
                        <div class="form-group col-md-12  mb-1">
                            <input type="text" value="{{ old('name') }}" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" placeholder="Name">
                            @if($errors->has('name'))
                                <div class="invalid-feedback">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-12  mb-1">
                            <input type="email" value="{{ old('email') }}" class="form-control @if($errors->has('email')) is-invalid @endif"  name="email" placeholder="E-mail">
                            @if($errors->has('email'))
                                <div class="invalid-feedback">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row row">
                        <div class="form-group col-md-12  mb-1">
                            <input type="text" value="{{ old('phone') }}" class="form-control @if($errors->has('phone')) is-invalid @endif"  name="phone" placeholder="Phone">
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                            @endif
                        </div>
                        <div class="form-group col-md-12  mb-1">
                            <input type="text" value="" class="form-control" name="subject" placeholder="Subject">
                        </div>
                    </div>
                    <div class="form-row row mb-3">
                        <div class="form-group col-12">
                            <textarea rows="5" class="form-control" name="message" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="form-row row mb-3 mt-2">
                        <div class="col">
                            <input type="submit" value="SEND MESSAGE" class="btn btn-primary btn-rounded btn-4 font-weight-semibold text-0">
                        </div>
                    </div>
                </form>
                <img src="/lichtbus-huren-westerpark.jpg" class="img-fluid" >
            </div>
            <div class="col-md-9 order-1 order-md-2">
                @if($show->getFirstMediaUrl('page'))
                    <img src="{{ $show->getFirstMediaUrl('page') }}" class="img-fluid mb-3" alt="{{ $show->title }} - Westerpark Studio Amsterdam" style="width: 100%">
                @endif

                {!! $show->desc !!}
                <div class="lightbox mt-3" data-plugin-options="{'delegate': 'a', 'type': 'image', 'gallery': {'enabled': true}}">
                    <div class="row">
                        @foreach($show->getMedia('gallery') as $item)
                            <div class="col-md-3 mb-3 ">
                                <a href="{{ $item->getUrl('img') }}">
                                    <img class="img-fluid"
                                         src="{{ $item->getUrl('thumb') }}"
                                         alt="{{ $show->title.' - Wester Park Studio Amsterdam'}}"
                                    >
                                </a>
                            </div>
                        @endforeach
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
