<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Location;
use App\Preference;
use App\Residence;
use App\ResidenceImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
                                  'location.city',
                                  'preference',
                                  'user',
                                  'matches.user'])
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

            //Cria a localização desta residencia.
            $location = $request->location;
            $location = Location::create($location);

            //Cria as preferencias da residencia.
            $preference = $request->preference;
            $preference = Preference::create($preference);
            
            $residence = Residence::create([
                'idLocation' => $location['idLocation'],
                'idUser' => $residence['idUser'],
                'idPreference' => $preference['idPreference'],
                'title' => $residence['title'],
                'description' => $residence['description'],
                'address' => $residence['address'],
                'observation' => $residence['observation'],
                'rent' => $residence['rent'],
                'tries' => 0,   
                'active' => true,
            ]);

            //Adiciona as imagens da residencia.
            $residenceImages = $request->residenceImages;
            foreach($residenceImages as $residenceImage){
                $file = $residenceImage['path'];
                list($type, $file) = explode(';', $file);
                list(,$file) = explode(',', $file);
                $file = base64_decode($file);

                $name_image = "residenceImage_".time().".png";
                $path = public_path()."/img/residenceImage/".$name_image;

                Image::make($file)->save($path);

                ResidenceImage::create([
                    'idResidence' => $residence['idResidence'],
                    'path' => $name_image,
                    'resource' => $residenceImage['resource'],
                    'orderImage' => $residenceImage['orderImage'],
                    'tries' => 0,
                    'active' => true,
                    ]);   
            }
            
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
