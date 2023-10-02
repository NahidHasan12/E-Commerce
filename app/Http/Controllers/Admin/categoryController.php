<?php

namespace App\Http\Controllers\Admin;

use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class categoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //all catergory showing method
    public function index(){
        return view('admin.category.cat.index');
    }
    public function getData(Request $request){
        if ($request->ajax()) {

            $getData = category::latest('id');
            // dd($getData);

            return DataTables::eloquent($getData)
            ->addIndexColumn()

            ->rawColumns([])
            ->make(true);


        }
    }





}
