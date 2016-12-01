<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests;
use App\Preference;
use App\User;
use App\UserImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        $var_token = $_GET['api_token'];
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
          $all = User::with('city','preference')->get();
          return response()->json($all);
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
    public function eager($idUser)
    {
        $var_token = $_GET['api_token'];
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
           $eager = User::with(['matches' => function($query){
            $query->orderBy('dateTime','desc');
        },                        'userImages' => function($query2){
            $query2->orderBy('orderImage','desc');                        
        },
        'preference',
        'residence'])
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
                'api_token' => str_random(60),
                'tries' => 0,   
                'active' => true,
                ]);

            //$user->api_token = str_random(60);
            //$user->save();

/*
            //Adiciona as imagens do usuario.
            $userImages = $request->userImages;
            foreach($userImages as $userImage){
                $file = $userImage['path'];
                $size = getimagesize($file); 
                list($type, $file) = explode(';', $file);
                list(,$file) = explode(',', $file);
                $file = base64_decode($file);

                $name_image = "userImage_".time().".png";
                $path_high = public_path()."/img/userImage/high/".$name_image;
                $path_medium = public_path()."/img/userImage/medium/".$name_image;
                $path_low = public_path()."/img/userImage/low/".$name_image;

                Image::make($file)->save($path_high);
                Image::make($file)->resize($size[0]/3, $size[1]/3)->save($path_medium);
                Image::make($file)->resize($size[0]/5, $size[1]/5)->save($path_low);

                UserImage::create([
                    'path' => $name_image,
                    'resource' => $userImage['resource'],
                    'orderImage' => $userImage['orderImage'],
                    'idUser' => $user['idUser'],
                    'tries' => 0,
                    'active' => true,
                    ]);   
                }*/
                DB::Commit();
           // Auth::login($user,true);
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
     $var_token = $_GET['api_token'];
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
        $var_token = $_GET['api_token'];
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
        $var_token = $_GET['api_token'];
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
