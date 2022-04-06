<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\Delegate;
use App\Models\University;
use App\Models\Commission;

use Illuminate\Http\Request;

class DelegateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delegates = Delegate::get();
        return response()->json( $delegates );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $universities = University::get();
        $commissions = Commission::get();
        return response()->json([
            "universities" => $universities,
            "commissions" => $commissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //fecha actual
        $fecha_Actual = date("Y-m-d");
        $fecha_mayoria_edad = date("Y-m-d", strtotime($fecha_Actual."- 18 year"));

        $this->validate( $request, [
            "p_lastname" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "m_lastname" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "names" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "ci" => "required|unique:delegates|numeric",
            "d_birth" => "required|before:".$fecha_mayoria_edad,
        ]);

        try {
            Delegate::create([
                "p_lastname" => strtoupper($request->p_lastname),
                "m_lastname" => strtoupper($request->m_lastname),
                "names" => strtoupper($request->names),
                "ci" => $request->ci,
                "d_birth" => $request->d_birth,
                "uuid" => $request->uuid,
                "university_id" => $request->university_id,
                "commission_id" => $request->commission_id 
            ]);
            return response()->json([
                'message'=>'Delegado/a registrado/a correctamente'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al registrar Delegado/a'
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
        $delegate = Delegate::find( $id );
        $universities = University::get();
        $commissions = Commission::get();

        return response()->json([
            "delegate" => $delegate,
            "universities" => $universities,
            "commissions" => $commissions
        ]);
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
        //fecha actual
        $fecha_Actual = date("Y-m-d");
        $fecha_mayoria_edad = date("Y-m-d", strtotime($fecha_Actual."- 18 year"));

        $this->validate( $request, [
            "p_lastname" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "m_lastname" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "names" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "ci" => "required|unique:delegates,ci,".$id."|numeric",
            "d_birth" => "required|before:".$fecha_mayoria_edad,
        ]);

        try {
            Delegate::find( $id )->fill([
                "p_lastname" => strtoupper($request->p_lastname),
                "m_lastname" => strtoupper($request->m_lastname),
                "names" => strtoupper($request->names),
                "ci" => $request->ci,
                "d_birth" => $request->d_birth,
                "uuid" => $request->uuid,
                "university_id" => $request->university_id,
                "commission_id" => $request->commission_id 
            ])->save();

            return response()->json([
                'message'=>'Delegado/a modificado/a correctamente'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al modificar Delegado/a'
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
            $delegate = Delegate::find( $id )->delete();
            
            return response()->json([
                'message'=>'Delegado/a eliminada'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al eliminar Delegado/a'
            ]);
        }
    }
}
