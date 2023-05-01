<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Produto extends Model
{
    use SoftDeletes;
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);
        if (Auth::check() == true) {
            $query->where('empresa_id', '=', auth()->user()->empresa->id);
        }
        return $query;
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function detalhes()
    {
        return $this->hasMany(ProdutoDetalhe::class);
    }
}
