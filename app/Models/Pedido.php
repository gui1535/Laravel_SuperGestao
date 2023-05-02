<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos()
    {
        return $this->hasMany(PedidoProduto::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function getPrecoTotalAttribute()
    {
        $produtos = $this->produtos;
        $valor = 0;
        foreach ($produtos as $prod) {
            $valor = $valor + ($prod->produto->detalhes[0]->preco_venda * $prod->quantidade);
        }

        return $valor;
    }
}
