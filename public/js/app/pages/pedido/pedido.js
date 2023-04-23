$('.btn-delete-pedido').on('click', function () {
    const codigo = $(this).data('codigo')
    const formDelete = $(this).parents('form');
    bootbox.confirm({
        title: 'Deletar',
        message: `Tem certeza que deseja deletar o pedido <b>${codigo}</b>`,
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