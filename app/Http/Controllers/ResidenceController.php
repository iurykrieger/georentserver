<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Residence;
use Illuminate\Http\Request;

class ResidenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Residence::with('location','user','preference')->get();
        return response()->json($all);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function limit($id,$qtReg)
    {
        $sql = Residence::with('location','user','preference')
                     ->limit($qtReg)
                     ->offset($id-1)
                     ->get();    
        return response()->json($sql);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function residenceImages($idResidence)
    {
        $residenceImage = Residence::with('residenceImages')
            ->where('idResidence', '=', $idResidence)
            ->get();    
        return response()->json($residenceImage);
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eager($idResidence)
    {
        $eager = Residence::with(['matches' => function($query){
            $query->orderBy('dateTime','desc');
        },                        'residenceImages' => function($query2){
            $query2->orderBy('orderImage','desc');                        
        },
                                  'location.city','preference','user'])
        ->findOrFail($idResidence);
        return response()->json($eager);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //IMAGEM PRINCIPAL DA RESIDENCIA
    public function top($idResidence)
    {
        $residenceImage = Residence::with(['residenceImages' => function($query){
            $query->orderBy('orderImage','desc')->first();
        }])
            ->where('idResidence', '=', $idResidence)
            ->first(); 
        return response()->json($residenceImage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $residence = $request->all();
        $residence = Residence::create($residence);
        return response()->json($residence);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all = Residence::with('location','user','preference')->findOrFail($id);
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
        $residence = Residence::findOrFail($id);
        $input = $request->all();
        $residence->fill($input)->save();
        return response()->json($residence);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $residence = Residence::findOrFail($id);
        $residence->delete();
    }
}
