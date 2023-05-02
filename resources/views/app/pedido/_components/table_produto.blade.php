<table id="table-produtos" class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Fornecedor</th>
            <th class="text-center">Preço</th>
            <th class="text-center">Comprimento</th>
            <th class="text-center">Altura</th>
            <th class="text-center">Largura</th>
            <th class="text-center">Peso</th>
            <th class="text-center">Quantidade</th>
            <th class="text-center">Ação</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($pedido->produtos))
            @foreach ($pedido->produtos as $prod)
                <tr data-id="{{ $prod->produto->id }}">
                    <input type="hidden" value="{{ Crypt::encrypt($prod->produto->id) }}" name="produtos[]">
                    <td>
                        {{ $prod->produto->nome }}
                    </td>
                    <td>
                        {{ $prod->produto->descricao }}
                    </td>
                    <td>
                        {{ $prod->produto->fornecedor->nome }}
                    </td>
                    <td class="text-center preco">
                        {{ $prod->produto->detalhes[0]->preco_venda ?? '-' }}
                    </td>
                    <td class="text-center">
                        {{ $prod->produto->detalhes[0]->comprimento ?? '-' }}
                    </td>
                    <td class="text-center">
                        {{ $prod->produto->detalhes[0]->altura ?? '-' }}
                    </td>
                    <td class="text-center">
                        {{ $prod->produto->detalhes[0]->largura ?? '-' }}
                    </td>
                    <td class="text-center">
                        {{ $prod->produto->detalhes[0]->peso ?? '-' }}
                    </td>
                    <td class="d-flex justify-content-center">
                        <input type="number" value="{{ $prod->quantidade ?? '1' }}" min="1"
                            name="quantidades[]" class="w-25 form-control">
                    </td>
                    <td class="text-center">
                        <i class="mdi mdi-delete-circle fs-3 text-danger cursor-pointer delete-produto"></i>
                    </td>
                </tr>
            @endforeach
        @endif
        <tr id="nao-ha-produtos"
            class="{{ isset($pedido->produtos) && count($pedido->produtos) != 0 ? 'd-none' : '' }}">
            <td colspan="10" class="text-danger text-center">
                Não há produtos cadastrados no pedido
            </td>
        </tr>
    </tbody>
</table>
