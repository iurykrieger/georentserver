<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Location;
use App\Preference;
use App\Residence;
use App\ResidenceImage;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
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
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $all = Residence::with('location','user','preference')->get();
            return response()->json($all);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function residences($idUser,$id,$qtReg){
       $var_token = Request::header('api_token');
       $user_token = User::where('api_token',$var_token)->first();
        if($user_token != null) {
           $residence = Residence::with('user')
                        ->where('idUser',$idUser)
                        ->limit($qtReg)
                        ->offset($id-1)
                        ->get();
           return response()->json($residence);
      }else
       { return response()->json(array(
                           'code'      =>  404,
                           'message'   =>  'Usuário não autenticado'
                           ), 404);
       }
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function near($idUser){
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $user = User::with('location')->findOrFail($idUser);
            $distanceW = DB::table('location')
                         ->select(DB::raw('idLocation,substr((6371 *
                                                    acos(
                                                        cos(radians('.$user->location['latitude'].')) *
                                                        cos(radians(latitude)) *
                                                        cos(radians('.$user->location['longitude'].') - radians(longitude)) +
                                                        sin(radians('.$user->location['latitude'].')) *
                                                        sin(radians(latitude))
                                                    )),1,4) AS distanceW'))
                         ->where('idLocation','<>',$user->location['idLocation'])
                         ->having('distanceW', '<', $user->distance)
                         ->get();

            $distanceTeste = $distanceW[0]->idLocation;             
            for ($i = 1; $i <= count($distanceW)-1; ++$i){
                $distanceTeste = $distanceTeste.','.$distanceW[$i]->idLocation;        
            }
            $residences = Residence::with('location')
                         ->where('idLocation', $distanceTeste)->get();
            
            return response()->json($residences);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function limit($id,$qtReg)
    {
       $var_token = Request::header('api_token');
       $user_token = User::where('api_token',$var_token)->first();
        if($user_token != null) {
            $sql = Residence::with('location','user','preference')
                      ->limit($qtReg)
                      ->offset($id-1)
                      ->get();    
            return response()->json($sql);
      }else
       { return response()->json(array(
                           'code'      =>  404,
                           'message'   =>  'Usuário não autenticado'
                           ), 404);
       }
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function residenceImages($idResidence)
    {
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residenceImage = Residence::with('residenceImages')
                ->where('idResidence', '=', $idResidence)
                ->get();    
            return response()->json($residenceImage);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eager($idResidence)
    {
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
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
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function top($idResidence)
    {
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residenceImage = Residence::with(['residenceImages' => function($query){
                $query->orderBy('orderImage','desc')->first();
            }])
                ->where('idResidence', '=', $idResidence)
                ->first(); 
            return response()->json($residenceImage);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            try
            {
                DB::beginTransaction();  

                $residence = Request::header('jsonObject');
                //retorna array, se tirar o true do json_decode vai retornar um objeto e vai dar erro em tudo.
                $residence = json_decode($residence,true);

                //Cria a localização desta residencia.
                $location = $residence['location'];
                $location = Location::create($location);

                //Cria as preferencias da residencia.
                $preference = $user['preference'];
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
                
                DB::Commit();
                return response()->json($residence);
            } catch (Exception $e){
                DB::Rollback();
                return response()->$e;
            }      
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
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
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $all = Residence::with('location','user','preference')->findOrFail($id);
            return response()->json($all);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
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
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residence = Residence::findOrFail($id);
            $input = $request->all();
            $residence->fill($input)->save();
            return response()->json($residence);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residence = Residence::findOrFail($id);
            $residence->delete();
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }
}
