<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests;
use App\Location;
use App\Preference;
use App\User;
use App\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as RequestF;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     *
 //    * @return void
     */
 //   public function __construct()
  //  {
  //      $this->middleware('auth', ['except' => array('index','store')]);
  //  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$var_token = RequestF::header('api_token');
        //$user_token = User::where('api_token',$var_token)->first();

        //if($user_token != null) {
          $all = User::with('city','preference')->get();
          return response()->json($all);
      //}else
      //{ return response()->json(array(
      //  'code'      =>  404,
      //  'message'   =>  'Usuário não autenticado'
       // ), 404);
      //}
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eager($idUser)
    {
        $var_token = RequestF::header('api_token');
        
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
           $eager = User::with(['matches' => function($query){
            $query->orderBy('dateTime','desc');
        },                        'userImages' => function($query2){
            $query2->orderBy('orderImage','desc');                        
        },
        'preference',
        'residence',
        'location',
        'profileImageUser'])
           ->findOrFail($idUser);

           return response()->json($eager);
       }else
       { return response()->json(array(
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
        try
        {
            DB::beginTransaction(); 

            $user = $request->get('jsonObject');
            
            //retorna array, se tirar o true do json_decode vai retornar um objeto e vai dar erro em tudo.
            $user = json_decode($user,true);

            //Chama a preference, criar e atribui abaixo a criação junto com o usuário.
            $preference = $user['preference'];
            $preference = Preference::create($preference);

            $location = $user['location']; 
                $city = $location['city'];

                $location = Location::create([
                    'latitude' => $location['latitude'],
                    'longitude' => $location['longitude'],
                    'idCity' => $city['idCity'],
                    'tries' => 0,   
                    'active' => true,
                ]);

            $city = $user['city'];

            //Cria o usuário.
            //pegar a id do usuário inserido para inserir as imagens.
            $user = User::create([
                'name' => $user['name'],
                'birthDate' => $user['birthDate'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'password' => bcrypt($user['password']),
                'type' => $user['type'],
                'distance' => $user['distance'],
                'idPreference' => $preference['idPreference'],
                'idCity' => $city['idCity'],
                'idLocation' => $location['idLocation'],
                'api_token' => str_random(60),
                'tries' => 0,   
                'active' => true,
                ]);


                DB::Commit();
                return response()->json($user);
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
     $var_token = RequestF::header('api_token');
     $user_token = User::where('api_token',$var_token)->first();

     if($user_token != null) {
        $all = User::with('city','preference')->findOrFail($id);
        return response()->json($all);
    }else
    { return response()->json(array(
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
        $var_token = RequestF::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $user = User::findOrFail($id);
            $input = $request->all();
            $user->fill($input)->save();
            return response()->json($user);
        }else
        { return response()->json(array(
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
        $var_token = RequestF::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $user = User::findOrFail($id);
            $user->delete();
        }else
        { return response()->json(array(
            'code'      =>  404,
            'message'   =>  'Usuário não autenticado'
            ), 404);
    }
}
}
