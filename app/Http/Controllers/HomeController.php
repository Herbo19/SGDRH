<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()->notifications()->find($id);


        if ($notification) {
            $id = $notification->data['idmeta'];
            $notification->markAsRead();
            return redirect()->route('metas.show',$id);
        }

        return back();
    }
}
