<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

//fornecedors
//fornecedores

class Fornecedor extends Model
{
    use SoftDeletes;

    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'email', 'empresa_id'];

    public function produtos()
    {
        return $this->hasMany('App\Models\Item', 'fornecedor_id', 'id');
    }


    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);
        if (Auth::check() == true) {
            $query->where('empresa_id', '=', auth()->user()->empresa->id);
        }
        return $query;
    }
}
