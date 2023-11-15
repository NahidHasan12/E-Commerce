<?php

namespace App\Http\Controllers\Website;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ticketController extends Controller
{
   // Open Ticket
   public function open_ticket(){
    $ticket = Ticket::where('user_id',Auth::id())->latest()->take(10)->get();
    return view('frontend.user.ticket', compact('ticket'));
    }

    // New Ticket
    public function new_ticket(){
        return view('frontend.user.new_ticket');
    }

    // store ticket
    public function store_ticket(Request $request){
        $request->validate([
            'subject'=> 'required',
        ]);

        $ticketData = [
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'service' => $request->service,
            'priority' => $request->priority,
            'message' => $request->message,
            'status' => 0,
            'date'  => date('Y-m-d'),
        ];

        if ($request->hasFile('image')) {
            // Store the uploaded image in the appropriate directory
            $ticketData['image'] = $this->file_upload($request->file('image'), 'frontend/ticket_img');
        }
        $ticket = Ticket::create($ticketData);


        $message = array('message'=>'Successful ticket Send','alert-type'=>'success' );
        return redirect()->back()->with($message);
    }

    // Show Ticket
    public function show_ticket($id){
        $show_ticket = Ticket::where('id',$id)->first();
        return view('frontend.user.show_ticket', compact('show_ticket'));
    }
}
