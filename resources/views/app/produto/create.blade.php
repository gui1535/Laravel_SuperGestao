@extends('app.layouts.basico')

@section('titulo', 'Produto')

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
                                    <a href="{{ route('produto.index') }}" class="link">
                                        Produto
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ isset($produto) ? 'Editar' : 'Novo' }}
                                </li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">
                            {{ isset($produto) ? 'Editar Produto' : 'Novo Produto' }}
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
                @if (count($fornecedores) == 0)
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <ul>
                                <li>
                                    Não há fornecedores cadastrados para criar um novo produto.
                                    <a class="text-danger" href="{{ route('app.fornecedor.adicionar') }}">Cadastrar Fornecedor</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
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

                    @component('app.produto._components.form_create_edit', ['unidades' => $unidades, 'fornecedores' => $fornecedores])
                    @endcomponent
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/app/pages/produto/produto.js') }}"></script>
@endpush
