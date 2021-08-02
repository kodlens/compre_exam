<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

use Auth;

class SectionPageController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth:student');
    }

    public function index(){


        $user_program = Auth::user()->StudCourse;

        $sections = Section::where('allow_program', 'ALL')
            ->orWhere('allow_program', $user_program)
            ->select('section_id', 'section', 'img_filename', 'set_time')
            ->get();

        return view('student.section-page')
            ->with('sections', $sections);
    }



}
