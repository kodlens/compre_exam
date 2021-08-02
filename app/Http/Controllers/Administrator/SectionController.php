<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
 

use App\Models\Section;

class SectionController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth:admin');
        $this->middleware('admin');
    }

    public function index(){
        return view('panel.section.panel-section');
    }

    public function index_data(Request $req){
        $sort = explode('.', $req->sort_by);
        $data = Section::orderBy($sort[0], $sort[1])
            ->paginate($req->perpage);

        return $data;
    }

    public function disapproveProgram(Request $req, $id){
        $data = Section::find($id);
        $data->is_allow = 0;
        $data->save();

        return response()->json([
            'status' => 'updated'
        ]);
    }

    public function approveProgram(Request $req, $id){
        $data = Section::find($id);
        $data->is_allow = 1;
        $data->save();
        
        return response()->json([
            'status' => 'updated'
        ]);
    }

    public function create(){
        return view('panel.section.panel-section-create');
    }

    public function store(Request $req){
        return $req;
    }


}
