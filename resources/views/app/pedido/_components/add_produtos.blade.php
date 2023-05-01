<div class="col-md-12 mb-3 d-flex gap-3">
    <div class="w-90">
        <label for="codigo">Produtos</label>
        {{-- @dd($produtos[0]) --}}
        <select multiple id="produto" class="form-select select2-produtos">
            @foreach ($produtos as $produto)
                <option value="{{ Crypt::encrypt($produto->id) }}" data-nome="{{ $produto->nome }}"
                    data-id="{{ $produto->id }}"
                    data-value="{{ Crypt::encrypt($produto->id) }}" data-descricao="{{ $produto->descricao ?? '-' }}"
                    data-fornecedor="{{ $produto->fornecedor->nome }}"
                    data-comprimento="{{ $produto->detalhes[0]->comprimento ?? '-' }}"
                    data-largura="{{ $produto->detalhes[0]->largura ?? '-' }}"
                    data-peso="{{ $produto->detalhes[0]->peso ?? '-' }}"
                    data-altura="{{ $produto->detalhes[0]->altura ?? '-' }}"
                    data-preco="{{ $produto->detalhes[0]->preco_venda ?? '-' }}">
                    {{ $produto->nome }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="d-flex flex-column justify-content-end w-10">
        <button type="button" id="add-produto" class="btn btn-secondary w-100 h-55 text-white">
            Adicionar
        </button>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#produto').select2();
        });

        $('#add-produto').on('click', function() {
            loadingOrStopButton($(this))
            const produtosSelecionados = $('#produto').val();
            for (const produto of produtosSelecionados) {
                if (produto) {
                    createTRProduto(searchProduto(produto));
                }
            }
            loadingOrStopButton($(this), false)
        })

        function searchProduto(id) {
            return $(`#produto option[value="${id}"]`)[0].dataset
        }

        function createTRProduto(dataSetProduto) {
            if ($(`tr[data-id="${dataSetProduto.id}"]`).length == 0) {
                $('#nao-ha-produtos').addClass('d-none')

                // cria um elemento tr
                var tr = $('<tr>');

                const classCentralizar = 'text-center'

                tr.attr('data-id', dataSetProduto.id)
                tr.append(createInputId(dataSetProduto.value));
                // adiciona as colunas ao elemento tr
                tr.append($('<td>').append(dataSetProduto.nome));
                tr.append($('<td>').append(dataSetProduto.descricao));
                tr.append($('<td>').append(dataSetProduto.fornecedor));
                tr.append($('<td>').append(dataSetProduto.comprimento).addClass(classCentralizar));
                tr.append($('<td>').append(dataSetProduto.altura).addClass(classCentralizar));
                tr.append($('<td>').append(dataSetProduto.largura).addClass(classCentralizar));
                tr.append($('<td>').append(dataSetProduto.peso).addClass(classCentralizar));
                tr.append($('<td>').append(dataSetProduto.preco).addClass(classCentralizar));
                tr.append($('<td>').append(createInputQuantidade()).addClass('d-flex justify-content-center'));
                tr.append($('<td>').append(createDeleteProduto()).addClass(classCentralizar));

                // adiciona o elemento tr à tabela
                $('#table-produtos tbody').append(tr);

                deleteProduto();
            }
        }

        function createDeleteProduto() {
            const classIcon = "mdi mdi-delete-circle fs-3 text-danger cursor-pointer delete-produto";
            return $('<i>').addClass(classIcon);
        }

        deleteProduto();

        function deleteProduto() {
            $('.delete-produto').on('click', async function() {
                $(this).parents('tr').remove();
                if ($(`tr[data-id]`).length == 0) {
                    $('#nao-ha-produtos').removeClass('d-none')
                }
            })
        }

        function createInputQuantidade() {
            return $('<input>').attr({
                type: 'number',
                value: 1,
                min: 1,
                name: "quantidades[]"
            }).addClass('w-25 form-control');
        }

        function createInputId(id) {
            return $('<input>').attr({
                type: 'hidden',
                value: id,
                name: "produtos[]"
            }).addClass('w-25 form-control');
        }

        function loadingOrStopButton(button, loading = true) {
            button.empty()
            if (loading == false) {
                button.removeClass('disabled')
                button.append('Adicionar')
            } else {
                const svgLoading = '<div class="spinner-border spinner-small-loading" role="status"></div>'
                button.addClass('disabled')
                button.append(svgLoading);
            }
        }
    </script>
@endpush
