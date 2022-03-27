{{-- Comentario --}}

@php

@endphp

@isset($fornecedores)
    @forelse ($fornecedores as $indice => $fornecedor)
        Iteração Atual:{{ $loop->iteration }}
        <br>
        fornecedores: {{ $fornecedor['nome'] }}
        <br>
        status: {{ $fornecedor['status'] }}
        <br>
        <!--Se a $variavel testada nao estiver definida ou $variavel testada possuir SOMENTE valor *NULL*, Execute 'Dado nao preenchido' -->
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado nao preenchido' }}
        <br>
        Telefone: ({{ $fornecedor['ddd'] ?? '' }} {{ $fornecedor['telefone'] ?? '' }})
        <br>
        @if($loop->first) 
            Primeira iteração do Loop
            <br>
            Total de registros: {{ $loop->count }} {{--Quantos valores tem no array percorrido--}}
        @endif
        @if($loop->last)
            Ultima iteração do Loop
            <br>
            Total de registros: {{ $loop->count }} {{--Quantos valores tem no array percorrido--}}
        @endif
        <hr>
    @empty
        Não existem fornecedores cadastrados
    @endforelse
@endisset

{{-- {{ 'Ola mundo' }}

------------------------------------------------------------

@php
echo"Ola mundo";
@endphp 

------------------------------------------------------------

fornecedores: {{ $fornecedores[0]['nome'] }}
<br>
status: {{ $fornecedores[0]['status'] }}
<br>
@if ($fornecedores[0]['status'] == 'N')
    fornecedor inativo
@endif
<br>

------------------------------------------------------------

@isset($fornecedores)
    @foreach ($fornecedores as $indice => $fornecedor)
        fornecedores: {{ $fornecedor['nome'] }}
        <br>
        status: {{ $fornecedor['status'] }}
        <br>
        <!--Se a $variavel testada nao estiver definida ou $variavel testada possuir SOMENTE valor *NULL*, Execute 'Dado nao preenchido' -->
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado nao preenchido' }}
        <br>
        Telefone: ({{ $fornecedor['ddd'] ?? '' }} {{ $fornecedor['telefone'] ?? '' }})
        <hr>
    @endforeach
@endisset

------------------------------------------------------------

@isset($fornecedores)
    @forelse ($fornecedores as $indice => $fornecedor)
        fornecedores: {{ $fornecedor['nome'] }}
        <br>
        status: {{ $fornecedor['status'] }}
        <br>
        <!--Se a $variavel testada nao estiver definida ou $variavel testada possuir SOMENTE valor *NULL*, Execute 'Dado nao preenchido' -->
        CNPJ: {{ $fornecedor['cnpj'] ?? 'Dado nao preenchido' }}
        <br>
        Telefone: ({{ $fornecedor['ddd'] ?? '' }} {{ $fornecedor['telefone'] ?? '' }})
        <hr>
    @empty
        Não existem fornecedores cadastrados
    @endforelse
@endisset

------------------------------------------------------------

@isset($fornecedores)
    @for ($i = 0; isset($fornecedores[$i]); $i++)
        fornecedores: {{ $fornecedores[$i]['nome'] }}
        <br>
        status: {{ $fornecedores[$i]['status'] }}
        <br>
        <!--Se a $variavel testada nao estiver definida ou $variavel testada possuir SOMENTE valor *NULL*, Execute 'Dado nao preenchido' -->
        CNPJ: {{ $fornecedores[$i]['cnpj'] ?? 'Dado nao preenchido' }}
        <br>
        Telefone: ({{ $fornecedores[$i]['ddd'] ?? '' }} {{ $fornecedores[$i]['telefone'] ?? '' }})
        <hr>
    @endfor
@endisset

------------------------------------------------------------

@isset($fornecedores)
    @php $i = 0 @endphp
    @while (isset($fornecedores[$i]))
        <!-- Enquanto houver o indice, nos vamos executando -->
        fornecedores: {{ $fornecedores[$i]['nome'] }}
        <br>
        status: {{ $fornecedores[$i]['status'] }}
        <br>
        <!--Se a $variavel testada nao estiver definida ou $variavel testada possuir SOMENTE valor *NULL*, Execute 'Dado nao preenchido' -->
        CNPJ: {{ $fornecedores[$i]['cnpj'] ?? 'Dado nao preenchido' }}
        <br>
        Telefone: ({{ $fornecedores[$i]['ddd'] ?? '' }} {{ $fornecedores[$i]['telefone'] ?? '' }})
        <hr>
        @php $i++ @endphp
    @endwhile
@endisset

------------------------------------------------------------

@isset($fornecedores)
    <!-- Verifica a existencia da variavel $fornecedores antes de executar o codigo abaixo -->
    fornecedores: {{ $fornecedores[2]['nome'] }}
    <br>
    status: {{ $fornecedores[2]['status'] }}
    <br>
    <!--Se a $variavel testada nao estiver definida ou $variavel testada possuir SOMENTE valor *NULL*, Execute 'Dado nao preenchido' -->
    CNPJ: {{ $fornecedores[2]['cnpj'] ?? 'Dado nao preenchido' }}
    <br>
    Telefone: ({{ $fornecedores[2]['ddd'] ?? '' }} {{ $fornecedores[2]['telefone'] ?? '' }})
    @switch($fornecedores[2]['ddd'])
        @case('11')
            São Paulo - SP
        @break
        @case('32')
            Juiz de Fora - MG
        @break
        @case('85')
            Fortaleza - CE
        @break
        @default
            <!-- Se nao apresentar nenhum dos casos, execute: -->
            Estado não identificado
    @endswitch
@endisset

------------------------------------------------------------

@isset($fornecedores)
    <!-- Verifica a existencia da variavel $fornecedores antes de executar o codigo abaixo -->
    fornecedores: {{ $fornecedores[0]['nome'] }}
    <br>
    status: {{ $fornecedores[0]['status'] }}
    <br>
    @isset($fornecedores[0]['cnpj'])
        CNPJ: {{ $fornecedores[0]['cnpj'] }}
        @empty($fornecedores[0]['cnpj'])
            <!-- Verifica se $fornecedores[0]['cnpj'] está vazia, se estiver execute '- Vazio' -->
            - Vazio
        @endempty
    @endisset
@endisset

------------------------------------------------------------

<!-- if executa se o retorno for true -->
<!-- @unless executa se o retorno for false -->
@unless($fornecedores[0]['status'] == 'S')
    <!-- Se o retorno da condição for false -->
    Fornecedor inativo
@endunless

------------------------------------------------------------

@if (count($fornecedores) > 0 && count($fornecedores) < 10) 
        <h3>Existem alguns fornecedores cadastrados</h3>
    @elseif(count($fornecedores) > 10)
        <h3>Existem varios fornecedores cadastrados</h3>
    @else
        <h3>Nao existe fornecedores cadastrados</h3>
@endif --}}
