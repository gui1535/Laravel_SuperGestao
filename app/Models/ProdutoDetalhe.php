<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProdutoDetalhe extends Model
{

    protected $table = "produto_detalhes";

    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
