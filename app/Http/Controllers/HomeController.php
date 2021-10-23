<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->users =$user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = Auth::id();
        $users = $this->users->where('id','!=',$userId)->get();
        return view('home',compact('users'));
    }

    /**
     * Show the Chat Module.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function chat($id)
    {
        $chatUserTo = $this->users->where('id',$id)->first();
        $fromId = Auth::id();
        $chatUserFrom = $this->users->where('id',$fromId)->first();
        return view('chat',compact('chatUserFrom','chatUserTo'));
    }
}
