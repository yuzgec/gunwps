@extends('frontend.layout.rental.app')
@section('content')
    <section class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="active">Create Offer</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="font-weight-bold">Create Offer</h1>

                </div>
            </div>
        </div>
    </section>


    <section class="section">
        <div class="container container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h2 class="font-weight-bold mb-3">Wishlist</h2>

                            <div class="table-responsive">
                                <table class="shop-cart-table w-100">
                                    <thead>
                                    <tr>
                                        <th class="product-thumbnail text-center">Image</th>
                                        <th class="product-name text-center"><strong>Product</strong></th>
                                        <th class="product-quantity text-center"><strong>Day</strong></th>
                                        <th class="product-quantity text-center"><strong>Quantity</strong></th>
                                        <th class="product-subtotal text-center"><strong>Total</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::instance('shopping')->content() as $c)
                                        <tr class="cart-item " >

                                            <td class="product-thumbnail text-center">
                                                <a href="{{ route('product', [$c->options->category,$c->options->url]) }}" title="{{$c->name}}">
                                                    <img src="{{ $c->options->image }}"  alt="{{$c->name}}" style="width: 60px;mix-blend-mode: multiply"/>
                                                </a>
                                            </td>

                                            <td class="product-name text-center align-items-center">
                                                <h5>
                                                    <a href="{{ route('product', [$c->options->category,$c->options->url]) }}" title="{{$c->name}}">
                                                    <br>
                                                    {{$c->name}}</a>
                                                </h5>
                                            </td>

                                            <td class="product-quantity text-center">
                                                <br>
                                                X {{$request->day}}
                                            </td>
                                            <td class="product-quantity text-center">
                                                <br>
                                                X {{$c->qty}}
                                            </td>
                                            <td class="product-subtotal text-center">
                                                <br>
                                                <span class="sub-total"><strong>€{{ $subtotal[] = money(kiralamaUcretiHesapla($c->price, $request->day) * $c->qty) }}</strong></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <h2 class="font-weight-bold text-4 mt-5 mb-3">Wishlist Totals</h2>
                            <div class="table-responsive">
                                <table class="cart-totals w-100">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="cart-total-label">Cart Subtotal</span>
                                        </td>
                                        <td>
                                            <span class="cart-total-value">€{{ $st = money(array_sum($subtotal ))}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="cart-total-label">TAX %21</span>
                                        </td>
                                        <td>
                                            <span class="cart-total-value">€{{ $vt = money(array_sum($subtotal) * 0.21) }} </span>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom-0">
                                        <td>
                                            <span class="cart-total-label">Total</span>
                                        </td>
                                        <td>
                                            <span class="cart-total-value text-color-primary text-4">€{{ $total = money($vt + $st) }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h2 class="font-weight-bold mb-3">Offer Form</h2>
                            <form class="contact-form form-style-2" action="{{ route('wishlist.save') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $request->day }}" name="day">
                                <input type="hidden" value="{{ config('app.locale')  }}" name="locale">
                                @php session(['priceinfo' => ['subtotal' => $st, 'vat' => $vt, 'totalprice' => $total]]) @endphp
                                <input type="hidden" value="{{ $st  }}" name="subtotal">
                                <input type="hidden" value="{{ $vt  }}" name="vat">
                                <input type="hidden" value="{{ $total }}" name="totalprice">
                                <div class="form-row row mb-3">
                                    <div class="form-group col">
                                        <label class="text-color-dark font-weight-semibold" for="name">Name Surname:</label>
                                        <input type="text" value="{{ old('name') }}" class="form-control  @if($errors->has('name')) is-invalid @endif"  id="name" name="name">
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">{{$errors->first('name')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row row mb-3">
                                    <div class="form-group col">
                                        <label class="text-color-dark font-weight-semibold" for="company">Company Name:</label>
                                        <input type="text" value="{{ old('company') }}" class="form-control  @if($errors->has('company')) is-invalid @endif"  name="company" id="company">
                                        @if($errors->has('company'))
                                            <div class="invalid-feedback">{{$errors->first('company')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row row mb-3">
                                    <div class="form-group col">
                                        <label class="text-color-dark font-weight-semibold" for="phone">Phone Number:</label>
                                        <input type="text" value="{{ old('phone') }}" class="form-control  @if($errors->has('phone')) is-invalid @endif"  name="phone" id="phone">
                                        @if($errors->has('phone'))
                                            <div class="invalid-feedback">{{$errors->first('phone')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row row mb-3">
                                    <div class="form-group col">
                                        <label class="text-color-dark font-weight-semibold" for="email">Email Address:</label>
                                        <input type="text" value="{{ old('email') }}" class="form-control  @if($errors->has('email')) is-invalid @endif"  name="email"  id="email">
                                        @if($errors->has('email'))
                                            <div class="invalid-feedback">{{$errors->first('email')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-row row mb-3">
                                    <div class="form-group col">
                                        <label class="text-color-dark font-weight-semibold" for="address">Address:</label>
                                        <textarea  rows="5" class="form-control" name="address" id="address">{{ old('address') }}</textarea>
                                    </div>
                                </div>


                                <div class="form-row row mb-3">
                                    <div class="form-group col">
                                        <label class="text-color-dark font-weight-semibold" for="message">Message:</label>
                                        <textarea  rows="2" class="form-control" name="message"  id="message">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div id="shopPayment">
                                    <div class="radio-custom">
                                        <input type="radio" id="transfer" name="delivery" checked="">
                                        <label class="font-weight-semibold" for="transfer">Transfer</label>
                                    </div>
                                    <div class="radio-custom">
                                        <input type="radio" id="studio" name="delivery">
                                        <label class="font-weight-semibold" for="studio">In Studio</label>
                                    </div>
                                </div>
                                <div class="form-row row mt-3 mb-3">
                                    <div class="form-group col">
                                        <input class="btn btn-primary btn-block btn-4 font-weight-semibold text-0" type="submit" value="Submit"  />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('customCSS')
    <style>


    </style>


@endsection

@section('customJS')
    <script>
        $(document).ready(function() {
            $("table").addClass("table table-hover table-striped table-bordered table-responsive");


        })
    </script>
@endsection
