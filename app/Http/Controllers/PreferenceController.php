<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Preference;
use Illuminate\Support\Facades\Request;

class PreferenceController extends Controller
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
            $all = Preference::all();
            return response()->json($all);
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
            $preference = $request->all();
            $preference = Preference::create($preference);
            return response()->json($preference);
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
            $all = Preference::findOrFail($id);
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
            $preference = Preference::findOrFail($id);
            $input = $request->all();
            $preference->fill($input)->save();
            return response()->json($preference);
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
            $preference = Preference::findOrFail($id);
            $preference->delete();
        } else { return response()->json(array(
                        'code'      =>  404,
                        'message'   =>  'Usuário não autenticado'
                        ), 404);
                }
    }
}
