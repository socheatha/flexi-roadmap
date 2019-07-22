<?php

namespace App\Http\Controllers;

use App\Models\Boundery;
use Illuminate\Http\Request;
use App\Http\Resources\BounderyResource;
use App\Http\Requests\Boundery\BounderyStoreRequest;
use App\Http\Requests\Boundery\BounderyUpdateRequest;

class BounderyController extends Controller
{
    public function index(Request $request)
    {
        $bounderies = Boundery::orderBy('name','asc');
        if($request->name) $bounderies->where('name', 'like', '%' . $request->name . '%');
        return BounderyResource::collection($bounderies->paginate(100));
    }

    public function store(BounderyStoreRequest $request)
    {
        $boundery = Boundery::create(['name'=>$request->name]);;
        if($boundery) return  new BounderyResource($boundery);
    }
 
    public function update(BounderyUpdateRequest $request, Boundery $boundery)
    {
        if($boundery->update(['name'=>$request->name])) return new BounderyResource($boundery);
    }

    public function destroy(Boundery $boundery)
    {
        if($boundery->delete()) return new BounderyResource($boundery);
    }
}
