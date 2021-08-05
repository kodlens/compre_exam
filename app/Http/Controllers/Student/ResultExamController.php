<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AcadYear;
use App\Models\Section;
use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\DB;

class ResultExamController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:student');
        $this->middleware('student');
        //$this->middleware('allow_exam');
    }

    public function index(){
        return view('student.result-exam');
    }

    public function resultExam(){

        $student_id = Auth::user()->StudID;
        $ay = AcadYear::where('active', 1)->first();

        $data = DB::table('answers as a')
            ->join('options as b', 'a.option_id', 'b.option_id')
            ->join('answer_sheets as c', 'a.answer_sheet_id', 'c.answer_sheet_id')
            ->join('questions as d', 'b.question_id', 'd.question_id')
            ->join('sections as e', 'c.section_id', 'e.section_id')
            ->where('c.student_id', $student_id)
            ->where('code', $ay->code)
            ->select('c.section_id', 'e.section', DB::raw('sum(d.score) as score'))
            ->groupBy('c.section_id') 
            ->where('b.is_answer', 1)->get();

        return $data;

        //return DB::select('call proc_student_result(?, ?)',array($student_id, $ay->code));
    }





}
