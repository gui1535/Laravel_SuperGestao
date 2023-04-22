@extends('site.layouts.basico')

@section('titulo', 'Home')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/site/principal.css') }}">
@endpush

@section('conteudo')
    <div class="container principal mt-5 mb-5">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 col-principal-info p-3">
                <div class="d-flex flex-column mb-4 gap-2">
                    <h1>Sistema Super Gestão</h1>
                    <p>
                        Software para gestão empresarial ideal para sua empresa.
                    </p>
                    <div>
                        <div class="d-flex gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span>Gestão completa e descomplicada</span>
                        </div>
                        <div class="d-flex gap-2">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span>Sua empresa na nuvem</span>
                        </div>
                    </div>
                </div>

                <img class="img-fluid w-90" src="{{ asset('img/player_video.jpg') }}">
            </div>

            <div class="col-lg-5 col-md-12 col-sm-12 col-principal-contato">
                <h2 class="fs-1">Contato</h2>
                <p>
                    Caso tenha qualquer dúvida por favor entre em contato com nossa equipe pelo formulário abaixo.
                </p>
                @component('site.layouts._components.form_contato', [
                    'motivo_contatos' => $motivo_contatos,
                ])
                @endcomponent
            </div>
        </div>
    </div>
@endsection
