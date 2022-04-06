<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\Commission;

use Illuminate\Http\Request;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commissions = Commission::get();
        return response()->json( $commissions );
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
            "description" => "required|max:255|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-Z 0-9.,]*([a-zA-ZÀ-ÿ]*)$)/u",
            "color" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
        ]);

        try {
            Commission::create([
                "name" => strtoupper($request->name),
                "description" => strtoupper($request->description),
                "color" => strtoupper($request->color),
            ]);
    
            return response()->json([
                'message'=>'Comisión registrada correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al registrar Comisión'
            ]);
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
        $commission = Commission::find( $id );
        return response()->json( $commission );
        
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
            "description" => "required|max:255|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-Z 0-9.,]*([a-zA-ZÀ-ÿ]*)$)/u",
            "color" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
        ]);

        try {
            Commission::find( $id )->fill([
                "name" => strtoupper($request->name),
                "description" => strtoupper($request->description),
                "color" => strtoupper($request->color),
            ])->save();

            return response()->json([
                'message'=>'Comisión modificada correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al modificar Comisión'
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
            $commission = Commission::find( $id )->delete();
            
            return response()->json([
                'message'=>'Commission eliminada'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al eliminar Commission'
            ]);
        }
    }
}