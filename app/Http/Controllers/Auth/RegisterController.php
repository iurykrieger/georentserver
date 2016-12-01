<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/1';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return true;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
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
                'tries' => 0,   
                'active' => true,
            ]);

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
            Auth::login($user,true);
            return response()->json(Auth::user());
        } catch (Exception $e){
            DB::Rollback();
            return response()->$e;
        }    
    }
}
