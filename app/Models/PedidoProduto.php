<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PedidoProduto extends Model
{
    //
    protected $table = 'pedidos_produtos';

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
