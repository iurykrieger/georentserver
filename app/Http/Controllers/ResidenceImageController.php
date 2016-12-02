<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\ResidenceImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestF;

class ResidenceImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $var_token = RequestF::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $all = ResidenceImage::with('residence')->get();
            return response()->json($all);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

    public function high($idResidenceImage)
    {
      //  $var_token = RequestF::header('api_token');
      //  $user_token = User::where('api_token',$var_token)->first();

      //  if($user_token != null) {
             $residenceImage = ResidenceImage::with('residence')
            ->where('idResidenceImage', '=', $idResidenceImage)
            ->orderBy('orderImage','desc')
            ->first(); 
            $path = public_path()."/img/residenceImage/high/".$residenceImage['path'];
            
            $data = base64_encode(file_get_contents($path));
            $src = 'data: '.mime_content_type($path).';base64,'.$data;
            echo '<img src="'.$src.'">';
       /* } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }*/
    }

     public function medium($idResidenceImage)
    {
        //$var_token = RequestF::header('api_token');
        //$user_token = User::where('api_token',$var_token)->first();

        //if($user_token != null) {
             $residenceImage = ResidenceImage::with('residence')
            ->where('idResidenceImage', '=', $idResidenceImage)
            ->orderBy('orderImage','desc')
            ->first(); 
            $path = public_path()."/img/residenceImage/medium/".$residenceImage['path'];
            
            $data = base64_encode(file_get_contents($path));
            $src = 'data: '.mime_content_type($path).';base64,'.$data;
            echo '<img src="'.$src.'">';
       /* } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }*/
    }

     public function low($idResidenceImage)
    {
        //$var_token = Request::header('api_token');
        //$user_token = User::where('api_token',$var_token)->first();

        //if($user_token != null) {
             $residenceImage = ResidenceImage::with('residence')
            ->where('idResidenceImage', '=', $idResidenceImage)
            ->orderBy('orderImage','desc')
            ->first(); 
            $path = public_path()."/img/residenceImage/low/".$residenceImage['path'];
            
            $data = base64_encode(file_get_contents($path));
            $src = 'data: '.mime_content_type($path).';base64,'.$data;
            echo '<img src="'.$src.'">';
       /* } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function residence($idResidence)
    {
        $var_token = RequestF::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residence = ResidenceImage::with('residence')
            ->where('idResidence', '=', $idResidence)
            ->get();
            return response()->json($residence);
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
    public function topAllResidences()
    {
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residence = ResidenceImage::with('residence')
            ->orderBy('orderImage','desc')
            ->groupBy('idResidence')->get();     
            return response()->json($residence);
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
    public function topAllResidencesLimit($id,$qtReg)
    {
        $var_token = RequestF::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residence = ResidenceImage::with('residence')
            ->orderBy('idResidence','asc')
            ->groupBy('idResidence')
            ->limit($qtReg)
            ->offset($id-1)
            ->get();     
            return response()->json($residence);
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
    public function residenceTop($idResidence)
    {
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residence = ResidenceImage::with('residence')
            ->where('idResidence', '=', $idResidence)
            ->orderBy('orderImage', 'desc')
            ->first();     
            return response()->json($residence);
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
        $var_token = $request->get('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residenceImageReceive = $request->get('jsonObject');
            //retorna array, se tirar o true do json_decode vai retornar um objeto e vai dar erro em tudo.
            $residenceImageReceive = json_decode($residenceImageReceive,true);
            
            $residence = $residenceImageReceive['residence'];

            //Adiciona as imagens do usuario.
            $residenceImage = $residenceImageReceive;
            $file = $residenceImage['path'];
            $file = base64_decode($file);//imap_base64($file);

            $name_image = "userImage_".time().".jpeg";
            $path_high = public_path()."/img/residenceImage/high/".$name_image;
            $path_medium = public_path()."/img/residenceImage/medium/".$name_image;
            $path_low = public_path()."/img/residenceImage/low/".$name_image;

            Image::make($file)->save($path_high);
            $size = getimagesize(public_path()."/img/residenceImage/high/".$name_image);
            Image::make($file)->resize($size[0]/3, $size[1]/3)->save($path_medium);
            Image::make($file)->resize($size[0]/5, $size[1]/5)->save($path_low);

            $residenceImageReceive = ResidenceImage::create([
                'path' => $name_image,
                       // 'resource' => $userImage['resource'],
                'orderImage' => $residenceImage['orderImage'],
                'idUser' => $residence['idResidence'],
                'tries' => 0,
                'active' => true,
                ]);   
               // }

            return response()->json($residenceImageReceive);
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
        //$var_token = RequestF::header('api_token');
        //$user_token = User::where('api_token',$var_token)->first();

        //if($user_token != null) {
            $all = ResidenceImage::with('residence')->findOrFail($id);
            return response()->json($all);
        //} else { return response()->json(array(
        //                'code'      =>  404,
        //                'message'   =>  'Usuário não autenticado'
        //                ), 404);
         //       }
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
            $residenceImage = ResidenceImage::findOrFail($id);
            $input = $request->all();
            $residenceImage->fill($input)->save();
            return response()->json($residenceImage);
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
        $var_token = RequestF::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $residenceImage = ResidenceImage::findOrFail($id);
            $residenceImage->delete();
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }
}
