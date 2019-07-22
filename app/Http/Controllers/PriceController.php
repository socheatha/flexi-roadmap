<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Polyline;
use Illuminate\Http\Request;
use App\Http\Resources\PriceResource;
use App\Http\Resources\ChartResource;
use App\Http\Requests\Price\PriceStoreRequest;
use App\Http\Requests\Price\PriceUpdateRequest;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::orderBy('id','desc');
        return PriceResource::collection($prices->paginate()); 
    }

    public function store(PriceStoreRequest $request)
    {
        $polyline_id = $request->road_id;
        $average_price = $request->average_price??0;
        $minimum_price = $request->minimum_price??0;
        $maximum_price = $request->maximum_price??0;
        $corner_average_price = $request->corner_average_price??0;
        $corner_minimum_price = $request->corner_minimum_price??0;
        $corner_maximum_price = $request->corner_maximum_price??0;
        $date_price = $request->date_price??date('Y-m-d');

        $price = new Price();
        $price->polyline_id = $polyline_id;
        $price->average_price = $average_price;
        $price->minimum_price = $minimum_price;
        $price->maximum_price = $maximum_price;
        $price->corner_average_price = $corner_average_price;
        $price->corner_minimum_price = $corner_minimum_price;
        $price->corner_maximum_price = $corner_maximum_price;
        $price->date_price = $date_price;

        // after add price we need to update current price in table polyline too
        if($price->save()){
            $polyline = Polyline::find($polyline_id);
            $polyline->average_price = $average_price;
            $polyline->minimum_price = $minimum_price;
            $polyline->maximum_price = $maximum_price;
            $polyline->date_price = $date_price;
            $polyline->save();
            return new PriceResource($price);
        }
    }

    public function update(PriceStoreRequest $request, Price $price)
    {
        $polyline_id = $request->road_id;
        $average_price = $request->average_price??$price->average_price;
        $minimum_price = $request->minimum_price??$price->minimum_price;
        $maximum_price = $request->maximum_price??$price->maximum_price;
        $corner_average_price = $request->corner_average_price??$price->corner_average_price;
        $corner_minimum_price = $request->corner_minimum_price??$price->corner_minimum_price;
        $corner_maximum_price = $request->corner_maximum_price??$price->corner_maximum_price;
        $date_price = $request->date_price??$price->date_price;

        $price->polyline_id = $polyline_id;
        $price->average_price = $average_price;
        $price->minimum_price = $minimum_price;
        $price->maximum_price = $maximum_price;
        $price->corner_average_price = $corner_average_price;
        $price->corner_minimum_price = $corner_minimum_price;
        $price->corner_maximum_price = $corner_maximum_price;
        $price->date_price = $date_price;

        if($price->save()){
            // after update price, check if it is the last will update polyline too
            $polyline = Polyline::find($polyline_id);
            if($polyline->prices[0]->id == $price->id){
                $polyline->average_price = $average_price;
                $polyline->minimum_price = $minimum_price;
                $polyline->maximum_price = $maximum_price;
                $polyline->date_price = $date_price;
                $polyline->save();
            }
            return new PriceResource($price);
        }
    }

    public function chart(Request $request)
    {
        $roads_id = explode(',',$request->roads_id);
        $charts_title = [];
        $charts_data = [];
        foreach($roads_id AS $road_id){
            $road = Polyline::find($road_id);
            array_push($charts_title,$road->vta_code);
            array_push($charts_data,['name'=>$road->vta_code,'statistic'=>ChartResource::collection($road->pricesAscending)]);
        }
        return response()->json(['title'=>$charts_title,'data'=>$charts_data],200);
    }

    public function compare(Request $request)
    {
        $roads_id = explode(',',$request->roads_id);
        $get_year = Price::select(\DB::raw('YEAR(date_price) year'))
        ->groupby('year')
        ->whereNotNull('date_price')
        ->orderBy('date_price','asc')
        ->get();

        $charts_title = [];
        foreach($get_year as $year){
            array_push($charts_title,['year'=>$year->year]);
        }
        foreach($roads_id AS $road_id){
            $road = Polyline::find($road_id);
            // array_push($charts_title,$road->vta_code);
        }
        $roads_id = explode(',',$request->roads_id);
        return response()->json(['title'=>$charts_title,'data'=>'Hello']);
    }
}
