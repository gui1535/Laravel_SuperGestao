@extends('app.layouts.basico')

@section('titulo', 'Pedido')

@section('conteudo')
    <div class="conteudo-pagina">

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-10">
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
                <div class="col-2 h-100 d-flex justify-content-end align-items-center">
                    <span id="preco-total-pedido" class="fs-2"></span>
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
                                        Não há produtos cadastrados, mas você poderá criar um
                                        pedido sem produtos e edita-lo futuramente.
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

                    @component('app.pedido._components.form_create_edit', [
                        'clientes' => $clientes,
                        'produtos' => $produtos,
                        'pedido' => $pedido ?? '',
                    ])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#btn-submit').on('click', function(e) {
            $('#form-pedido').find('input[required]').each(function() {
                if (!$(this).val()) {
                    return false;
                } else {
                    if ($('[name="produtos[]"]').val() == undefined) {
                        e.preventDefault();
                        bootbox.confirm({
                            title: 'Alerta',
                            message: `Tem certeza que deseja criar um pedido sem nenhum produto?`,
                            buttons: {
                                cancel: {
                                    label: '<i class="fa fa-times"></i> Cancelar'
                                },
                                confirm: {
                                    label: '<i class="fa fa-check"></i> Continuar'
                                }
                            },
                            callback: function(result) {
                                if (result) {
                                    $('#produto').val('123')
                                    $('#form-pedido').submit();
                                }
                            }
                        });
                        return false;
                    }
                }
            });
        })
    </script>
@endpush
