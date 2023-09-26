@extends('backend.layout.app')
@section('content')
    <div class="col-12 col-md-6 mt-3">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h3 class="card-title">[{{ $wishlist->id }}] Wish List Information</h3>
                </div>
                <div>
                    <a onclick="history.back()" class="btn btn-primary btn-sm">Back List</a>
                </div>
            </div>
            <div class="list-group list-group-flush">
                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Name</div>
                    <div>{{ $wishlist->name }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Company Name</div>
                    <div>{{ $wishlist->company }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Email</div>
                    <div>{{ $wishlist->email }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Phone</div>
                    <div>{{ $wishlist->phone }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Address</div>
                    <div>{{ $wishlist->address }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Message</div>
                    <div>{{ $wishlist->message }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Rent Day</div>
                    <div>X{{ $wishlist->day }}</div>
                </div>
                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Delivery</div>
                    <div>{{ $wishlist->delivery}}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Locale</div>
                    <div><img src="/frontend/flag/{{ $wishlist->locale }}.svg" style="width:25px"/></div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Sub Total</div>
                    <div>  €{{ money($wishlist->subtotal) }}</div>
                </div>
                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>BTW %21</div>
                    <div>  €{{ money($wishlist->vat) }}</div>
                </div>
                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Total Price</div>
                    <div>  €{{ money($wishlist->totalprice) }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Created At</div>
                    <div>  {{ $wishlist->created_at }}</div>
                </div>

                <div class="d-flex justify-content-between list-group-item list-group-item-action">
                    <div>Offer PDF</div>
                    <div>
                        <button class="btn btn-primary btn-sm">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 mt-3">
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between">
                <div><h3 class="card-title">Product List [{{ $wishlist->get_product_count }}]</h3></div>
                <div>€{{ money($wishlist->totalprice) }}</div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Product Name </th>
                        <th>Brand</th>
                        <th>QTY</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productlist as $item)
                        @foreach(\App\Models\Product::with('getBrand')->where('id', $item->product_id)->get() as $p)
                            <tr>
                                <td><img src="{{ (!$p->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $p->getFirstMediaUrl('page', 'icon')}}" width="175px"/></td>
                                <td>{{ $p->title }}</td>
                                <td><img src="{{ (!$p->getBrand->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $p->getBrand->getFirstMediaUrl('page', 'small')}}" width="75px"/></td>
                                <td><b>X{{ $item->quantity }}</b></td>
                                <td>{{ $item->price }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('home') }}" class="btn btn-secondary btn-sm mt-2" style="margin-right:10px">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
                    Send Mail Offer
                </a>
            </div>
        </div>
        <div class="card bg-body">
            <form action="{{ route('wishlist.print',$wishlist->id) }}" method="POST">
                @csrf
            <div class="card-header d-flex justify-content-between bg-success">
                <div><h3 class="card-title text-white">New Offer</h3></div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Product Name</th>
                        <th>QTY</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($productlist as $item)
                        <input type="hidden" name="wishlist_id" value="{{ $item->wishlist_id }}">
                        <input type="hidden" name="quantity" value="{{ $item->quantity }}">
                        <input type="hidden" name="price" value="{{ $item->price }}">
                        @foreach(\App\Models\Product::with('getBrand')->where('id', $item->product_id)->get() as $p)
                            <input type="hidden" name="product_id[]" value="{{ $p->id }}">
                            <tr>
                                <td><img src="{{ (!$p->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $p->getFirstMediaUrl('page', 'small')}}" width="500px"/></td>
                                <td><span style="color:green">&#x2713;</span>  {{ $p->title }}</td>
                                <td><b>X{{ $item->quantity }}</b></td>
                                <td><b>€{{ $item->price }}</b></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <select class="form-control select" name="product_changed_id[]" >
                                        <option value="{{ $p->id }}"> Seçiniz</option>
                                        @foreach($product as $changed)
                                            <option value="{{ $changed->id }}">{{ $changed->title .' - €'. money($changed->price)}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-2">

                <select class="form-control multiple" multiple name="extraproduct[]">
                    @foreach($product as $item)
                        <option value="{{ $item->id }}">{{ $item->title .' - €'. money($item->price)}}</option>
                    @endforeach
                </select>

                <textarea class="form-control mt-2" name="offermessage" placeholder="Message" rows="6"></textarea>

                <div class="form-group mb-3 row">
                    <div class="col-md-3 col-12">
                        <select class="form-control mt-2" name="discount_type">
                            <option value="minus">Minus (-)</option>
                            <option value="percentage">Percentage (%)</option>
                        </select>
                    </div>
                    <div class="col-md-9 col-12">
                        <input class="form-control mt-2" name="discount_rate" placeholder="Discount">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-secondary btn-sm mt-2 mb-2" style="margin-right:10px">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="3" y="5" width="18" height="14" rx="2"></rect><polyline points="3 7 12 13 21 7"></polyline></svg>
                        New Offer Send
                    </button>
                </div>
            </div>
            </form>
        </div>
        <div class="card bg-white mt-2">
            <div class="card-header">
                <div><h3 class="card-title">Offer List</h3></div>
            </div>
            <div class="card-body">
                @if($m)
                    <h4>Mevcut Ürünler</h4>
                    @foreach($product->whereIn('id', $o ) as $item)
                        <b>Available :  {{ $item->title }}<br></b>
                    @endforeach
                    @foreach($product->whereIn('id',$m) as $item)
                            <b>Available :  {{ $item->title }}<br></b>
                    @endforeach
                    <hr>

                    <h4>Olmayan Ürünler</h4>
                    @foreach($product->whereIn('id', $c) as $row)
                            Changing :  {{ $row->title }}<br>
                    @endforeach
                @else
                    <div class="alert alert-danger">No Offer Prepared Yet</div>
                @endif
            </div>
        </div>
@endsection

@section('customCSS')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('customJS')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select').select2();
            $('.multiple').select2({
                placeholder: 'Recommended Products '
            });
        });
    </script>
@endsection
