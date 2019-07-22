<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Polyline extends Model
{
    protected $primary = 'id';
    protected $fillable = [
        "vta_code",
        "address_id",
        "street_id",
        "bounderies",
        "starting_point_place",
        "ending_point_place",
        "direction",
        "direction_google",
        "starting_point_coordinat",
        "ending_point_coordinate",
        "polylines",
        "groud_length",
        "distance",
        "from_distance",
        "to_distance",
        "average_price",
        "minimum_price",
        "maximum_price",
        "date_price",
        "priced_by",  
    ];

    public function street()
    {
        return $this->belongsTo('App\Models\Street')->withDefault();
    }
    public function directionName()
    {
        return $this->belongsTo('App\Models\Direction','direction');
    }
    public function address()
    {
        return $this->belongsTo('App\Models\Address','address_id','_code');
    } 
    public function prices()
    {
        return $this->hasMany('App\Models\Price','polyline_id')->orderBy('id','DESC');
    }
    public function pricesAscending()
    {
        return $this->hasMany('App\Models\Price','polyline_id')->orderBy('date_price','ASC');
    }
}
