<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CheckController extends Controller
{
    //
    public $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function getUserName(Request $request){
        //echo $request->id;exit;

        //dd($this->user->find($request->id));
        if($this->user->find($request->id) != null)
            echo $this->user->find($request->id)->name;
        else
            echo 'No user found'; 
    }
}
