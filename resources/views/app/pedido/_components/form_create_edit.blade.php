    @push('styles')
        <style>
            .required::after {
                content: " *" !important;
                color: red !important;
            }
        </style>
    @endpush
    @if (count($clientes) != 0 && count($produtos) != 0)

        @if (isset($pedido->id))
            <form method="post" action="{{ route('pedido.update', ['pedido' => Crypt::encrypt($pedido->id)]) }}"
                class="row">
                @csrf
                @method('PUT')
            @else
                <form method="post" action="{{ route('pedido.store') }}" class="row">
                    @csrf
        @endif
    @else
        <div class="row">
    @endif
    <div class="col-md-6 mb-3">
        <label class="required" for="codigo">Código</label>
        <input type="text" maxlength="30" required value="{{ $pedido->codigo ?? old('codigo') }}" id="codigo"
            name="codigo" placeholder="Código" class="form-control form-control-line">
    </div>

    <div class="col-md-6 mb-3">
        <label class="required" for="codigo">Cliente</label>
        <select required name="cliente" id="cliente" class="form-select">
            <option value=""></option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                    {{ ($pedido->cliente_id ?? old('cliente')) == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <div class="text-center text-white p-2 fs-3 bg-blue-primary">
            Produtos
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <label class="required" for="codigo">Produto</label>
        <select required id="produto" class="form-select select2-produtos">
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}"
                    {{ ($pedido->cliente_id ?? old('cliente')) == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
    </div>

    @if (count($clientes) != 0 && count($produtos) != 0)
        <div class="form-group">
            <div class="col-sm-12 d-flex justify-content-end">
                <button class="btn btn-primary text-white">
                    @if (isset($pedido->id))
                        Atualizar
                    @else
                        Cadastrar
                    @endif
                </button>
            </div>
        </div>
    @endif
    @if (count($clientes) != 0 && count($produtos) != 0)
        </form>
    @else
        </div>
    @endif
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#cliente').select2();
                $('#produto').select2();
            });
        </script>
    @endpush
