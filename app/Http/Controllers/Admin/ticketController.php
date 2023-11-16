<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ticketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.ticket.index');
    }

    public function getTicket(Request $request){

        //dd($request->status);

        if($request->ajax()){
            $getData = Ticket::latest('id');

            if ($request->type) {
               $getData->where('service',$request->type); // request coming from index page
            }

            if ($request->date) {
                $getData->where('date',$request->date); // request coming from index page
            }

            if ($request->status) {
               $getData->where('status',$request->status); // request coming from index page
            }

            return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->addColumn('action', function($ticket){
                $action = '
                    <a href="'.route('admin.ticket.show',$ticket->id).'"  id="view-btn" class="btn btn-info btn-sm"><i class="fa fa-eye text-white"> </i></a>
                    <button data-id="'.$ticket->id.'" id="delete-btn" class="btn btn-danger btn-sm"><i class="fa fa-trash text-white"> </i></button>
                ';

                return $action;
            })

            ->addColumn('name', function($ticket) {
                return $ticket->user->name;
            })

            ->addColumn('date', function($ticket) {
                return date('d-M-Y', strtotime($ticket->date));
            })

            ->addColumn('status', function($ticket) {

                if ($ticket->status ==0) {
                return '<span class="badge badge-warning"> Pending </span>';
               }elseif($ticket->status ==1){
                return '<span class="badge bg-info"> Replied </span>';
               }elseif($ticket->status ==2){
                return '<span class="badge badge-secondary"> Closed </span>';
               }

            })

            ->rawColumns(['action','status','name','date'])
            ->make(true);

        }
    }

}
