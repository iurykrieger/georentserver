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

    public function high($idResidenceImage)
    {
        $residenceImage = ResidenceImage::with('residence')
            ->where('idResidenceImage', '=', $idResidenceImage)
            ->orderBy('orderImage','desc')
            ->first(); 
        $path = public_path()."/img/residenceImage/high/".$residenceImage['path'];
        
        $data = base64_encode(file_get_contents($path));
        $src = 'data: '.mime_content_type($path).';base64,'.$data;
        echo '<img src="'.$src.'">';
    }

     public function medium($idResidenceImage)
    {
        $residenceImage = ResidenceImage::with('residence')
            ->where('idResidenceImage', '=', $idResidenceImage)
            ->orderBy('orderImage','desc')
            ->first(); 
        $path = public_path()."/img/residenceImage/medium/".$residenceImage['path'];
        
        $data = base64_encode(file_get_contents($path));
        $src = 'data: '.mime_content_type($path).';base64,'.$data;
        echo '<img src="'.$src.'">';
    }

     public function low($idResidenceImage)
    {
        $residenceImage = ResidenceImage::with('residence')
            ->where('idResidenceImage', '=', $idResidenceImage)
            ->orderBy('orderImage','desc')
            ->first(); 
        $path = public_path()."/img/residenceImage/low/".$residenceImage['path'];
        
        $data = base64_encode(file_get_contents($path));
        $src = 'data: '.mime_content_type($path).';base64,'.$data;
        echo '<img src="'.$src.'">';
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
    public function topAllResidences()
    {

        $residence = ResidenceImage::with('residence')
        ->orderBy('orderImage','desc')
        ->groupBy('idResidence')->get();     
        return response()->json($residence);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topAllResidencesLimit($id,$qtReg)
    {

        $residence = ResidenceImage::with('residence')
        ->orderBy('idResidence','asc')
        ->groupBy('idResidence')
        ->limit($qtReg)
        ->offset($id-1)
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
