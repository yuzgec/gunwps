@extends('frontend.layout.app')
@section('content')

    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('rental') }}">{{ __('site.home') }}</a></li>
                        <li class="active">Contact Us</li>
                    </ul>
                    <h1 class="font-weight-bold">Contact Westerpark Studio</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">

            <div class="row pt-5">
                <div class="col-lg-4 col-12">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-12 mb-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter">
                            <div class="icon-box icon-box-style-1">
                                <div class="icon-box-icon">
                                    <i class="lnr lnr-apartment text-color-primary"></i>
                                </div>
                                <div class="icon-box-info mt-1">
                                    <div class="icon-box-info-title">
                                        <h3 class="font-weight-bold text-4 mb-0">{{__('site.contact.address')}}</h3>
                                    </div>
                                    <p>Zeebergweg 2 1051DE Amsterdam</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-12 mb-lg-4 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200">
                            <div class="icon-box icon-box-style-1">
                                <div class="icon-box-icon icon-box-icon-no-top">
                                    <i class="lnr lnr-envelope text-color-primary"></i>
                                </div>
                                <div class="icon-box-info mt-1">
                                    <div class="icon-box-info-title">
                                        <h3 class="font-weight-bold text-4 mb-0">{{__('site.contact.email')}}</h3>
                                    </div>
                                    <p><a href="mailto:info@westerparkstudio.nl">info@westerparkstudio.nl</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 col-lg-12 appear-animation" data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400">
                            <div class="icon-box icon-box-style-1">
                                <div class="icon-box-icon">
                                    <i class="lnr lnr-phone text-color-primary"></i>
                                </div>
                                <div class="icon-box-info mt-1">
                                    <div class="icon-box-info-title">
                                        <h3 class="font-weight-bold text-4 mb-0">{{__('site.contact.phone')}}</h3>
                                    </div>
                                    <p><a href="tel:+31 (0)6 3402 6844">+31 (0)6 3402 6844</a></p>
                                </div>
                            </div>
                            <div class="icon-box icon-box-style-1">
                                <div class="icon-box-icon">
                                    <i class="lnr lnr-phone-handset text-color-primary"></i>
                                </div>
                                <div class="icon-box-info mt-1">
                                    <div class="icon-box-info-title">
                                        <h3 class="font-weight-bold text-4 mb-0">{{__('site.contact.phone')}}</h3>
                                    </div>
                                    <p><a href="tel:+31 (0)20 3624 668">+31 (0)20 3624 668</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 appear-animation" data-appear-animation="fadeInRightShorter">
                    <form class="contact-form form-style-2" action="{{ route('contact') }}" method="POST">
                        <input type="hidden" value="{{ config('app.locale') }}" name="lang">
                        @csrf
                        <div class="form-row row mb-3">
                            <div class="form-group col-md-6">
                                <input type="text" value="{{ old('name') }}" class="form-control @if($errors->has('name')) is-invalid @endif"
                                       name="name" placeholder="{{__('site.form.name')}}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" value="{{ old('email') }}" class="form-control @if($errors->has('email')) is-invalid @endif"
                                       name="email" placeholder="E-mail">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-row row mb-3">
                            <div class="form-group col-md-6">
                                <input type="text" value="{{ old('phone') }}" class="form-control @if($errors->has('phone')) is-invalid @endif"
                                       name="phone" placeholder="{{__('site.form.phone')}}">
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control" name="subject">
                                    <option value="">{{__('site.form.subject')}}</option>
                                    <option value="Studio Rental">Studio Rental </option>
                                    <option value="Equipment Rental" {{ (request('product')) ? 'selected' : null }}>Equipment Rental</option>
                                    <option value="Other">Other </option>
                                </select>
                               {{-- <input type="text" value="{{ old('subject') }}" class="form-control" name="subject" placeholder="{{__('site.form.subject')}}">--}}
                            </div>
                        </div>

                        @if(request('product'))
                            <div class="form-row row mb-3">
                                <div class="form-group col-md-12">
                                    <input type="text" value="{{ request('product') }}" class="form-control" name="service">
                                </div>
                            </div>
                        @endif

                        <div class="form-row row mb-3">
                            <div class="form-group col">
                                <textarea rows="5" class="form-control" name="message" placeholder="{{__('site.form.message')}}">
                                    {{ old('message') }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-row row mb-3 mt-2">
                            <div class="col">
                                <input type="submit" value="{{__('site.form.submit')}}" class="btn btn-primary btn-rounded btn-4 font-weight-semibold text-0">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4870.560471781928!2d4.865162!3d52.38347!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5e27951829dbd%3A0x17bb2c887feecd1d!2sWesterpark%20Studio!5e0!3m2!1str!2sus!4v1685994434771!5m2!1str!2sus"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
@endsection
