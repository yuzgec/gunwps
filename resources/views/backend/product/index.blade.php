@extends('backend.layout.app')
@section('title', 'Product List')
@section('content')
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Product List [{{ $All->count() }}]
                    </h4>

                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary btn-sm me-1" href="{{  url()->previous() }}" title="Geri">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 18v-6a3 3 0 0 0 -3 -3h-10l4 -4m0 8l-4 -4" /></svg>
                        Back
                    </a>
                    <a class="btn btn-secondary btn-sm me-1" href="{{ route('brand.create') }}" title="Add Brand">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Brand
                    </a>
                    <a class="btn btn-success btn-sm me-1" href="{{ route('product.create') }}" title="Add Product">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Product
                    </a>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-12 col-md-8">
                    <form method="get" style="margin-left:10px">
                        <div class="input-icon ">
                            <input type="text" value="{{ request('q') }}" name="q" class="form-control" placeholder="Arama…">
                            <span class="input-icon-addon">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                                </span>
                        </div>
                    </form>
                </div>

                <div class="col-12 col-md-4" >
                    <select class="form-control" onchange="location = this.options[this.selectedIndex].value;" style="margin-left: -10px">
                        @foreach($Kategori as  $item)
                        <option value="{{ url()->current().'?product_categori='.$item->id }}"
                        @if($item->id == request('product_categori')) ? selected : null @endif>
                            {{ $item->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-responsive p-2">
                <table class="table table-hover table-striped table-bordered ">
                    <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>SKU</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th class="w-1"></th>
                    </tr>
                    </thead>
                    <tbody id="orders">
                    @foreach($All as $item)
                        <tr id="page_{{$item->id}}">
                            <td>
                                {{ $item->rank+1 }}
                            </td>
                            <td>
                                <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'icon')}}"
                                     class="avatar me-2" style="mix-blend-mode: multiply"/>
                            </td>
                            <td>
                                <div class="font-weight-medium">
                                    <a href="{{ route('product.edit', $item->id) }}" title="{{ $item->title}}">{{ $item->title}}</a>
                                </div>
                            </td>
                            <td>
                                {{ $item->sku }}
                            </td>
                            <td>
                                <img src="{{ $item->getBrand->getFirstMediaUrl('page','small') }}" class="img-fluid" style="width:55px;mix-blend-mode: multiply">
                            </td>
                            <td>
                                €{{ $item->price }}
                            </td>
                            <td>
                                <label class="form-check form-check-single form-switch">
                                    <input class="form-check-input switch" status-id="{{ $item->id }}"  type="checkbox" @if ($item->status == 1) checked @endif>
                                </label>
                            </td>

                            <td class="d-none d-lg-table-cell">
                                <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $item->id }}" class="text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </a>
                            </td>
                        </tr>
                        <div class="modal modal-blur fade" id="silmeonayi{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Silme Onayı</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Silmek üzeresiniz. Bu işlem geri alınmamaktadır.
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
                                            İptal Et
                                        </a>
                                        <form action="{{ route('product.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ms-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                Silmek İstiyorum
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>

              {{--  <div class="col-12 col-md-12">{{ $All->appends(['sort' => 'product', 'q' => request('q')])->links() }}</div>--}}

            </div>
          {{--  <div class="tab-content">
                @foreach($Kategori->where('parent_id', 0)  as $category)
                <div class="tab-pane @if ($loop->first) show active @endif" id="{{ $category->slug }}">

                </div>
                @endforeach
            </div>
--}}

        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card">

            <div class="card-header d-flex justify-content-between">
                <div>
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Product Category [{{ $Kategori->count() }}]
                    </h4>
                </div>
                <div>
                    <a class="btn btn-tabler btn-sm" href="{{ route('productcategory.index') }}" title="Sayfa Ekle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add Category
                    </a>
                </div>
            </div>

            <div class="table-responsive p-2">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Parent</th>
                            <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th colspan="4">
                            <a class="btn btn-success btn-block btn-sm" href="{{ route('productcategory.create') }}" title="Yeni Kategori Ekle">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                Add New
                            </a>
                        </th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($Kategori  as $item)
                        <tr>
                            <td>
                                <img src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'small')}}" class="avatar me-2"/>
                            </td>
                            <td>
                                <div class="font-weight-medium">
                                    <a href="{{ route('productcategory.edit', $item->id) }}" title="{{ $item->title }}">{{ $item->title }}</a>
                                </div>
                            </td>
                            <td class="text-muted">
                                {{ ($item->parent_id == null) ? 'Üst Kategori' : 'Alt Kategori'  }}
                            </td>
                            <td class="d-none d-lg-table-cell">
                                <a data-bs-toggle="modal" data-bs-target="#silmeonayi{{ $item->id }}" class="text-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>

                                </a>
                            </td>
                        </tr>
                        <div class="modal modal-blur fade" id="silmeonayicat{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Silme Onayı</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Silmek üzeresiniz. Bu işlem geri alınmamaktadır.
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" /></svg>
                                            İptal Et
                                        </a>
                                        <form action="{{ route('productcategory.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ms-auto">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                Silmek İstiyorum
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <script>
        $(document).ready(function() {
            $('#orders').sortable({
                update:function()
                {
                    let siralama = $('#orders').sortable('serialize');
                    $.get("{{ route('product.getOrder') }}?"+siralama,() => {
                        $("#rank").show(500).delay(2500).fadeOut();
                        document.getElementById("rank").innerHTML="Sıralama başarıyla güncellendi.";
                        setInterval(function(){
                            location.reload();
                        }, 3000);
                    });
                }
            });

            $('.switch').change(function() {
                const id = $(this)[0].getAttribute('status-id');
                const status = $(this).prop('checked');

                $.get("{{route('product.getSwitch')}}", {id:id,status:status},
                () => {
                    if(status) {}
                });
            })
        })
    </script>
@endsection
