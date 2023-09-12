@extends('backend.layout.app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="mb-3">Kullanılan Alan <strong>276MB </strong>of 8 GB</p>
                <div class="progress progress-separated mb-3">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 44%"></div>
                    <div class="progress-bar bg-info" role="progressbar" style="width: 19%"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 9%"></div>
                </div>
                <div class="row">
                    <div class="col-auto d-flex align-items-center pe-2">
                        <span class="legend me-2 bg-primary"></span>
                        <span>Regular</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">915MB</span>
                    </div>
                    <div class="col-auto d-flex align-items-center px-2">
                        <span class="legend me-2 bg-info"></span>
                        <span>Sistem</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">44415MB</span>
                    </div>
                    <div class="col-auto d-flex align-items-center px-2">
                        <span class="legend me-2 bg-success"></span>
                        <span>Paylaşılan Bellek</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">201MB</span>
                    </div>
                    <div class="col-auto d-flex align-items-center ps-2">
                        <span class="legend me-2"></span>
                        <span>Boş Bellek</span>
                        <span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">612MB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between">

                <div>
                    <h3 class="card-title">Wish List Requests</h3>
                </div>
                <div class="d-flex">
                    <form method="get" style="margin-left:15px">
                        <div class="input-icon ">
                            <input type="text" value="{{ request('q') }}" name="q" class="form-control" placeholder="Arama…">
                            <span class="input-icon-addon">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                        </span>
                        </div>
                    </form>
                    <a class="btn btn-primary" href="{{ route('wishlist.index') }}" style="margin-left:20px">All Request</a>

                </div>

            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">ID</th>
                        <th>Name </th>
                        <th>Company</th>
                        <th>Day</th>
                        <th>Delivery</th>

                        <th>Total</th>
                        <th>Locale</th>
                        <th>Count</th>
                        <th>Createad At</th>

                        <th>Tarih</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wishlist as $item)
                        <tr>
                            <td><span class="text-muted">{{ $item->id }}</span></td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $item->company }}
                            </td>
                            <td>
                                <b>X{{ $item->day }}</b>
                            </td>
                            <td> {{ $item->delivery }}</td>
                            <td> €{{ money($item->totalprice) }}</td>
                            <td><img src="/frontend/flag/{{ $item->locale }}.svg" style="width:15px"/></td>
                            <td> {{ $item->get_product_count }}</td>
                            <td> {{ $item->created_at }}</td>
                            <td><a href="{{ route('wishlist.list', $item->id) }}"> Review</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Contact Form</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Name </th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service</th>
                        <th>Subject</th>
                        <th>Createad At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contact as $item)
                        <tr>
                            <td><span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span></td>
                            <td> {{ $item->name }}</td>
                            <td><img src="/frontend/flag/{{ $item->locale }}.svg" style="width:15px"/></td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->service }}</td>
                            <td>{{ $item->subject }}</td>
                            <td><a href="{{ route('wishlist.list', $item->id) }}"> Read</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

    <div class="col-12 col-md-9 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Most Viewed Pages</h3>
            </div>
            <table class="table card-table table-vcenter">
                <thead>
                <tr>
                    <th>Page Name</th>
                    <th colspan="2">Number of Visits</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hakkımızda</td>
                        <td>3,550</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12 col-md-3 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Searched Words</h3>
            </div>
            <table class="table card-table table-vcenter">
                <thead>
                <tr>
                    <th>Word</th>
                    <th>Lang</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Search as $item)
                    <tr>
                        <td>{{ $item->key }}</td>
                        <td><img src="/frontend/flag/{{ $item->language }}.svg" style="width:15px"/></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


