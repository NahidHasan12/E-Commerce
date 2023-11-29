<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Reply;
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
                    <a href="'.route('admin.ticket.show',$ticket->id).'" title="Show Ticket" id="view-btn" class="btn btn-info btn-sm"><i class="fa fa-eye text-white"> </i></a>
                    <button type="submit" class="btn btn-sm btn-danger m-1 delete-btn" data-id="'.$ticket->id.'"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
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

    // show admin ticket
    public function showTicket($ticket_id){
        $ticket = Ticket::where('id',$ticket_id)->first();
        $reply = Reply::where('ticket_id', $ticket->id)->orderBy('id','ASC')->get();
        return view('admin.ticket.show_ticket', compact('ticket','reply'));
    }

    // Reply store
    public function replyStore(Request $request){
        $request->validate([
            'message'=> 'required',
        ]);

        $ticketData = [
            'user_id' => 0,
            'message' => $request->message,
            'ticket_id' => $request->ticket_id,
            'reply_date'  => date('Y-m-d'),
        ];

        if ($request->hasFile('image')) {
            // Store the uploaded image in the appropriate directory
            $ticketData['image'] = $this->file_upload($request->file('image'), 'frontend/ticket_img');
        }
        $ticket = Reply::create($ticketData);

        Ticket::where('id', $request->ticket_id)->update(['status'=>1]);

        $message = array('message'=>'Replied Done','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }

    // close admin ticket
    public function closeTicket($id){
        Ticket::where('id', $id)->update(['status'=>2]);
        $message = array('message'=>'Ticket Closed','alert-type'=>'success' );
        return redirect()->route('admin.ticket.index')->with($message);
    }

    // Destroy Ticket
    public function destroyTicket(Request $request){
        if($request->ajax()){
            $ticket = Ticket::findOrFail($request->ticket_id);

            if(file_exists('../frontend/ticket_img/'.$ticket->image)){
                unlink('../frontend/ticket_img/'.$ticket->image);
            }

            $ticket->delete();
            $message = array('message'=>'Ticket Deleted','alert-type'=>'success' );
            return redirect()->back()->with($message);
        }
    }

}
