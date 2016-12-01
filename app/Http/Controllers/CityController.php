<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;

class CityController extends Controller
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
            $all = City::all();
            return response()->json($all);
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }

    public function state($idState)
    {
        $var_token = Request::header('api_token');
        $user_token = User::where('api_token',$var_token)->first();

        if($user_token != null) {
            $state = City::where('uf', '=', $idState)->get();    
            return response()->json($state);
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
            $city = $request->all();
            $city = City::create($city);
            return response()->json($city);
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
            $all = City::findOrFail($id);
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
            $city = City::findOrFail($id);
            $input = $request->all();
            $city->fill($input)->save();
            return response()->json($city);
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
            $city = City::findOrFail($id);
            $city->delete();
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }
}
