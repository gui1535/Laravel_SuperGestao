@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')

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
                            <li class="breadcrumb-item active" aria-current="page">Fornecedor</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Fornecedor</h1>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('fornecedor.create') }}">
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
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
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
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-c">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">UF</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Site</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($fornecedores as $fornecedor)
                                    <tr>
                                        <td >{{ $fornecedor->nome }}</td>
                                        <td >{{ $fornecedor->uf }}</td>
                                        <td >{{ $fornecedor->email }}</td>
                                        <td >{{ $fornecedor->site }}</td>
                                        <td class="text-center d-flex justify-content-center">

                                            <a href="{{ route('fornecedor.edit', ['fornecedor' => Crypt::encrypt($fornecedor->id)]) }}">
                                                <button class="btn">
                                                    <i class="mdi mdi-lead-pencil fs-4"></i>
                                                </button>
                                            </a>

                                            <form method="POST"
                                                action="{{ route('fornecedor.destroy', ['fornecedor' => Crypt::encrypt($fornecedor->id)]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" data-nome="{{ $fornecedor->nome }}"
                                                    class="btn btn-delete-fornecedor">
                                                    <i class="mdi mdi-delete-circle fs-4"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="999" class="text-center text-danger">
                                            Não há fornecedores cadastrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="">
                                <span>
                                    Exibindo {{ $fornecedores->count() }} fornecedores de {{ $fornecedores->total() }}
                                    @if (count($fornecedores) != 0)
                                        (de {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }})
                                    @endif
                                </span>

                            </div>
                            <div>
                                <span>
                                    {{ $fornecedores->links('pagination::bootstrap-4') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
