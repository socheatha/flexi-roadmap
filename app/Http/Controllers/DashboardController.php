<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Polyline;
use App\Models\Dashboard_summary;
use App\Http\Resources\DashboardResource;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dashboard_road = Dashboard_summary::orderBy('district_name','asc');
        if($request->district) $dashboard_road->where('district_id',$request->district);
        return DashboardResource::collection($dashboard_road->get());
    }
    public function get_roads_change(Request $request){
        $dashboard_road = Dashboard_summary::
        select([
            \DB::raw("SUM(added) as count_added"),
            \DB::raw("SUM(updated) as count_updated"),
            \DB::raw("SUM(alive) as count_alive"),
            \DB::raw("SUM(almost_die) as count_almost_die"),
            \DB::raw("SUM(died) as count_died")
        ])
        ->first();
        return response()->json(['data'=>[
            'added'=>$dashboard_road->count_added??0,
            'updated'=>$dashboard_road->count_updated??0,
            'alive'=>$dashboard_road->count_alive??0,
            'almost_die'=>$dashboard_road->count_almost_die??0,
            'died'=>$dashboard_road->count_died??0,
            'all_road'=>$dashboard_road->count_alive+$dashboard_road->count_almost_die+$dashboard_road->count_died,
        ]],200);  
    }

    public function set_roads_change()
    {
        $today = date('Y-m-d');
        Dashboard_summary::truncate();
        $almost_die_date = date('Y-m-d',strtotime($today." -30 days"));
        $died_date = date('Y-m-d',strtotime($today." -50 days"));
        $addresses = Polyline::select(['address_id'])->groupBy('address_id')->orderBy('address_id','asc')->get();

        $tmp_data_communes = [];
        $tmp_data_district = [];
        foreach($addresses AS $address){
            $polylines = Polyline::where('address_id',$address->address_id)->get();
            $count_road = 0;
            $count_added = 0;
            $count_updated = 0;
            $count_alive = 0;
            $count_almost_die = 0;
            $count_died= 0;
            foreach($polylines AS $polyline){
                $count_road++;
                if(date('Y-m-d', strtotime($polyline->created_at)) == $today){ 
                    $count_added ++;  
                }
                if($polyline->date_price == $today){
                    $count_updated ++;
                }
                if($polyline->date_price >= $almost_die_date){
                    $count_alive ++;
                }else if($polyline->date_price >= $died_date){
                    $count_almost_die ++;
                }else{
                    $count_died ++;
                }
            }
            array_push($tmp_data_communes,[
                'id'=>$address->address_id,
                'name'=>optional($polyline->address)->_name_en,
                'added'=>$count_added,
                'updated'=>$count_updated,
                'alive'=>$count_alive,
                'almost_die'=>$count_almost_die,
                'died'=>$count_died,
                'all_road'=>$count_alive+$count_almost_die+$count_died
            ]);

            $district_id = substr($address->address_id,0,4);
            if(!in_array($district_id,$tmp_data_district)){
                array_push($tmp_data_district,$district_id);
            }
        }

        // after get data need to loop this array again and set it to each parent( set communes to each district )
        $data = [];
        foreach($tmp_data_district AS $district_id){
            $tmp_array_child = [];
            $count_added = 0;
            $count_updated = 0;
            $count_alive = 0;
            $count_almost_die = 0;
            $count_died= 0;
            foreach($tmp_data_communes AS $tmp_data_commune){
                if($district_id == substr($tmp_data_commune['id'],0,4)){
                    $count_added += $tmp_data_commune['added'];
                    $count_updated += $tmp_data_commune['updated'];
                    $count_alive += $tmp_data_commune['alive'];
                    $count_almost_die += $tmp_data_commune['almost_die'];
                    $count_died += $tmp_data_commune['died'];
                    array_push($tmp_array_child,$tmp_data_commune);
                }
            }
            Dashboard_summary::create([
                'district_id'=>$district_id,
                'district_name'=> Address::where('_code',$district_id)->first()->_name_en,
                'communes'=>json_encode($tmp_array_child),
                'added'=>$count_added,
                'updated'=>$count_updated,
                'alive'=>$count_alive,
                'almost_die'=>$count_almost_die,
                'died'=>$count_died,
            ]);

        }

        return response()->json(['status'=>'success'], 200);;
    }
}
