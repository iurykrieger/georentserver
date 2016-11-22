<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests;
use Illuminate\Http\Request;

class CityController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = City::all();
        return response()->json($all);
    }

    public function state($idState)
    {
        $state = City::where('uf', '=', $idState)->get();    
        return response()->json($state);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = $request->all();
        $city = City::create($city);
        return response()->json($city);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all = City::findOrFail($id);
        return response()->json($all);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $input = $request->all();
        $city->fill($input)->save();
        return response()->json($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
    }
}
