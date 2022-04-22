<?php

namespace App\Http\Controllers;

date_default_timezone_set("America/La_Paz");

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

use App\Models\Delegate;
use App\Models\University;
use App\Models\Commission;

use App\Models\User;


class ReportController extends Controller
{
    public function reportDelegatesU(){
        $delegates = Delegate::all();
        $universities = University::all();

        $pdf = PDF::loadView('delegate.reportDelegatesU', compact("delegates", "universities"))->setPaper('A4');
        return $pdf->stream('reportesDelegadosU.pdf');
    }

    public function reportDelegatesC(){
        $delegates = Delegate::all();
        $commissions = Commission::all();

        $pdf = PDF::loadView('delegate.reportDelegatesC', compact("delegates", "commissions"))->setPaper('A4');
        return $pdf->stream('reportesDelegadosC.pdf');
    }

}