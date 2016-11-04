<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\UserImage;
use Illuminate\Http\Request;

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

    public function file($idUserImage)
    {
        $userImage = UserImage::with('user')
            ->where('idUserImage', '=', $idUserImage)
            ->orderBy('orderImage','desc')
            ->first(); 
        $path = public_path()."/img/userImage/".$userImage['path'];
        
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
        $userImage = $request->all();
        $userImage = UserImage::create($userImage);
        return response()->json($userImage);
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
