<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\Archive;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archives = Archive::get();
        return response()->json( $archives );  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = Activity::get();
        return response()->json( $activities );
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
            "path" => "required|mimes:pdf,jpg,jpeg,png|size:5000",
            "name" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "title" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "description" => "required|max:200|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
        ]);

        if( $request->hasFile( 'path' ) ){
            $path = $request->path->store('public/files');

            Archive::create([
                "path" => $path,
                "name" => $request->name,
                "title" => $request->title,
                "description" => $request->description,
                "activity_id" => $request->activity_id
            ]);

            return response()->json([
                'message'=>'Archivo guardado correctamente'
            ]);
        }
        return response()->json([
            'message'=>'Error al guardar archivo'
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
