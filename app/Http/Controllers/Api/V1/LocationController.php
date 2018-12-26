<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Location;
use App\PositionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\LocationForm;

class LocationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return Location::with('position_group')->orderBy('position_group_id')->get();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function position_group()
  {
    return PositionGroup::with('locations')->has('locations', '>', 0)->get();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(LocationForm $request)
  {
    $location = new Location($request->all());
    $location->save();
    return $location;
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Location  $location
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    return Location::findOrFail($id);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Location  $location
   * @return \Illuminate\Http\Response
   */
  public function update(LocationForm $request, $id)
  {
    $location = Location::findOrFail($id);
    $location->fill($request->all());
    $location->save();
    return $location;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Location  $location
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $location = Location::findOrFail($id);
    $location->delete();
    return $location;
  }
}
