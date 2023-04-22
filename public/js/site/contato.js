var maskPressTelefone = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
    spOptions = {
        onKeyPress: function (val, e, field, options) {
            field.mask(maskPressTelefone.apply({}, arguments), options);
        }
    };

$("#telefone").mask(maskPressTelefone, spOptions);