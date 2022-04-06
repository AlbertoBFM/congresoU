<?php

namespace App\Http\Controllers;

use App\Models\Delegate;

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
        return response()->json($delegates);  
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
        //fecha actual
        $fecha_Actual = date("Y-m-d");
        $fecha_mayoria_edad = date("Y-m-d", strtotime($fecha_Actual."- 18 year"));

        $this->validate( $request, [
            "p_lastname" => "required|max:50|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
            "m_lastname" => "required|max:50|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
            "names" => "required|max:100|regex:/(^([a-zA-z])[a-zA-z ']*([a-zA-Z]*)$)/u",
            "ci" => "required|unique:delegates|numeric",
            "d_birth" => "required|before:".$fecha_mayoria_edad,
        ]);

        $p_lastname = strtoupper($request->name);
        $m_lastname = strtoupper($request->name);
        $names = strtoupper($request->name);

        try {
            University::create([
                "p_lastname" => $p_lastname,
                "m_lastname" => $m_lastname,
                "names" => $names,
                "ci" => $request->ci,
                "d_birth" => d_birth,
                "user_id" => $request->user_id,
                "university_id" => $request->university_id,
                "commission_id" => $request->commission_id 
            ]);
            return response()->json([
                'message'=>'Universidad registrada correctamente'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al registrar la universidad'
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
