<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Polyline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Polyline\PolylineStoreRequest;
use App\Http\Requests\Polyline\PolylineUpdateRequest;
use App\Http\Resources\PolylineResource;
use App\Http\Resources\PriceResource;
use App\Models\Street;
use App\Http\Resources\StreetResource;

class PolylineController extends Controller
{
    public function index(Request $request)
    {
        $vta_code = $request->vta_code;
        $polylinesFillable = [
            "address_id"    =>"=",
            "street_id"     =>"=",
            "bounderies"    =>"%",
            "direction"     =>"=",
            "groud_length"  =>"=",
            "distance"      =>"x,y",
            "from_distance" =>">",
            "to_distance"   =>"<",
            "minimum_price" =>">",
            "maximum_price" =>"<",
        ];
        $polyline = Polyline::Where('vta_code', 'like', '%' . $vta_code . '%');
        foreach($polylinesFillable as $key => $condition){
            if($condition=="="){
                if($request->{$key}) $polyline->where($key,$request->{$key});
            }else if($condition=="%"){
                if($request->{$key}) $polyline->where($key,'like', '%,' .$request->{$key})
                                            ->orWhere($key,'like', $request->{$key}.',%')
                                            ->orWhere($key, $request->{$key});
            }else if($condition==">"){
                if($request->{$key}) $polyline->where($key,'>=', $request->{$key});
            }else if($condition=="<"){
                if($request->{$key}) $polyline->where($key,'<=', $request->{$key});
            }else if($condition=="x,y"){
                if(count(explode(',',$request->{$key}))==2){
                    $x = explode(',',$request->{$key})[0];
                    $y = explode(',',$request->{$key})[1];
                    if($request->{$key}) $polyline->whereBetween($key, [$x,$y]);
                }
            }
        }
        $polyline->orderBy('id','desc');
        return PolylineResource::collection($polyline->paginate(10000)); 
    }

    public function option(Request $request)
    {
        $options['streets']=StreetResource::collection(Street::where('commune',$request->commune)->orderBy('name','asc')->get());
        return $options;
    }

    public function store(PolylineStoreRequest $request)
    {
        $road = Polyline::create($request->all());
        if($road){
            // if user input price it will insert new data to table prices
            if($request->average_price OR $request->minimum_price OR $request->maximum_price OR $price->corner_average_price OR $price->corner_minimum_price OR $price->corner_maximum_price){
                $this->add_prices($road->id,$request);
            }
            return  new PolylineResource($road);
        }
    }

    public function update(PolylineUpdateRequest $request, Polyline $road)
    {
        $old_average_price = $road->average_price;
        $old_minimum_price = $road->minimum_price;
        $old_maximum_price = $road->maximum_price;
        $old_corner_average_price = $road->corner_average_price;
        $old_corner_minimum_price = $road->corner_minimum_price;
        $old_corner_maximum_price = $road->corner_maximum_price;

        if($road->update($request->all())){
            // if user edit price it will insert new data to table prices
            if(
                ($request->average_price && $request->average_price!=$old_average_price) OR 
                ($request->minimum_price && $request->minimum_price!=$old_minimum_price) OR 
                ($request->maximum_price && $request->maximum_price!=$old_maximum_price) OR 
                ($request->corner_average_price && $request->corner_average_price!=$old_corner_average_price) OR 
                ($request->corner_minimum_price && $request->corner_minimum_price!=$old_corner_minimum_price) OR 
                ($request->corner_maximum_price && $request->corner_maximum_price!=$old_corner_maximum_price)
            ){
                $this->add_prices($road->id,$request);
            }
            return new PolylineResource($road);
        }
    }

    public function destroy(Polyline $road)
    {
        if($road->delete()){ 
            Price::where('polyline_id',$road->id)->delete();
            return new PolylineResource($road); 
        }
    }

    public function price(Polyline $road)
    {
        $prices = $road->prices;
        return PriceResource::collection($prices); 
    }

    public function add_prices($road_id,$request)
    {
        $price = new Price();
        $price->polyline_id = $road_id;
        $price->average_price = $request->average_price??0;
        $price->minimum_price = $request->minimum_price??0;
        $price->maximum_price = $request->maximum_price??0;
        $price->corner_average_price = $request->corner_average_price??0;
        $price->corner_minimum_price = $request->corner_minimum_price??0;
        $price->corner_maximum_price = $request->corner_maximum_price??0;
        $price->date_price = $request->date_price??date('Y-m-d');
        $price->save();
    }
}
