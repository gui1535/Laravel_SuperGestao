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
}
