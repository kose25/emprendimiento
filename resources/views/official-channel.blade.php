@extends('adminlte::page')
@section('title', 'Inicio')

@section('css')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content_header')
<h1>Comunicados Oficiales</h1>
@stop
@section('content')
<div class="row">
    <div class="col-2 d-none d-md-block">
        <div class="sticky-top mt-4">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner py-2" style="background-color: white; border-radius: 15px;">
                    <div class="carousel-item active">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/capamara de pamplona.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/corp-futures.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/LABCO-Diselo-logo.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/logo CTC.jpg')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/logo gobernación.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/logocorpomix2png.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/capamara de pamplona.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/corp-futures.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 text-center">
                                <img src="{{asset('img/slider/LABCO-Diselo-logo.png')}}" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-12 d-md-none my-2">
        <div class="sticky-top">
            <div id="carouselExampleSlidesOnly2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner py-4" style="background-color: white; border-radius: 15px;">
                    <div class="carousel-item active">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/capamara de pamplona.png')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/corp-futures.png')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/LABCO-Diselo-logo.png')}}" class="img-fluid" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/logo CTC.jpg')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/logo gobernación.png')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/logocorpomix2png.png')}}" class="img-fluid" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/capamara de pamplona.png')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/corp-futures.png')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/UA Norte logo.jpg')}}" class="img-fluid" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="container">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/ufps.jpg')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/uniminuto.png')}}" class="img-fluid" alt="...">
                                </div>
                                <div class="col-4 text-center">
                                    <img src="{{asset('img/slider/LABCO-Diselo-logo.png')}}" class="img-fluid" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-6 offset-md-2">
        @if(Auth::user()->rol=='administrador'|| Auth::user()->rol=='entidad')
        <livewire:official-poster />
        @endif
        <!-- Box Comment -->
        <livewire:official-feed />
    </div>



</div>

@stop

@section('js')
<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://raw.githubusercontent.com/summernote/summernote/develop/lang/summernote-es-ES.js"></script>
<script type="text/javascript">
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    };
</script>
@livewireScripts



@endsection