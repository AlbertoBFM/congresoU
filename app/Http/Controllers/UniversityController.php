<?php

namespace App\Http\Controllers;

use App\Models\University;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = University::get();
        return response()->json( $universities );    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate( $request, [
            "name" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
            "logo" => "required|image",
            "user" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8|confirmed",
        ]);

        $name = strtoupper($request->name);

        if( $request->hasFile( 'logo' ) ){
            $path = $request->logo->store('public/logo');

            University::create([
                "name" => $name,
                "logo" => $path,
                "user" => $request->user,
                "password" => $request->password,
            ]);

            return response()->json([
                'message'=>'Universidad registrada correctamente'
            ]);
        }
        return response()->json([
            'message'=>'Error al registrar Universidad'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $university = University::where('id', $id);
        return response()->json( $university ); 
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
        $this->validate( $request, [
            "name" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
            "logo" => "required|image",
            "user" => "required|string|email|max:255|unique:users",
            "password" => "required|string|min:8|confirmed",
        ]);

        $name = strtoupper($request->name);

        if( $request->hasFile( 'logo' ) ){
            Storage::delete($request->old_logo);
            $path = $request->logo->store('public/logo');
        }
        else{
            $path = $request->old_logo;
        }
        try {
            $university = University::find($id)([
                "name" => $name,
                "logo" => $path,
                "user" => $request->user,
                "password" => $request->password,
            ]);
            $university->save();
    
            return response()->json([
                'message'=>'Universidad modificada correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al modificar Universidad'
            ]);
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
        try {
            $university = University::find($id);
            $university->delete();
            
            return response()->json([
                'message'=>'Universidad eliminada'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al eliminar Universidad'
            ]);
        }
    }
}
