@extends('app.layouts.basico')

@section('titulo', 'Cliente')
@push('styles')
    <style>
        nav svg {
            width: 28px !important;
            padding: 7px 5px;
        }
    </style>
@endpush
@section('conteudo')
    {{-- <div class="conteudo-pagina">

        <div class="menu">
            <ul>
                <li><a href="{{ route('cliente.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </head>

                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nome }}</td>
                                <td><a href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}">Visualizar</a></td>
                                <td>
                                    <form id="form_{{ $cliente->id }}" method="post"
                                        action="{{ route('cliente.destroy', ['cliente' => $cliente->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                        <a href="#"
                                            onclick="document.getElementById('form_{{ $cliente->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $clientes->appends($request)->links() }}

                <!--
                                                                            <br>
                                                                            {{ $clientes->count() }} - Total de registros por página
                                                                            <br>
                                                                            {{ $clientes->total() }} - Total de registros da consulta
                                                                            <br>
                                                                            {{ $clientes->firstItem() }} - Número do primeiro registro da página
                                                                            <br>
                                                                            {{ $clientes->lastItem() }} - Número do último registro da página

                                                                            -->
                <br>
                Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }} (de {{ $clientes->firstItem() }} a
                {{ $clientes->lastItem() }})
            </div>
        </div>
    </div> --}}


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
                            <li class="breadcrumb-item active" aria-current="page">Cliente</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Cliente</h1>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('cliente.create') }}">
                        <button class="btn btn-primary">
                            Novo
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-c">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->nome }}</td>
                                        <td class="text-center">
                                            <button class="btn">
                                                <i class="mdi mdi-delete-circle fs-4"></i>
                                            </button>

                                            <button class="btn">
                                                <i class="mdi mdi-lead-pencil fs-4"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="">
                                <span>
                                    Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }} (de
                                    {{ $clientes->firstItem() }} a
                                    {{ $clientes->lastItem() }})
                                </span>

                            </div>
                            <div>
                                <span>
                                    {{ $clientes->links('pagination::bootstrap-4') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
