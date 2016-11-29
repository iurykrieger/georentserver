<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Location;
use App\Preference;
use App\Residence;
use App\ResidenceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function residenceDisp($distance){
        $distanceW = DB::table('location')
                     ->select(DB::raw('substr((6371 *
                                       acos(
                                           cos(radians(-27.001149)) *
                                           cos(radians(latitude)) *
                                           cos(radians(-51.176066) - radians(longitude)) +
                                           sin(radians(-27.001149)) *
                                           sin(radians(latitude))
                                       )),1,4) AS distance'))
                     ->having('distance', '>', $distance)
                     ->get();
        return response()->json($distanceW);
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
        try
        {
            DB::beginTransaction();  
            $this->validate($request, [
                'location' => 'required',
                'idUser' => 'required|integer',
                'preference' => 'required',
                'title' => 'required|max:255',
                'observation' => 'required',
                'rent' => 'required|numeric',
                'residenceImages' => 'required'
            ]);

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
                $size = getimagesize($file); 
                list($type, $file) = explode(';', $file);
                list(,$file) = explode(',', $file);
                $file = base64_decode($file);

                $name_image = "residenceImage_".time().".png";

                $path_high = public_path()."/img/residenceImage/high/".$name_image;
                $path_medium = public_path()."/img/residenceImage/medium/".$name_image;
                $path_low = public_path()."/img/residenceImage/low/".$name_image;

                Image::make($file)->save($path_high);
                Image::make($file)->resize($size[0]/3, $size[1]/3)->save($path_medium);
                Image::make($file)->resize($size[0]/5, $size[1]/5)->save($path_low);

                $residenceImageCreate = ResidenceImage::create([
                    'idResidence' => $residence['idResidence'],
                    'path' => $name_image,
                    'resource' => $residenceImage['resource'],
                    'orderImage' => $residenceImage['orderImage'],
                    'tries' => 0,
                    'active' => true,
                    ]);   
            }
            DB::Commit();
            return response()->json($residence);
        } catch (Exception $e){
            DB::Rollback();
            return response()->$e;
        }      
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
