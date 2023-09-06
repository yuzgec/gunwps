@extends('backend.layout.app')
@section('title', 'Sayfa Kategori Listesi')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Sayfa Kategori Listesi [{{ $All->count() }}]
                    </h4>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="btn btn-primary btn-sm me-1" href="{{  url()->previous() }}" title="Geri">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 18v-6a3 3 0 0 0 -3 -3h-10l4 -4m0 8l-4 -4" /></svg>
                        Geri
                    </a>
                    <a class="btn btn-primary btn-sm me-1" href="{{ route('pagecategory.create') }}" title="Sayfa Kategori Ekle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Kategori Ekle
                    </a>
                </div>
            </div>

            <div class="table-responsive p-2">
                <table class="table table-hover table-striped table-bordered table-center">
                    <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th class="d-none d-lg-table-cell">Üst Kategori</th>
                        <th class="d-none d-lg-table-cell">Oluşturma Tarihi</th>
                        <th class="w-1"></th>
                    </tr>
                    </thead>

                    <tbody id="orders">

                    @foreach($All as $item)
                        <tr id="page_{{$item->id}}">
                            <td>
                                <span class="avatar me-2" style="background-image: url({{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page')}})"></span>
                            </td>
                            <td>
                                <div class="font-weight-medium">
                                    <a href="{{ route('pagecategory.edit', $item->id) }}" title="Düzenle">{{ $item->title }}</a>
                                </div>
                            </td>
                            <td class="text-muted d-none d-lg-table-cell">
                                {{ ($item->parent_id == null) ? 'Üst Kategori' : 'Alt Kategori'  }}
                            </td>
                            <td class="text-muted d-none d-lg-table-cell">
                                {{ $item->created_at->diffForHumans() }}
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
                                        <form action="{{ route('pagecategory.destroy', $item->id) }}" method="POST">
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
