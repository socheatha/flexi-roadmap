<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Http\Resources\DirectionResource;
use App\Http\Requests\Direction\DirectionStoreRequest;
use App\Http\Requests\Direction\DirectionUpdateRequest;

class DirectionController extends Controller
{
    public function index()
    {
        $directions = Direction::orderBy('name','asc');
        return DirectionResource::collection($directions->get());
    }

    public function store(DirectionStoreRequest $request)
    {
        $direction = Direction::create(['name'=>$request->name]);
        if($direction) return new DirectionResource($direction);
    }

    public function update(DirectionUpdateRequest $request, Direction $direction)
    {
        if($direction->update(['name'=>$request->name])) return new DirectionResource($direction);
    }

    public function destroy(Direction $direction)
    {
        if($direction->delete()) return new DirectionResource($direction);
    }
}
