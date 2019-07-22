<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard_summary extends Model
{
    protected $fillable = [
        "count_on_date",
        "district_id",
        "district_name",
        "communes",
        "added",
        "updated",
        "alive",
        "almost_die",
        "died", 
    ];
}
