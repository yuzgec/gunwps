@extends('frontend.layout.rental.app')
@section('customCSS')
    <style>
        .animation-ctn{
            text-align:center;
            margin-top:5em;
        }

        @-webkit-keyframes checkmark {
            0% {
                stroke-dashoffset: 100px
            }

            100% {
                stroke-dashoffset: 200px
            }
        }

        @-ms-keyframes checkmark {
            0% {
                stroke-dashoffset: 100px
            }

            100% {
                stroke-dashoffset: 200px
            }
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100px
            }

            100% {
                stroke-dashoffset: 0px
            }
        }

        @-webkit-keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 480px

            }

            100% {
                stroke-dashoffset: 960px;

            }
        }

        @-ms-keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 240px
            }

            100% {
                stroke-dashoffset: 480px
            }
        }

        @keyframes checkmark-circle {
            0% {
                stroke-dashoffset: 480px
            }

            100% {
                stroke-dashoffset: 960px
            }
        }

        @keyframes colored-circle {
            0% {
                opacity:0
            }

            100% {
                opacity:100
            }
        }

        /* other styles */
        /* .svg svg {
            display: none
        }
         */
        .inlinesvg .svg svg {
            display: inline
        }

        /* .svg img {
            display: none
        } */

        .icon--order-success svg polyline {
            -webkit-animation: checkmark 0.25s ease-in-out 0.7s backwards;
            animation: checkmark 0.25s ease-in-out 0.7s backwards
        }

        .icon--order-success svg circle {
            -webkit-animation: checkmark-circle 0.6s ease-in-out backwards;
            animation: checkmark-circle 0.6s ease-in-out backwards;
        }
        .icon--order-success svg circle#colored {
            -webkit-animation: colored-circle 0.6s ease-in-out 0.7s backwards;
            animation: colored-circle 0.6s ease-in-out 0.7s backwards;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-8 mt-100 mb-100" >
                <div class="card">

                    <div class="animation-ctn">
                        <div class="icon icon--order-success svg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="154px" height="154px">
                                <g fill="none" stroke="#22AE73" stroke-width="2">
                                    <circle cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                                    <circle id="colored" fill="#22AE73" cx="77" cy="77" r="72" style="stroke-dasharray:480px, 480px; stroke-dashoffset: 960px;"></circle>
                                    <polyline class="st0" stroke="#fff" stroke-width="10" points="43.5,77.8 63.7,97.9 112.2,49.4 " style="stroke-dasharray:100px, 100px; stroke-dashoffset: 200px;"/>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <h2>ID# :  <span>WPS-{{ $Whishlist->id }}</span></h2>

                        <h3 class="mb-4 mt-3">{{ $Whishlist->name }} </h3>
                        @if(config('app.locale') ==  'en')
                            <h4 class="text-capitalize">Your Request Has Been Successfully Received!</h4>
                            <p>Thank you! Our team will get back to you with our best possible offer</p>

                        @else
                            <h4 class="text-capitalize">Uw aanvraag is succesvol ontvangen!</h4>
                            <p>Dank u wel! Ons team komt bij je terug met onze beste prijs</p>

                        @endif

                        <div class="row">
                            <div class="col">
                                <h4>Product Detail:</h4>
                                <hr class="mb-2">
                            </div>
                        </div>

                        <div class="row  m-1">
                            <div class="col">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Product Name </th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Product as $item)
                                        <tr >
                                            <th scope="row">
                                                <img
                                                    src="{{ (!$item->getFirstMediaUrl('page')) ? '/backend/resimyok.jpg': $item->getFirstMediaUrl('page', 'img')}}"
                                                    width="50px"
                                                    height="50px"
                                                    style="mix-blend-mode: multiply"
                                                />
                                            </th>
                                            <td style="vertical-align: middle">{{ $item->title }}</td>
                                            <td style="vertical-align: middle"> {{ $item->getBrand->title }}</td>
                                            <td style="vertical-align: middle"> €{{ $item->price }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <a href="{{ route('home') }}" class="btn btn-dark mb-2">
                            <i class="fas fa-home pt-1"></i>&nbsp;Back Home
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
