@extends('app.layouts.basico')

@section('titulo', 'Pedido')

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
                                    <a href="{{ route('pedido.index') }}" class="link">
                                        Pedido
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ isset($pedido) ? 'Editar' : 'Novo' }}
                                </li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">
                            {{ isset($pedido) ? 'Editar Pedido' : 'Novo Pedido' }}
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

                @if (count($clientes) == 0 || count($produtos) == 0)
                    <div class="col-12">
                        <div class="alert alert-danger">
                            <ul>
                                @if (count($clientes) == 0)
                                    <li>
                                        Não há clientes cadastrados para criar um novo pedido.
                                        <a class="text-danger" href="{{ route('cliente.create') }}">Cadastrar Cliente</a>
                                    </li>
                                @endif
                                @if (count($produtos) == 0)
                                    <li>
                                        Não há produtos cadastrados para criar um novo pedido.
                                        <a class="text-danger" href="{{ route('produto.create') }}">Cadastrar Produto</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>

                <div class="col-12">

                    @component('app.pedido._components.form_create_edit', ['clientes' => $clientes, 'produtos' => $produtos])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection
