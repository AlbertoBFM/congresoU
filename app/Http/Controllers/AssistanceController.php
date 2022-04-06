<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\Assistance;
use App\Models\Delegate;
use App\Models\Activity;

use Illuminate\Http\Request;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assistances = Assistance::get();
        return response()->json( $assistances );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $delegates = Delegate::get();
        $activities = Activity::get();
        return response()->json([
            "delegates" => $delegates,
            "activities" => $activities
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
         $fecha_Actual = date("Y-m-d");
 
         $this->validate( $request, [
            "check_in_time" => "required|after:".date("Y-m-d 00:00:00")
         ]);
 
        try {
            Assistance::create([
                "check_in_time" => $request->check_in_time,
                "delegate_id" => $request->delegate_id,
                "activity_id" => $request->activity_id   
            ]);
            return response()->json([
                'message'=>'Asistencia registrada correctamente'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al registrar Asistencia'
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
