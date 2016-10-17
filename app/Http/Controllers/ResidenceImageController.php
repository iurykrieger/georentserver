<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\ResidenceImage;
use Illuminate\Http\Request;

class ResidenceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = ResidenceImage::with('residence')->get();
        return response()->json($all);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function residence($idResidence)
    {
        $residence = ResidenceImage::with('residence')
        ->where('idResidence', '=', $idResidence)
        ->get();
        return response()->json($residence);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function residenceTop($idResidence)
    {
        $residence = ResidenceImage::with('residence')
        ->where('idResidence', '=', $idResidence)
        ->orderBy('orderImage', 'desc')
        ->first();     
        return response()->json($residence);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $residenceImage = $request->all();
        $residenceImage = ResidenceImage::create($residenceImage);
        return response()->json($residenceImage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all = ResidenceImage::with('residence')->findOrFail($id);
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
        $residenceImage = ResidenceImage::findOrFail($id);
        $input = $request->all();
        $residenceImage->fill($input)->save();
        return response()->json($residenceImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $residenceImage = ResidenceImage::findOrFail($id);
        $residenceImage->delete();
    }
}
