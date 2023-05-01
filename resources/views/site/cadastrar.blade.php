@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 p-1">
                <h1 class="text-center">Cadastrar</h1>
                <div class="d-flex justify-content-center align-items-center mt-1">
                    @if ($errors->any())
                        <div class="w-30 alert alert-danger mb-1 mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 p-1">
                <div class="mt-4 d-flex justify-content-center align-items-center">
                    <form action={{ route('site.cadastrar') }} method="post" class="w-30">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="required">Nome</label>
                            <input name="nome" maxlength="60" required value="{{ old('nome') }}" type="text"
                                placeholder="Nome" id="nome" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="cnpj" class="required">CNPJ</label>
                            <input name="cnpj" required id="cnpj" value="{{ old('cnpj') }}"
                                data-mask="00.000.000/0000-00" type="text" placeholder="CNPJ" class="form-control">
                            <span id="error-cnpj-invalido" class="text-danger"></span>
                            <span class="d-flex gap-1 mt-1">
                                <input id="gerar-cnpj-aleatorio" type="checkbox">
                                <label for="gerar-cnpj-aleatorio">Gerar CNPJ aleatório</label>
                            </span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="required">Email</label>
                            <input name="email" maxlength="60" value="{{ old('email') }}" required id="email"
                                type="text" placeholder="exemplo@dominio.com" class="form-control">
                        </div>
                        {{-- <div class="mb-3">
                            <label for="telefone">Telefone</label>
                            <input name="telefone" id="telefone" value="{{ old('telefone') }}" type="text" placeholder="(00) 00000-0000"
                                class="form-control">
                        </div> --}}
                        <div class="mb-3">
                            <label for="senha" class="required">Senha</label>
                            <input name="senha" id="senha" value="{{ old('senha') }}" type="password"
                                placeholder="****" class="form-control">
                        </div>
                        <p>
                            Já possui cadastro?
                            <a href="{{ route('site.login') }}" class="text-decoration-none">
                                Fazer login
                            </a>
                        </p>
                        <br>
                        <button type="submit" class="btn btn-primary w-100">Acessar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('js/site/contato.js') }}"></script>
@endpush
