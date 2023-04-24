@push('styles')
    <style>
        .required::after {
            content: " *" !important;
            color: red !important;
        }
    </style>
@endpush



@if (isset($fornecedor->id))
    <form method="post" action="{{ route('fornecedor.update', ['fornecedor' => Crypt::encrypt($fornecedor->id)]) }}"
        class="row">
        @csrf
        @method('PUT')
    @else
        <form method="post" action="{{ route('fornecedor.store') }}" class="row">
            @csrf
@endif

<div class="col-md-6 mb-3">
    <label class="required" for="nome">Nome</label>
    <input type="text" maxlength="50" required value="{{ $fornecedor->nome ?? old('nome') }}" id="nome"
        name="nome" placeholder="Nome" class="form-control form-control-line">
</div>

<div class="col-md-6 mb-3">
    <label class="required" for="site">Site</label>
    <input type="text" maxlength="50" required value="{{ $fornecedor->site ?? old('site') }}" id="site"
        name="site" placeholder="Site" class="form-control form-control-line">
</div>

<div class="col-md-6 mb-3">
    <label class="required" for="email">Email</label>
    <input type="email" maxlength="50" required value="{{ $fornecedor->email ?? old('email') }}" id="email"
        name="email" placeholder="E-mail" class="form-control form-control-line">
</div>

@php
    $ufSelected = $fornecedor->uf ?? old('uf');
@endphp
<div class="col-md-6 mb-3">
    <label class="required" for="uf">UF</label>
    <select required name="uf" id="uf" class="form-select">
        <option value="AC" {{ $ufSelected == 'AC' ? 'selected' : '' }}>
            Acre (AC)
        </option>
        <option value="AL" {{ $ufSelected == 'AL' ? 'selected' : '' }}>
            Alagoas (AL)
        </option>
        <option value="AP" {{ $ufSelected == 'AP' ? 'selected' : '' }}>
            Amapá (AP)
        </option>
        <option value="AM" {{ $ufSelected == 'AM' ? 'selected' : '' }}>
            Amazonas (AM)
        </option>
        <option value="BA" {{ $ufSelected == 'BA' ? 'selected' : '' }}>
            Bahia (BA)
        </option>
        <option value="CE" {{ $ufSelected == 'CE' ? 'selected' : '' }}>
            Ceará (CE)
        </option>
        <option value="DF" {{ $ufSelected == 'DF' ? 'selected' : '' }}>
            Distrito Federal (DF)
        </option>
        <option value="ES" {{ $ufSelected == 'ES' ? 'selected' : '' }}>
            Espírito Santo (ES)
        </option>
        <option value="GO" {{ $ufSelected == 'GO' ? 'selected' : '' }}>
            Goiás (GO)
        </option>
        <option value="MA" {{ $ufSelected == 'MA' ? 'selected' : '' }}>
            Maranhão (MA)
        </option>
        <option value="MT" {{ $ufSelected == 'MT' ? 'selected' : '' }}>
            Mato Grosso (MT)
        </option>
        <option value="MS" {{ $ufSelected == 'MS' ? 'selected' : '' }}>
            Mato Grosso do Sul (MS)
        </option>
        <option value="MG" {{ $ufSelected == 'MG' ? 'selected' : '' }}>
            Minas Gerais (MG)
        </option>
        <option value="PA" {{ $ufSelected == 'PA' ? 'selected' : '' }}>
            Pará (PA)
        </option>
        <option value="PB" {{ $ufSelected == 'PB' ? 'selected' : '' }}>
            Paraíba (PB)
        </option>
        <option value="PR" {{ $ufSelected == 'PR' ? 'selected' : '' }}>
            Paraná (PR)
        </option>
        <option value="PE" {{ $ufSelected == 'PE' ? 'selected' : '' }}>
            Pernambuco (PE)
        </option>
        <option value="PI" {{ $ufSelected == 'PI' ? 'selected' : '' }}>
            Piauí (PI)
        </option>
        <option value="RJ" {{ $ufSelected == 'RJ' ? 'selected' : '' }}>
            Rio de Janeiro (RJ)
        </option>
        <option value="RN" {{ $ufSelected == 'RN' ? 'selected' : '' }}>
            Rio Grande do Norte (RN)
        </option>
        <option value="RS" {{ $ufSelected == 'RS' ? 'selected' : '' }}>
            Rio Grande do Sul (RS)
        </option>
        <option value="RO" {{ $ufSelected == 'RO' ? 'selected' : '' }}>
            Rondônia (RO)
        </option>
        <option value="RR" {{ $ufSelected == 'RR' ? 'selected' : '' }}>
            Roraima (RR)
        </option>
        <option value="SC" {{ $ufSelected == 'SC' ? 'selected' : '' }}>
            Santa Catarina (SC)
        </option>
        <option value="SP" {{ $ufSelected == 'SP' ? 'selected' : '' }}>
            São Paulo (SP)
        </option>
        <option value="SE" {{ $ufSelected == 'SE' ? 'selected' : '' }}>
            Sergipe (SE)
        </option>
        <option value="TO" {{ $ufSelected == 'TO' ? 'selected' : '' }}>
            Tocantins (TO)
        </option>
    </select>
</div>



<div class="form-group">
    <div class="col-sm-12 d-flex justify-content-end">
        <button class="btn btn-primary text-white">
            @if (isset($fornecedor->id))
                Atualizar
            @else
                Cadastrar
            @endif
        </button>
    </div>
</div>
<form>


    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#uf').select2();
            });
        </script>
    @endpush
