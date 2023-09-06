@extends('backend.layout.app')
@section('title', $Edit->title.' | Edit Faq')
@section('content')
    {{Form::model($Edit, ["route" => ['faq.update', $Edit->id],'enctype' => 'multipart/form-data'])}}
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="d-flex">
                        <h4 class="card-title justify-content-center align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Edit Brand [ {{$Edit->title }}]
                        </h4>
                    </div>
                    <div>
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
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                            <div class="tab-pane @if ($loop->first) show active @endif" id="{{ $localeCode }}">
                                <div class="text-center mb-2">
                                    <img src="/frontend/flag/{{ $localeCode }}.svg" width="20px"><span  style="margin-left:10px">{{ $properties['native'] }} dili ilgili ayarları yapıyorsunuz.</span>
                                </div>
                                <x-form-inputtext label="Faq Title" name="title:{{ $localeCode }}"/>

                                <x-form-textarea label="Faq Desc" name="desc:{{ $localeCode }}" ck="aciklama{{ $localeCode }}"/>

                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection


@section('customJS')
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
    @include('backend.layout.ck')

@endsection
