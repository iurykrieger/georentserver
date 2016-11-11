<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Preference;
use App\User;
use App\UserImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = User::with('city','preference')->get();
        return response()->json($all);
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function eager($idUser)
    {
        $eager = User::with(['matches' => function($query){
            $query->orderBy('dateTime','desc');
        },                        'userImages' => function($query2){
            $query2->orderBy('orderImage','desc');                        
        },
                                  'preference',
                                  'residence'])
        ->findOrFail($idUser);
        return response()->json($eager);
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
                'name' => 'required|max:100',
                'birthDate' => 'required|date',
                'email' => 'required|max:100',
                'phone' => 'required|max:11',
                'password' => 'required|min:6',
                'credits' => 'required|numeric',
                'type' => 'required|integer',
                'distance' => 'required|integer',
                'idCity' => 'required|integer'
            ]);

            $user = $request->all();

            //Chama a preference, criar e atribui abaixo a criação junto com o usuário.
            $preference = $request->preference;
            $preference = Preference::create($preference);

            //Cria o usuário.
            //pegar a id do usuário inserido para inserir as imagens.
            $user = User::create([
                'name' => $user['name'],
                'birthDate' => $user['birthDate'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'password' => bcrypt($user['password']),
                'credits' => $user['credits'],
                'type' => $user['type'],
                'distance' => $user['distance'],
                'idPreference' => $preference['idPreference'],
                'idCity' => $user['idCity'],
                'tries' => 0,   
                'active' => true,
            ]);


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
            }
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
        $all = User::with('city','preference')->findOrFail($id);
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
        $user = User::findOrFail($id);
        $input = $request->all();
        $user->fill($input)->save();
        return response()->json($User);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}
