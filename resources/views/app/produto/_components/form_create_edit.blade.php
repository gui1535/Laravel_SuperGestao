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
        <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}" class="row">
            @csrf
            @method('PUT')
        @else
            <form method="post" action="{{ route('produto.store') }}" class="row">
                @csrf
    @endif
@else
    <div class="row">
@endif
<div class="col-md-6 mb-3">
    <label class="required" for="nome">Nome</label>
    <input type="text" maxlength="50" required name="nome" value="{{ $produto->nome ?? old('nome') }}"
        id="nome" placeholder="Nome" class="form-control">
</div>

<div class="col-md-6 mb-3">
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

<div class="col-md-6 mb-3">
    <label class="required" for="unidade">Medida</label>
    <select required name="unidade" id="unidade" class="form-select">
        <option value=""></option>
        @foreach ($unidades as $unidade)
            <option value="{{ $unidade->id }}"
                {{ ($produto->unidade_id ?? old('unidade')) == $unidade->id ? 'selected' : '' }}>
                {{ $unidade->descricao }}</option>
        @endforeach
    </select>
</div>

<div class="col-md-6 mb-3">
    <label for="peso">Peso</label>
    <input type="text" name="peso" value="{{ $produto->peso ?? old('peso') }}" id="peso" placeholder="Peso"
        class="form-control">
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
    <script>
        $(document).ready(function() {
            $('#fornecedor').select2();
            $('#unidade').select2();
        });
    </script>
@endpush
