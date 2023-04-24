$('.btn-delete-fornecedor').on('click', function () {
    const nome = $(this).data('nome')
    const formDelete = $(this).parents('form');
    bootbox.confirm({
        title: 'Deletar',
        message: `Tem certeza que deseja deletar o fornecedor <b>${nome}</b>`,
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