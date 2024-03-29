<?php
function removerCaracteresEspeciais($string)
{
    // Substitui todos os caracteres especiais por um espaço em branco
    $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);

    // Remove espaços extras
    $string = preg_replace('/\s+/', ' ', $string);

    // Remove espaços em branco no início e no fim da string
    $string = trim($string);

    return $string;
}

function precoBrlParaDecimal($preco)
{
    if ($preco) {
        $preco = str_replace(".", "", $preco);
        $preco = str_replace(",", ".", $preco);
        $preco = floatval($preco);
        $preco = number_format($preco, 2, '.', '');
    }
    return $preco;
}
