<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cliente extends Model
{

    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);
        if (Auth::check() == true) {
            $query->where('empresa_id', '=', auth()->user()->empresa->id);
        }
        return $query;
    }
}
