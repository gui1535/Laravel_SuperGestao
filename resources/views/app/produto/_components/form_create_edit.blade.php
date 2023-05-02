@push('styles')
    <style>
        .required::after {
            content: " *" !important;
            color: red !important;
        }
    </style>
@endpush
@if (count($fornecedores) != 0)
    @if (isset($produto->id))
        <form method="post" action="{{ route('produto.update', ['produto' => Crypt::encrypt($produto->id)]) }}"
            class="row">
            @csrf
            @method('PUT')
        @else
            <form method="post" action="{{ route('produto.store') }}" class="row">
                @csrf
    @endif
@else
    <div class="row">
@endif
<div class="col-md-5 mb-3">
    <label class="required" for="nome">Nome</label>
    <input type="text" maxlength="50" required name="nome" value="{{ $produto->nome ?? old('nome') }}"
        id="nome" placeholder="Nome" class="form-control">
</div>

<div class="col-md-4 mb-3">
    <label class="required" for="fornecedor">Fornecedor</label>
    <select required name="fornecedor" id="fornecedor" class="form-select">
        <option value=""></option>
        @foreach ($fornecedores as $fornecedor)
            <option value="{{ $fornecedor->id }}"
                {{ ($produto->fornecedor_id ?? old('fornecedor')) == $fornecedor->id ? 'selected' : '' }}>
                {{ $fornecedor->nome }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-3 mb-3">
    <label class="required" for="unidade">
        Medida
    </label>
    <select required name="unidade" id="unidade" class="form-select">
        <option value=""></option>
        @foreach ($unidades as $unidade)
            <option value="{{ $unidade->id }}"
                {{ ($produto->detalhes[0]->unidade_id ?? old('unidade')) == $unidade->id ? 'selected' : '' }}>
                {{ $unidade->descricao }}
            </option>
        @endforeach
    </select>
</div>

<div class="col-md-2 mb-3">
    <label for="preco" class="required">Preço</label>
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">R$</span>
        <input type="text" required name="preco" value="{{ $produto->detalhes[0]->preco_venda ?? old('preco') }}"
            id="preco" placeholder="Preço" class="form-control preco">
    </div>
</div>

<div class="col-md-2 mb-3">
    <label for="peso">Peso (Gramas)</label>
    <input type="text" name="peso" value="{{ $produto->detalhes[0]->peso ?? old('peso') }}" id="peso"
        placeholder="Peso" class="form-control">
</div>

{{-- <div class="col-md-3 mb-3">
    <label for="estoque_minimo">Estoque Mínimo</label>
    <input type="text" name="estoque_minimo"
        value="{{ $produto->detalhes[0]->estoque_minimo ?? old('estoque_minimo') }}" id="estoque_minimo" placeholder="0"
        class="form-control estoque">
</div> --}}

{{-- <div class="col-md-3 mb-3">
    <label for="estoque_maximo">Estoque Maximo</label>
    <input type="text" name="estoque_maximo"
        value="{{ $produto->detalhes[0]->estoque_maximo ?? old('estoque_maximo') }}" id="estoque_maximo" placeholder="0"
        class="form-control estoque">
</div> --}}

<div class="col-md-2 mb-3">
    <label for="comprimento">Comprimento (Centimetros)</label>
    <input type="text" name="comprimento" value="{{ $produto->detalhes[0]->comprimento ?? old('comprimento') }}"
        id="comprimento" placeholder="Comprimento" class="form-control centimetros">
</div>

<div class="col-md-3 mb-3">
    <label for="altura">Altura (Centimetros)</label>
    <input type="text" name="altura" value="{{ $produto->detalhes[0]->altura ?? old('altura') }}" id="altura"
        placeholder="Altura" class="form-control centimetros">
</div>

<div class="col-md-3 mb-3">
    <label for="largura">Largura (Centimetros)</label>
    <input type="text" name="largura" value="{{ $produto->detalhes[0]->largura ?? old('largura') }}" id="largura"
        placeholder="Largura" class="form-control centimetros">
</div>

<div class="col-md-12 mb-3">
    <label for="descricao">Descrição</label>
    <input type="text" maxlength="255" name="descricao" value="{{ $produto->descricao ?? old('descricao') }}"
        id="descricao" placeholder="Descrição" class="form-control">
</div>
@if (count($fornecedores) != 0)

    <div class="form-group">
        <div class="col-sm-12 d-flex justify-content-end">
            <button class="btn btn-primary text-white">
                @if (isset($produto->id))
                    Atualizar
                @else
                    Cadastrar
                @endif
            </button>
        </div>
    </div>
    <form>
    @else
        </div>
@endif

@push('scripts')
@endpush
