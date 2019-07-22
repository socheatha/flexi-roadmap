<?php

namespace App\Http\Controllers;

use App\Models\Street;
use Illuminate\Http\Request;
use App\Http\Resources\StreetResource;
use App\Http\Requests\Street\StreetStoreRequest;
use App\Http\Requests\Street\StreetUpdateRequest;

class StreetController extends Controller
{
    public function index(Request $request)
    {
        $streets = Street::orderBy('name','asc');

        if($request->street){
            $streets->where('code', $request->street)
                    ->orWhere('name', 'like', '%'.$request->street.'%');
        }
        
        if($request->commune) $streets->where('commune', 'like', '%'.$request->commune.'%');
        return StreetResource::collection($streets->paginate(100));
    }
 
    public function store(StreetStoreRequest $request)
    {
        $street = Street::create($request->all());
        if($street) return new StreetResource($street);
    }
 
    public function update(StreetUpdateRequest $request, Street $street)
    {
        if($street->update($request->all())) return new StreetResource($street);
    }

    public function destroy(Street $street)
    {
        if($street->delete()) return new StreetResource($street);
    }
}
