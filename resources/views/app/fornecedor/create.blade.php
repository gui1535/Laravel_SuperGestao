@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-9">

                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex
                            align-items-center">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('app.home') }}" class="link">
                                        <i class="mdi mdi-home-outline fs-4"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('fornecedor.index') }}" class="link">
                                        Fornecedor
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ isset($fornecedor) ? 'Editar' : 'Novo' }}
                                </li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">
                            {{ isset($fornecedor) ? 'Editar Fornecedor' : 'Novo Fornecedor' }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-12">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-12">

                    @include('app.fornecedor._components.form_create_edit')
                </div>
            </div>
        </div>

    </div>

@endsection
