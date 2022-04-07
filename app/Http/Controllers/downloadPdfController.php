<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\School;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class downloadPdfController extends Controller
{
    public $schedule = [[], []];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function descargarPdf()
    {
        $user = User::where('id',auth()->user()->id)->with('roles')->get();
        if($user[0]->roles[0]->pivot->role_id == 3){

            $school = School::first();
            $schedules = Schedule::where('grade_id',$user[0]->student->current_grade_id)
            ->where('group_id',$user[0]->student->current_group_id)->with(['grade','group','day'])->get();
           $grade = Grade::where('id', $user[0]->student->current_grade_id)->first();
            $group = Group::where('id', $user[0]->student->current_group_id)->first();
            $date = Carbon::now();
            $pdf = PDF::loadView(
                    "documents.horarios",
                    compact("schedules", "school", "grade", "group", "date")
                )->setPaper('a4', 'landscape');
    
                // $saved = Storage::put("public/test/".  'horario_' . date('Y-m-d h-m-s') . ".pdf",$pdf->output());
                // $path = Storage::putFile("", new File('public/schedules/', 'public'));
                return response()->streamDownload(function () use($pdf) {
                    echo $pdf->stream();
                }, 'horario.pdf');
             //return $schedules;
        }
     //   else 'no es alumno';
      //  return $user[0]->roles[0]->pivot->role_id;
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
        //
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
