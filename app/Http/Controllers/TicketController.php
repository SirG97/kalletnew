<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{
    public function tickets(){
        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        return view('tickets',['tickets' => $tickets]);
    }

    public function newTicket(){
        $categories = Category::all();
        return view('newticket', ['categories' => $categories]);
    }

    public function createTicket(Request $request){
        $request->validate([
            'title' => 'required|max:30',
            'category'=> 'required',
            'priority' => 'required',
            'message' => 'required'
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'priority' => $request->priority,
            'message' => $request->message,
            'user_id' => auth()->user()->id,
            'ticket_id' => Str::random(8),
            'status' => 'open',
        ]);

        return redirect(route('tickets'))->with('success', `Ticket with ID #{$ticket->ticket_id} has been opened`);
    }

    public function ticket($id){
        $ticket = Ticket::where('ticket_id', $id)->with(['comments'])->firstOrFail();
//        $comments = Comment::where('ticket_id', $ticket->id)->with(['user', 'admin'])->get();
        $totalTicket = Ticket::where([['user_id','=', auth()->user()->id]])->count();
        $openTicket = Ticket::where([['status','=', 'open'],['user_id','=', auth()->user()->id]])->count();
        $closedTicket = Ticket::where([['status','=', 'closed'],['user_id','=', auth()->user()->id]])->count();

        return view('ticket', compact('ticket','totalTicket', 'openTicket', 'closedTicket'));
    }

    public function comment(Request $request){
        $request->validate([
            'comment' => 'required',
            'id' => 'required'
        ]);



        $comment = Comment::create([
            'ticket_id' => $request->id,
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
        ]);
        Ticket::where('id', $request->id)->update(['status' => 'open']);

//        if($comment->ticket->user->id !== Auth::user()->id) {
//            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
//        }
        return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}
