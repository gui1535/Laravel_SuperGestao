var maskPressTelefone = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
    spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(maskPressTelefone.apply({}, arguments), options);
        }
    };

$("#telefone").mask(maskPressTelefone, spOptions);


$('#gerar-cnpj-aleatorio').on('click', function () {
    if ($(this).is(':checked')) {
        $('#error-cnpj-invalido').empty()
        $('input#cnpj').val(gerarCnpj())
    } else {
    }
})

$("#cnpj").blur(function (e) {
    if (validarCNPJ($(this).val()) == false) {
        $('#error-cnpj-invalido').empty()
        $('#error-cnpj-invalido').append("CNPJ inválido")
    } else {
        $('#error-cnpj-invalido').empty()
    }
});

function validarCNPJ(cnpj) {
    // Limpa o CNPJ de quaisquer caracteres não numéricos
    cnpj = cnpj.replace(/[^\d]+/g, '');

    // Verifica se o CNPJ possui 14 caracteres
    if (cnpj.length !== 14)
        return false;

    // Verifica se todos os dígitos são iguais, o que tornaria o CNPJ inválido
    if (/^(\d)\1+$/.test(cnpj))
        return false;

    // Valida o primeiro dígito verificador
    let soma = 0;
    let peso = 2;
    for (let i = 11; i >= 0; i--) {
        soma += parseInt(cnpj.charAt(i)) * peso;
        peso = peso === 9 ? 2 : peso + 1;
    }
    const digito1 = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (parseInt(cnpj.charAt(12)) !== digito1)
        return false;

    // Valida o segundo dígito verificador
    soma = 0;
    peso = 2;
    for (let i = 12; i >= 0; i--) {
        soma += parseInt(cnpj.charAt(i)) * peso;
        peso = peso === 9 ? 2 : peso + 1;
    }
    const digito2 = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (parseInt(cnpj.charAt(13)) !== digito2)
        return false;

    // Se chegou até aqui, o CNPJ é válido
    return true;
}


function gerarCnpj() {
    let n = 9;
    let n1 = Math.floor(Math.random() * n + 1);
    let n2 = Math.floor(Math.random() * n);
    let n3 = Math.floor(Math.random() * n);
    let n4 = Math.floor(Math.random() * n);
    let n5 = Math.floor(Math.random() * n);
    let n6 = Math.floor(Math.random() * n);
    let n7 = Math.floor(Math.random() * n);
    let n8 = Math.floor(Math.random() * n);
    let n9 = 0;
    let n10 = 0;
    let n11 = 0;
    let n12 = 1;

    let d1 = n12 * 2 + n11 * 3 + n10 * 4 + n9 * 5 + n8 * 6 + n7 * 7 + n6 * 8 + n5 * 9 + n4 * 2 + n3 * 3 + n2 * 4 + n1 * 5;
    d1 = 11 - (d1 % 11);
    if (d1 >= 10) d1 = 0;

    let d2 = d1 * 2 + n12 * 3 + n11 * 4 + n10 * 5 + n9 * 6 + n8 * 7 + n7 * 8 + n6 * 9 + n5 * 2 + n4 * 3 + n3 * 4 + n2 * 5 + n1 * 6;
    d2 = 11 - (d2 % 11);
    if (d2 >= 10) d2 = 0;

    return '' + n1 + n2 + '.' + n3 + n4 + n5 + '.' + n6 + n7 + n8 + '/' + n9 + n10 + n11 + n12 + '-' + d1 + d2;
}