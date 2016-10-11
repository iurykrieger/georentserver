<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|max:100',
                'birthDate' => 'required|date',
                'email' => 'required|email|max:100|unique:user',
                'phone' => 'required|max:11',
                'password' => 'required|confirmed|min:6',
                'credits' => 'required|numeric',
                'type' => 'required|integer',
                'distance' => 'required|integer',
                'idPreference' => 'required|integer',
                'idCity' => 'required|integer'
            ]);
            $user = $request->all();
            
            User::create([
                'name' => $user['name'],
                'birthDate' => $user['birthDate'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'password' => bcrypt($user['password']),
                'credits' => $user['credits'],
                'type' => $user['type'],
                'distance' => $user['distance'],
                'idPreference' => $user['idPreference'],
                'idCity' => $user['idCity'],
                'tries' => 0,
                'active' => true,
            ]);
            
            return response()->json($user);
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
