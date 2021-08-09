<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\TakingTest;
use App\Models\AcadYear;
use App\Models\AnswerSheet;



class StudentSectionTakenController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function index(){
        return view('panel.student_section_taken.student-section-taken');
    }

    public function index_data(Request $req){
        $sort = explode('.', $req->sort_by);
        $data = DB::table('taking_test as a')
            ->join('acad_years as b', 'a.acad_year_id', 'b.acad_year_id')
            ->join('registrar_gadtc.tblstudhinfo as c', 'a.user_id', 'c.StudID')
            ->join('sections as d', 'a.section_id', 'd.section_id')
            ->select('a.taking_test_id', 'a.acad_year_id', 'b.code', 'b.description',
                DB::raw('date(a.created_at) as created_date'), DB::raw('date_format(a.created_at,"%h:%i") as created_time'),
                'c.StudID', 'c.StudLName', 'c.StudFName', 'c.StudMName',
                'd.section_id', 'd.section',
                'a.student_schedule_id')
            ->where('StudLName', 'like', $req->lname . '%')
            ->where('StudFName', 'like', $req->fname . '%')
            ->paginate($req->perpage);

        return $data;
    }

    public function deleteTaken(Request $req){

        //return $req->StudID;
        TakingTest::where('taking_test_id', $req->taking_test_id)
            ->delete();

        AnswerSheet::where('code', $req->code)
            ->where('student_id', $req->StudID)
            ->where('section_id', $req->section_id)
            ->delete();

        
        return ['status' => 'deleted'];
    }



}
