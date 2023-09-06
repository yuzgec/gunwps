@extends('backend.layout.app')
@section('title', $Edit->title.' | Hizmet Düzenle')
@section('content')
    {{Form::model($Edit, ["route" => ['service.update', $Edit->id],'enctype' => 'multipart/form-data'])}}
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-9">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="d-flex">
                        <h4 class="card-title justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Edit Service [ {{$Edit->title }}]
                        </h4>
                    </div>
                    <div>
                        <a class="btn btn-tabler btn-sm p-2" href="{{ route('service.edit', $Edit->slug) }}" title="Geri">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" /><line x1="10" y1="14" x2="20" y2="4" /><polyline points="15 4 20 4 20 9" /></svg>
                            Prewiev
                        </a>
                        <a class="btn btn-tabler btn-sm p-2" href="{{  url()->previous() }}" title="Geri">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 18v-6a3 3 0 0 0 -3 -3h-10l4 -4m0 8l-4 -4" /></svg>
                            Back
                        </a>
                        <button class="btn btn-tabler btn-sm p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="10" y1="14" x2="21" y2="3" /><path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                            Save
                        </button>
                    </div>
                </div>
                <ul class="nav nav-tabs" data-bs-toggle="tabs">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                        <li class="nav-item">
                            <a href="#{{ $localeCode }}" class="nav-link" data-bs-toggle="tab">
                                <img src="/frontend/flag/{{ $localeCode }}.svg" width="20px"><span  style="margin-left:10px">{{ $properties['native'] }}</span>
                            </a>
                        </li>
                    @endforeach

                    <li class="nav-item ms-auto">
                        <a href="#tabs-settings-7" class="nav-link" title="Settings" data-bs-toggle="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </a>
                    </li>
                </ul>

                <div class="card-body">
                    <div class="tab-content">

                        <x-form-inputtext label="Video Adı" name="name"/>
                        <x-form-inputtext label="Video URL" name="video_url"/>

                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                            <div class="tab-pane @if ($loop->first) show active @endif" id="{{ $localeCode }}">
                                <div class="text-center mb-2">
                                    <img src="/frontend/flag/{{ $localeCode }}.svg" width="20px"><span  style="margin-left:10px">{{ $properties['native'] }} dili ilgili ayarları yapıyorsunuz.</span>
                                </div>
                                <x-form-inputtext label="Başlık Adı Giriniz" name="title:{{ $localeCode }}"/>
                                <x-form-textarea label="Kısa Açıklama" name="short:{{ $localeCode }}"/>

                                <x-form-textarea label="Açıklama" name="desc:{{ $localeCode }}" ck="aciklama{{ $localeCode }}"/>

                            </div>
                        @endforeach


                    </div>

                </div>

            </div>
        </div>

        <div class="col-12 col-md-3">

            <div class="card mt-2" >
                <div class="card-header">
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" /><line x1="9" y1="13" x2="15" y2="13" /></svg>
                        Kategori
                    </h4>
                </div>
                <div class="form-group mb-3 row">
                    <div class="col-10 offset-1 mt-1">
                        <select class="form-control" data-placeholder="Kategori Seçiniz" name="category">
                            @foreach($Kategori as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $Edit->id ) ? 'selected' : null}}>
                                    {{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="15" y1="8" x2="15.01" y2="8" /><rect x="4" y="4" width="16" height="16" rx="3" /><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5" /><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2" /></svg>
                        Sayfa Kapak Resim
                    </h4>
                </div>
                <div class="card-body justify-content-center align-items-center">
                        <div class="col">
                            <img src="{{ (!$Edit->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $Edit->getFirstMediaUrl('page')}}" class="img-fluid mb-2 mt-2" alt="Image">
                        </div>
                        @if($Edit->getFirstMediaUrl('page'))
                        <label class="form-check form-check-single form-switch mb-1"  >
                            <input class="form-check-input switch" type="checkbox" name="removeImage" value="0">
                            <span style="margin-left: 15px" class="">Resmi Kaldır</span>
                        </label>
                        @endif

                    <x-form-file label="" name="image"></x-form-file>
                </div>
            </div>

            <div class="card mt-2" >
                <div class="card-header">
                    <h4 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l3 3h7a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-11a2 2 0 0 1 2 -2" /><line x1="9" y1="13" x2="15" y2="13" /></svg>
                        Sayfa Galeri
                    </h4>
                </div>
                <div class="p-2">
                    <input type="file" name="gallery[]" multiple class="form-control">
                    @if($errors->has('gallery.*'))
                        <div class="invalid-feedback" style="display: block">{{$errors->first('gallery.*')}}</div>
                    @endif
                </div>
                {{Form::close()}}

                @if($Edit->getFirstMediaUrl('gallery'))
                    <div class="card mt-2" style="height: calc(30rem + 10px)">
                    <div class="card-body card-body-scrollable card-body-scrollable-shadow">
                    <div class="table-responsive ">
                        <table class="table table-hover table-striped table-bordered table-center">
                            <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Sil</th>
                            </tr>
                            </thead>
                            <tbody id="orders">
                            <div class="divide-y">
                            @foreach($Edit->getMedia('gallery') as $item)
                                <tr id="gallery_{{$item->id}}">
                                    <td>
                                        {{ $item }}
                                    </td>
                                    <td>
                                        <form action="{{route('service.deleteGaleriDelete', $Edit->id)}}" method="POST">
                                            <input type="hidden" name="image_id" value="{{$item->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Resim Sil">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="4" y1="7" x2="20" y2="7"></line><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                @endif
            </div>



        </div>
    </div>

@endsection


@section('customJS')
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("img").addClass("img-fluid");
        })
        $('input[type="checkbox"]').on('change', function(){
            this.value ^= 1;
        });
    </script>
    @include('backend.layout.ck')

@endsection
