<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\University;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            "name" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "logo" => "required|image",
            "user" => "required|string|email|max:255",
            "password" => "required|string|min:8",
        ]);

        if( $request->hasFile( 'logo' ) ){
            $path = $request->logo->store('public/logo');

            University::create([
                "name" => strtoupper($request->name),
                "logo" => $path,
                "user" => $request->user,
                "password" => Hash::make($request->password),
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
        $university = University::find( $id );
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
            "name" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "user" => "required|string|email|max:255",
            "password" => "required|string|min:8",
        ]);

        try {
            University::find( $id )->fill([
                "name" => strtoupper($request->name),
                "user" => $request->user,
                "password" => Hash::make($request->password),
            ])->save();
    
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
            Storage::delete($university->logo);
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
