@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 p-1">
                <h1 class="text-center">Login</h1>
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
                    <form action={{ route('site.login') }} method="post" class="w-30">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input name="email" value="{{ old('email') }}" type="text" placeholder="Email"
                                id="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password">Senha</label>
                            <input name="password" id="password" type="password" placeholder="Senha" class="form-control">
                        </div>
                        <p>
                            Não possui cadastro?
                            <a href="" class="text-decoration-none">
                                Cadastre-se
                            </a>
                        </p>
                        <br>
                        <button type="submit" class="btn btn-success w-100">Acessar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
