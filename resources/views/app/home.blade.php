@extends('app.layouts.basico')

@section('titulo', 'Home')

@section('conteudo')
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex
                        align-items-center">
                        <li class="breadcrumb-item">
                            <a href="{{ route('app.home') }}" class="link">
                                <i class="mdi mdi-home-outline fs-4"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
                <h1 class="mb-0 fw-bold">Home</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            Aqui é a HOME
        </div>
    </div>
@endsection
