<?php

namespace App\Http\Controllers;

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
            "name" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
            "description" => "required|max:255|regex:/(^([a-zA-z])[a-zA-z 0-9.,]*([a-zA-Z]*)$)/u",
            "color" => "required|max:50|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
        ]);

        $name = strtoupper($request->name);
        $description = strtoupper($request->description);
        $color = strtoupper($request->color);

        try {
            Commission::create([
                "name" => $name,
                "description" => $description,
                "color" => $color,
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
        $commission = Commission::where( 'id', $id );
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
            "name" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
            "description" => "required|max:255|regex:/(^([a-zA-z])[a-zA-z 0-9.,]*([a-zA-Z]*)$)/u",
            "color" => "required|max:50|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
        ]);

        $name = strtoupper($request->name);
        $description = strtoupper($request->description);
        $color = strtoupper($request->color);

        try {
            $commission = Commission::find($id)([
                "name" => $name,
                "description" => $description,
                "color" => $color,
            ]);
            $commission->save();

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
            $commission = Commission::find($id);
            $commission->delete();
            
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
