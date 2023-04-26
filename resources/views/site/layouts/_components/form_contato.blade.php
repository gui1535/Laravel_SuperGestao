{{ $slot }}
<form action={{ route('site.contato') }} method="post">
    @csrf
    <div class="col-md-12 mb-3">
        <label for="nome" class="form-label required">Nome</label>
        <input name="nome" class="form-control" required id="nome" value="{{ old('nome') }}" type="text"
            placeholder="Nome">
    </div>

    <div class="col-md-12 mb-3">
        <label for="telefone" class="form-label required">Telefone</label>
        <input name="telefone" class="form-control" required id="telefone" value="{{ old('telefone') }}" type="text"
            placeholder="Telefone">
    </div>

    <div class="col-md-12 mb-3">
        <label for="email" class="form-label required">Email</label>
        <input name="email" class="form-control" required id="email" value="{{ old('email') }}" type="text"
            placeholder="E-mail">
    </div>

    <div class="col-md-12 mb-3">
        <label for="motivo-contato" class="form-label required">Motivo de Contato</label>
        <select name="motivo-contato" required class="form-select cursor-pointer">
            <option value="">Qual o motivo do contato?</option>

            @foreach ($motivo_contatos as $key => $motivo_contato)
                <option value="{{ $motivo_contato->id }}"
                    {{ old('motivo-contato') == $motivo_contato->id ? 'selected' : '' }}>
                    {{ $motivo_contato->motivo_contato }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12 mb-3">
        <label for="mensagem" class="form-label required">Mensagem</label>
        <textarea name="mensagem" required id="mensagem" class="form-control">{{ old('mensagem') != '' ? old('mensagem') : '' }}</textarea>
    </div>

    <button type="submit" class="btn btn-success w-100">ENVIAR</button>
</form>

@if ($errors->any())
    <div style="position:absolute; top:0px; left:0px; width:100%; background:red">

        @foreach ($errors->all() as $erro)
            {{ $erro }}
            <br>
        @endforeach

    </div>
@endif

@push('scripts')
    <script src="{{ asset('js/site/contato.js') }}"></script>
@endpush
