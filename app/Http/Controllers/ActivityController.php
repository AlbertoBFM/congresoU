<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use App\Models\Activity;
use App\Models\Commission;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::get();
        return response()->json( $activities );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commissions = Commission::get();
        return response()->json( $commissions );
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
            "title" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "description" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "date" => "required|after:".date("Y-m-d"),
            "observation" => "required|max:200|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
        ]);

        try {
            Activity::create([
                "title" => strtoupper($request->title),
                "description" => strtoupper($request->description),
                "date" => $request->date,
                "observation" => strtoupper($request->observation),
                "commission_id" => $request->commission_id,
            ]);
            return response()->json([
                'message'=>'Actividad registrada correctamente'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al registrar Actividad'
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
        $activity = Activity::find( $id );
        $commissions = Commission::get();

        return response()->json([
            "activity" => $activity,
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
        $this->validate( $request, [
            "title" => "required|max:50|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "description" => "required|max:100|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
            "date" => "required|after:".date("Y-m-d"),
            "observation" => "required|max:200|regex:/(^([a-zA-ZÀ-ÿ])[a-zA-ZÀ-ÿ ']*([a-zA-ZÀ-ÿ]*)$)/u",
        ]);

        try {
            Activity::find( $id )->fill([
                "title" => strtoupper($request->title),
                "description" => strtoupper($request->description),
                "date" => $request->date,
                "observation" => strtoupper($request->observation),
                "commission_id" => $request->commission_id,
            ])->save();

            return response()->json([
                'message'=>'Actividad modificada correctamente'
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al modificar Actividad'
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
            $activity = Activity::find( $id )->delete();
            
            return response()->json([
                'message'=>'Actividad eliminada'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error al eliminar Actividad'
            ]);
        }
    }
}
