@push('styles')
    <style>
        .required::after {
            content: " *" !important;
            color: red !important;
        }
    </style>
@endpush

@if (isset($cliente->id))
    <form method="post" action="{{ route('cliente.update', ['cliente' => Crypt::encrypt($cliente->id)]) }}" class="row">
        @csrf
        @method('PUT')
    @else
        <form method="post" action="{{ route('cliente.store') }}" class="row">
            @csrf
@endif
<div class="col-md-6 mb-3">
    <label class="required" for="nome">Nome</label>
    <input type="text" maxlength="60" required value="{{ $cliente->nome ?? old('nome') }}" id="nome"
        name="nome" placeholder="Nome" class="form-control form-control-line">
</div>
<div class="col-md-6 mb-3">
    <label for="email" class="required">Email</label>
    <input type="email" maxlength="60" required value="{{ $cliente->email ?? old('email') }}" placeholder="E-mail"
        class="form-control form-control-line" name="email" id="email">
</div>
<div class="form-group">
    <label class="col-md-12">Observações</label>
    <div class="col-md-12">
        <textarea rows="5" maxlength="255" name="observacoes" class="form-control form-control-line">{{ $cliente->observacoes ?? old('observacoes') }}</textarea>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12 d-flex justify-content-end">
        <button class="btn btn-primary text-white">
            @if (isset($cliente->id))
                Atualizar
            @else
                Cadastrar
            @endif
        </button>
    </div>
</div>
</form>
