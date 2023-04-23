@extends('app.layouts.basico')

@section('titulo', 'Cliente')
@push('styles')
@endpush
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
                                    <th scope="col">Email</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->nome }}</td>
                                        <td>{{ $cliente->email }}</td>
                                        <td class="text-center d-flex justify-content-center">
                                            <a
                                                href="{{ route('cliente.edit', ['cliente' => Crypt::encrypt($cliente->id)]) }}">
                                                <button class="btn">
                                                    <i class="mdi mdi-lead-pencil fs-4"></i>
                                                </button>
                                            </a>

                                            <form method="POST"
                                                action="{{ route('cliente.destroy', ['cliente' => Crypt::encrypt($cliente->id)]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" data-nome="{{ $cliente->nome }}"
                                                    class="btn btn-delete-cliente">
                                                    <i class="mdi mdi-delete-circle fs-4"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="999" class="text-center text-danger">
                                            Não há clientes cadastrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="">
                                <span>
                                    Exibindo {{ $clientes->count() }} clientes de {{ $clientes->total() }}
                                    @if (count($clientes) != 0)
                                        (de {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }})
                                    @endif
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

@push('scripts')
    <script src="{{ asset('js/app/pages/cliente/cliente.js') }}"></script>
@endpush
