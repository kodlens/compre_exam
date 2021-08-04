<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\AnswerSheet;
use App\Models\Program;
use App\Models\Section;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentResultController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }


    public function index(){
        
        $sections = Section::orderBy('section')->get();
        return view('panel.student_result.student-result')
            ->with('sections', $sections);
    }

    public function index_data(Request $req){
        //return Question::all();
        //$sortkey = explode(".",$req->sort_by);
        return DB::table('answer_sheets as a')
            ->join('registrar_gadtc.tblstudhinfo as b', 'a.student_id', 'b.StudID')
            ->join('sections as c', 'a.section_id', 'c.section_id')
            ->join('answers as d', 'a.answer_sheet_id', 'd.answer_sheet_id')
            ->join('options as e', 'd.option_id', 'e.option_id')
            ->join('questions as f', 'e.question_id', 'f.question_id')
            ->where('b.StudID', $req->user_id == '' ? 'like' : '=', $req->user_id == '' ? '%' : $req->user_id)
            ->where('b.StudLName', 'like', $req->lname .'%')
            ->where('c.section', 'like', $req->section .'%')
            ->where('e.is_answer', 1)
            ->select('a.answer_sheet_id', 'a.code', 'a.student_id', 'b.StudID', 'b.StudLName', 'b.StudFName', 'b.StudMName',
                'b.StudSex', 'b.StudCourse',
                'a.section_id', 'c.section', DB::raw('sum(f.score) as score'), 'a.created_at')
            ->groupBy('a.section_id', 'a.student_id', 'a.code')
            ->orderBy('score', 'desc')
            ->paginate($req->perpage);
    }


    public function reportStudentResult(Request $req){
        //return Question::all();
        //return $req->section;

        return DB::table('answer_sheets as a')
            ->join('registrar_gadtc.tblstudhinfo as b', 'a.student_id', 'b.StudID')
            ->join('sections as c', 'a.section_id', 'c.section_id')
            ->join('answers as d', 'a.answer_sheet_id', 'd.answer_sheet_id')
            ->join('options as e', 'd.option_id', 'e.option_id')
            ->join('questions as f', 'e.question_id', 'f.question_id')
            ->where('c.section', 'like', $req->section .'%')
            ->where('e.is_answer', 1)
            ->select('a.answer_sheet_id', 'a.code', 'a.student_id', 'b.StudID', 'b.StudLName', 'b.StudFName', 'b.StudMName',
                'b.StudSex', 'b.StudCourse',
                'a.section_id', 'c.section', DB::raw('sum(f.score) as score'), 'a.created_at')
            ->groupBy('a.section_id', 'a.student_id', 'a.code')
            ->orderBy('score', 'desc')
            ->get();
    }

    public function destroy($id){
        AnswerSheet::destroy($id);
        return ['status'=>'deleted'];
    }
}
