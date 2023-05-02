@extends('app.layouts.basico')

@section('titulo', 'Pedido')

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
                            <li class="breadcrumb-item active" aria-current="page">Pedido</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Pedido</h1>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pedido.create') }}">
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
                                    <th class="text-center" scope="col">Código</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Preço Total</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pedidos as $pedido)
                                    <tr>
                                        <td class="text-center">{{ $pedido->codigo }}</td>
                                        <td>{{ $pedido->cliente->nome }}</td>
                                        <td>
                                            <span>R$ </span>
                                            <span class="preco">
                                                {{ $pedido->precoTotal }}
                                            </span>
                                        </td>
                                        <td class="text-center d-flex justify-content-center">

                                            <a href="{{ route('pedido.edit', ['pedido' => Crypt::encrypt($pedido->id)]) }}">
                                                <button class="btn">
                                                    <i class="mdi mdi-lead-pencil fs-4"></i>
                                                </button>
                                            </a>

                                            <form method="POST"
                                                action="{{ route('pedido.destroy', ['pedido' => Crypt::encrypt($pedido->id)]) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" data-codigo="{{ $pedido->codigo }}"
                                                    class="btn btn-delete-pedido">
                                                    <i class="mdi mdi-delete-circle fs-4"></i>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="999" class="text-center text-danger">
                                            Não há pedidos cadastrados
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="w-100 d-flex justify-content-between">
                            <div class="">
                                <span>
                                    Exibindo {{ $pedidos->count() }} pedidos de {{ $pedidos->total() }}
                                    @if (count($pedidos) != 0)
                                        (de {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }})
                                    @endif
                                </span>

                            </div>
                            <div>
                                <span>
                                    {{ $pedidos->links('pagination::bootstrap-4') }}
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
    <script src="{{ asset('js/app/pages/pedido/pedido.js') }}"></script>
@endpush
