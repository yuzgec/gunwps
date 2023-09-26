@extends('frontend.layout.app')
@section('content')
    @include('frontend.layout.slider')

    <section class="section">
        <div class="container">
            <div class="row justify-content-center ">
                @if(config('app.locale') ==  'nl')
                <div class="col-lg-12 text-center">
                    <div class="appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" style="animation-delay: 100ms;">
                        <span class="top-sub-title text-color-primary"></span>
                        <h2 class=""><span>WESTERPARK STUDIO AMSTERDAM</span></h2>
                    </div>
                    <p class="lead mb-2 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter"
                       data-appear-animation-delay="200" style="animation-delay: 200ms;">WESTERPARK STUDIO is een vernieuwde en uitgebreide drive-in film en foto studio in
                        Amsterdam met vele mogelijkheden.
                    </p>
                    <p class="text-color-light-3 appear-animation animated fadeInUpShorter appear-animation-visible"
                       data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="animation-delay: 400ms;">Productie is tevens een onderdeel geworden van
                        onze all-in services. Mogelijk is het huren van de studio space, het huren van licht en apparatuur, maar ook de levering van sets en crew. De fotostudio
                        is op een excellente locatie gelegen vlakbij het creatieve Westergasfabriek terrein en beschikbaar voor zowel grote producties, als voor kleine shoots
                        en non-profit projecten.
                    </p>
                </div>
                @else
                    <div class="col-lg-12 text-center">
                        <div class="appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" style="animation-delay: 100ms;">
                            <span class="top-sub-title text-color-primary"></span>
                            <h2 class=""><span>WESTERPARK STUDIO AMSTERDAM</span></h2>
                        </div>
                        <p class="lead mb-2 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter"
                           data-appear-animation-delay="200" style="animation-delay: 200ms;">Westerpark Studio is a drive-in film and photo studio at the Westergasfabriek area in the center of Amsterdam.
                        </p>
                        <p class="text-color-light-3 appear-animation animated fadeInUpShorter appear-animation-visible"
                           data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400" style="animation-delay: 400ms;">We can support your large productions, but also your smaller shoots and non-profit projects. Our all-in services include Studio hire, light/camera and equipment rental, production, crew, sets and transport.


                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>

        <div class="container">
            <div class="row align-items-baseline mb-4 pb-2">
                <div class="col-sm-6 col-lg-4 bg-white">


                        @if(config('app.locale') ==  'nl')
                        <a href="{{ route('studio') }}" title="AMSTERDAM STUDIO VERHUUR">
                            <div class="image-frame overlay overlay-show overlay-op-1 image-frame-style-1 image-frame-effect-1 image-frame-style-5 mt-2">
                                <div class="image-frame-wrapper">
                                    <img src="/studio-limbo-amsterdam.jpg" class="img-fluid" alt="AMSTERDAM STUDIO VERHUUR">
                                </div>
                            </div>
                            <h4 class="font-weight-bold text-uppercase m-0 p-0 text-center mt-2">STUDIO VERHUUR</h4>
                            <div class="icon-box icon-box-style-3 appear-animation " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                                <div class="icon-box-info mt-2">
                                    <p>De studio is bijzonder uniek door onze vernieuwde 360° limbo drive-in fotostudio.
                                        Wij bieden eveneens een grote flat fotostudio wall.
                                        Binnen onze grote fotostudio kunnen tegelijkertijd meerdere
                                        shooting sets worden opgebouwd en vanuit
                                        verschillende shooting corners.
                                    </p>
                                </div>
                            </div>
                        </a>
                        @else
                            <a href="{{ route('studio') }}" title="AMSTERDAM STUDIO RENTAL">
                            <div class="image-frame overlay overlay-show overlay-op-1 image-frame-style-1 image-frame-effect-1 image-frame-style-5 mt-2">
                                <div class="image-frame-wrapper">
                                    <img src="/studio-limbo-amsterdam.jpg" class="img-fluid" alt="AMSTERDAM STUDIO VERHUUR">
                                </div>
                            </div>
                            <h4 class="font-weight-bold text-uppercase m-0 p-0 text-center mt-2">STUDIO HIRE</h4>
                            <div class="icon-box icon-box-style-3 appear-animation " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                                <div class="icon-box-info mt-2">
                                    <p>We are a full infinity cove and drive-in studio. Aswell, we have a large flat studio wall for multiple shooting possibilities within the same space.</p>
                                </div>
                            </div>
                        @endif
                        </a>
                </div>

                <div class="col-sm-6 col-lg-4 bg-white">
                    @if(config('app.locale') ==  'nl')
                        <a href="{{ route('rental') }}" title="AMSTERDAM CAMERA & LICHT VERHUUR">
                            <div class="image-frame overlay overlay-show overlay-op-1 image-frame-style-1 image-frame-effect-1 image-frame-style-5 mt-2">
                                <div class="image-frame-wrapper">
                                    <img src="/studiowesterpark-lichtenverhuur.jpg" class="img-fluid" alt="AMSTERDAM CAMERA & LICHT VERHUUR">
                                </div>
                            </div>

                            <h4 class="font-weight-bold text-uppercase m-0 p-0 text-center mt-2">CAMERA & LICHT VERHUUR</h4>
                            <div class="icon-box icon-box-style-3 appear-animation " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                                <div class="icon-box-info mt-2">
                                    <p>Wij hebben een totaalpakket voor uw filmproducties en fotoshoots,waardoor uw producties kosten- en tijdbesparend worden. Een diversiteit aan LED lichten, ARRIMAX en ARRISUN-range, Briese, de nieuwste Kino Flo, Jokerbug, Profoto, Broncolor, Chimeras & Octadomes en specifieke greenscreen belichting. Grip is tevens beschikbaar.
                                    </p>
                                </div>
                            </div>
                        </a>
                    @else
                        <a href="{{ route('rental') }}" title="AMSTERDAM CAMERA & LIGHT RENTAL">

                            <div class="image-frame overlay overlay-show overlay-op-1 image-frame-style-1 image-frame-effect-1 image-frame-style-5 mt-2">
                                <div class="image-frame-wrapper">
                                    <img src="/studiowesterpark-lichtenverhuur.jpg" class="img-fluid" alt="AMSTERDAM CAMERA & LIGHT RENTAL">
                                </div>
                            </div>

                            <h4 class="font-weight-bold text-uppercase m-0 p-0 text-center mt-2">CAMERA & LIGHT RENTAL</h4>
                            <div class="icon-box icon-box-style-3 appear-animation " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                                <div class="icon-box-info mt-2">
                                    <p>We can deliver and assist on all your lighting and equipment needs, whether on location or in the rental studio.</p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>

                <div class="col-sm-6 col-lg-4 bg-white">
                    @if(config('app.locale') ==  'nl')
                    <a href="https://www.cinegear.nl" target="_blank" title="AMSTERDAM CINEGEAR CINEMA SHOP">

                        <div class="image-frame overlay overlay-show overlay-op-1 image-frame-style-1 image-frame-effect-1 image-frame-style-5 mt-2">
                            <div class="image-frame-wrapper">
                                <img src="/Kinefinity_mavoedge_8k_sale_Buy_mavoedge_cinegear_CINE-Gear_EDGE8K_best-price.jpg" class="img-fluid" alt="AMSTERDAM CINEGEAR CINEMA SHOP">
                            </div>
                        </div>


                        <h4 class="font-weight-bold text-uppercase m-0 p-0 text-center mt-2">CINEGEAR SHOP</h4>

                        <div class="icon-box icon-box-style-3 appear-animation " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                            <div class="icon-box-info mt-2">
                                <p>We updaten continue de gallery voor een totale impressie van Westerpark Studio projecten.
                                    Er zijn 'behind the scenes' van de film en fotostudio, zoals volledig
                                    afgeronde foto campagnes en video's.</p>
                            </div>
                        </div>
                    </a>
                    @else
                        <a href="https://www.cinegear.nl" target="_blank" title="AMSTERDAM CINEGEAR CINEMA SHOP">

                            <div class="image-frame overlay overlay-show overlay-op-1 image-frame-style-1 image-frame-effect-1 image-frame-style-5 mt-2">
                                <div class="image-frame-wrapper">
                                    <img src="/Kinefinity_mavoedge_8k_sale_Buy_mavoedge_cinegear_CINE-Gear_EDGE8K_best-price.jpg" class="img-fluid" alt="CINEGEAR SHOP">
                                </div>
                            </div>


                            <h4 class="font-weight-bold text-uppercase m-0 p-0 text-center mt-2">CINEGEAR SHOP</h4>

                            <div class="icon-box icon-box-style-3 appear-animation " data-appear-animation="fadeInUpShorter" data-appear-animation-delay="400">
                                <div class="icon-box-info mt-2">
                                    <p>We continuously update the gallery for a total impression of Westerpark Studio projects.
                                        There are "behind the scenes" from the film and photo studio, such as fully
                                        completed photo campaigns and videos.</p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>

            </div>
        </div>
@endsection

