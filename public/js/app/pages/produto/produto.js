

$('#fornecedor').select2();
$('#unidade').select2();
$('#preco').mask('000.000,00', {
    reverse: true
});
$('.estoque').mask('00000')
$('.centimetros').mask('00000000.00', { reverse: true });
$('#peso').mask('00000000.00', { reverse: true });

$('.btn-delete-produto').on('click', function () {
    const nome = $(this).data('nome')
    const formDelete = $(this).parents('form');
    bootbox.confirm({
        title: 'Deletar',
        message: `Tem certeza que deseja deletar o produto <b>${nome}</b>`,
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancelar'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Deletar'
            }
        },
        callback: function (result) {
            if (result) {
                formDelete.submit();
            }
        }
    });
});