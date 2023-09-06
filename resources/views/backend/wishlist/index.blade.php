@extends('backend.layout.app')
@section('content')
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h3 class="card-title">Wish List Requests</h3>
                </div>
                <div>
                    <form method="get" style="margin-left:15px">
                        <div class="input-icon ">
                            <input type="text" value="{{ request('q') }}" name="q" class="form-control" placeholder="Arama…">
                            <span class="input-icon-addon">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                        </span>
                        </div>
                    </form>
                </div>

            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Name </th>
                        <th>Company</th>
                        <th>Day</th>
                        <th>Delivery</th>
                        <th>Total</th>
                        <th>Locale</th>
                        <th>Count</th>
                        <th>Createad At</th>
                        <th>Look</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wishlist as $item)
                        <tr>
                            <td><span class="text-muted">{{ $item->id }}</span></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->company }}</td>
                            <td><b>X{{ $item->day }}</b></td>
                            <td>{{ $item->delivery }}</td>
                            <td>€{{ money($item->totalprice) }}</td>
                            <td><img src="/frontend/flag/{{ $item->locale }}.svg" style="width:15px"/></td>
                            <td>{{ $item->get_product_count }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td><a href="{{ route('wishlist.list', $item->id) }}"> Review</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
