<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    public function polyline()
    {
        return $this->belongsTo('App\Models\Polyline')->orderBy('id','DESC');
    }
}
