@extends('frontend.layout.rental.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{ __('site.home') }}</a></li>
                        <li class="active">{{ __('site.equipmentlist') }}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="font-weight-bold">{{ __('site.equipmentlist') }}</h1>
                </div>
            </div>
        </div>
    </section>
    <form class="contact-form form-style-2" action="{{ route('wishlist.save') }}" method="POST">

    <section class="section pt-0">
        <div class="container container-fluid">
            <div class="row mb-3">
                @if (Cart::instance('shopping')->content()->count() > 0)
                <div class=" col-12 col-md-9 mt-4">

               {{--     <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div>
                         --}}{{--   <a href="{{ route('login') }}" title="Login"><i class="icon-plus icon"></i> Save List</a>
                            <a href="{{ route('login') }}" title="Login"><i class="far fa-file-pdf" style="margin-left: 15px"></i> Download PDF</a>
                      --}}{{--
                        </div>
                        <div class="d-flex">
                            <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                            <lord-icon
                                src="https://cdn.lordicon.com/zmkotitn.json"
                                trigger="loop"
                                colors="primary:#121331"
                                style="width:50px;height:50px;margin-right:15px">
                            </lord-icon>
                            <form action="{{ route('checkout') }}" method="get">
                                <div class="input-group input-group-style-3 rounded">
                                    <input type="number" class="form-control bg-light-5 border-0" placeholder="Select Day" aria-label="Select Day" name="day" required>
                                    <span class="input-group-btn bg-light-5 p-1">
                                    <button class="btn btn-primary font-weight-semibold btn-h-3 rounded h-100" type="submit">Create Offer</button>
                                </span>
                                </div>
                            </form>
                        </div>
                    </div>--}}

                    <div class="table-responsive">
                            <table class="shop-cart-table w-100">
                                <thead>
                                <tr>
                                    <th class="product-remove text-center"></th>
                                    <th class="product-thumbnail text-center">Image</th>
                                    <th class="product-name text-center"><strong>Product</strong></th>
                                    <th class="product-price text-center"><strong>Brand</strong></th>
                                    <th class="product-price text-center"><strong>Price</strong></th>
                                    <th class="product-quantity text-center"><strong>QTY</strong></th>
                                    <th class="product-subtotal text-center"><strong>Total</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::instance('shopping')->content() as $c)
                                <tr class="cart-item">
                                    <td class="product-remove text-center">
                                        <br>
                                        <form id="form" method="post" action="{{route('deletecart',$c->rowId )}}">
                                            @csrf
                                            <a href="javascript:{}" onclick="document.getElementById('form').submit()">
                                                <i class="fas fa-times" aria-label="Remove"></i>
                                            </a>
                                        </form>
                                    </td>
                                    <td class="product-thumbnail text-center">
                                        <img src="{{ $c->options->image }}"  alt="{{$c->name}}" style="width: 50px;mix-blend-mode: multiply"/>
                                    </td>

                                    <td class="product-name text-center align-items-center">
                                        <h5><a href="{{ route('product', [$c->options->category,$c->options->url]) }}" title="{{$c->name}}">
                                        <br>
                                        {{$c->name}}</a></h5>
                                    </td>

                                    <td class="product-thumbnail text-center">
                                        <br>
                                        <img src="{{ $c->options->brandImage }}"  alt="{{$c->options->brand}}" style="width: 75px;mix-blend-mode: multiply"/>
                                    </td>

                                    <td class="product-price text-center">
                                        <br>
                                        <span class="unit-price">€{{$c->price}}</span>
                                    </td>
                                    <td class="product-quantity text-center">
                                        <br>
                                       X {{$c->qty}}
                                    </td>
                                    <td class="product-subtotal text-center">
                                        <br>
                                        <span class="sub-total"><strong>€{{$c->price * $c->qty }}</strong></span>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>


                        </div>

                    <div class="form-row row mb-2">
                        <div class="form-group col">
                            <label class="text-color-dark font-weight-semibold" for="message">Extras:</label>
                            <textarea  rows="6" class="form-control" name="message"  id="message">{{ old('message') }}</textarea>
                        </div>
                    </div>
                </div>
                    <div class="col-md-3">
                            @csrf
                            <div class="form-row row mb-2 mt-3">
                                <div class="form-group col">
                                    <label class="text-color-dark font-weight-semibold" for="name">Name Surname:</label>
                                    <input type="text" value="{{ old('name') }}" class="form-control  @if($errors->has('name')) is-invalid @endif"  id="name" name="name">
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row row mb-2">
                                <div class="form-group col">
                                    <label class="text-color-dark font-weight-semibold" for="company">Company Name:</label>
                                    <input type="text" value="{{ old('company') }}" class="form-control  @if($errors->has('company')) is-invalid @endif"  name="company" id="company">
                                    @if($errors->has('company'))
                                        <div class="invalid-feedback">{{$errors->first('company')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row row mb-2">
                                <div class="form-group col">
                                    <label class="text-color-dark font-weight-semibold" for="phone">Phone Number:</label>
                                    <input type="text" value="{{ old('phone') }}" class="form-control  @if($errors->has('phone')) is-invalid @endif"  name="phone" id="phone">
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row row mb-2">
                                <div class="form-group col">
                                    <label class="text-color-dark font-weight-semibold" for="email">Email Address:</label>
                                    <input type="text" value="{{ old('email') }}" class="form-control  @if($errors->has('email')) is-invalid @endif"  name="email"  id="email">
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row row mb-2">
                                <div class="form-group col">
                                    <label class="text-color-dark font-weight-semibold" for="address">Address:</label>
                                    <textarea  rows="4" class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                                </div>
                            </div>

                            <div class="form-row row mb-2">
                                <div class="form-group col">
                                    <label class="text-color-dark font-weight-semibold" for="days">Select Day:</label>
                                    <select class="form-control" name="day" id="days">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8+</option>
                                    </select>
                                </div>
                            </div>

                           {{-- <div id="shopPayment">
                                <div class="radio-custom">
                                    <input type="radio" id="studio" name="delivery"  value="In Studio" checked>
                                    <label class="font-weight-semibold" for="studio">In Studio</label>
                                </div>
                                <div class="radio-custom">
                                    <input type="radio" id="transfer" name="delivery"  value="Location">
                                    <label class="font-weight-semibold" for="transfer">Location</label>
                                </div>

                            </div>--}}
                            <div class="form-row row mt-3 mb-3">
                                <div class="form-group col">
                                    <input class="btn btn-primary btn-block btn-4 font-weight-semibold text-0" type="submit" value="Submit"  />
                                </div>
                            </div>

                    </div>



                @else
                <div class="alert alert-info">
                     Your cart is <strong> empty.</strong>
                </div>
                @endif


            </div>
        </div>
    </section>
    </form>
@endsection



@section('customJS')
    <script>
        $(document).ready(function() {
            $("table").addClass("table table-hover table-striped table-bordered striped-rows table-responsive");
        })

    </script>
@endsection
