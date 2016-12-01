<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\UserImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = UserImage::with('user')->get();
        return response()->json($all);
    }

    public function high($idUserImage)
    {
        $userImage = UserImage::with('user')
            ->where('idUserImage', '=', $idUserImage)
            ->orderBy('orderImage','desc')
            ->first(); 
        $path = public_path()."/img/userImage/high/".$userImage['path'];
        
        $data = base64_encode(file_get_contents($path));
        $src = 'data: '.mime_content_type($path).';base64,'.$data;
        echo '<img src="'.$src.'">';
    }

    public function medium($idUserImage)
    {
        $userImage = UserImage::with('user')
            ->where('idUserImage', '=', $idUserImage)
            ->orderBy('orderImage','desc')
            ->first(); 
        $path = public_path()."/img/userImage/medium/".$userImage['path'];
        
        $data = base64_encode(file_get_contents($path));
        $src = 'data: '.mime_content_type($path).';base64,'.$data;
        echo '<img src="'.$src.'">';
    }

    public function low($idUserImage)
    {
        $userImage = UserImage::with('user')
            ->where('idUserImage', '=', $idUserImage)
            ->orderBy('orderImage','desc')
            ->first(); 
        $path = public_path()."/img/userImage/low/".$userImage['path'];
        
        $data = base64_encode(file_get_contents($path));
        $src = 'data: '.mime_content_type($path).';base64,'.$data;
        echo '<img src="'.$src.'">';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userImageReceive = $request->get('jsonObject');
        //retorna array, se tirar o true do json_decode vai retornar um objeto e vai dar erro em tudo.
        $userImageReceive = json_decode($userImageReceive,true);
        
        $user = $userImageReceive['user'];

        //Adiciona as imagens do usuario.
           $userImage = $userImageReceive;
           //foreach($userImages as $userImage){
               $file = $userImage['path'];
              // $size = pathinfo($file);
              // dd($size);
               $file = base64_decode($file);

                $name_image = "userImage_".time().".png";
                $path_high = public_path()."/img/userImage/high/".$name_image;
                $path_medium = public_path()."/img/userImage/medium/".$name_image;
                $path_low = public_path()."/img/userImage/low/".$name_image;

                Image::make($file)->save($path_high);
                $size = getimagesize(   public_path()."/img/userImage/high/".$name_image);
                Image::make($file)->resize($size[0]/3, $size[1]/3)->save($path_medium);
                Image::make($file)->resize($size[0]/5, $size[1]/5)->save($path_low);

                $userImageReceive = UserImage::create([
                    'path' => $name_image,
                   // 'resource' => $userImage['resource'],
                    //falar para eles arrumarem isso

                    'orderImage' => $userImage['order'],
                    'idUser' => $user['idUser'],
                    'tries' => 0,
                    'active' => true,
                    ]);   
           // }

        return response()->json($userImageReceive);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all = UserImage::with('user')->findOrFail($id);
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
        $userImage = UserImage::findOrFail($id);
        $input = $request->all();
        $userImage->fill($input)->save();
        return response()->json($userImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userImage = UserImage::findOrFail($id);
        $userImage->delete();
    }
}
