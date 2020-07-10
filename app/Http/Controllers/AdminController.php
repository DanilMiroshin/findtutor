<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\UserStatus;

class AdminController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        return view('admin', compact('users'));
    }
    /**
     * Approve teacher to show him in search
     * @param  int $id 
     * @return redirect back
     */
    public function approved($id)
    {
        UserStatus::where('user_id', $id)->update(['isApproved' => 1]);
        return back();
    }

    /**
     * Unapprove teacher to remove him from search
     * @param  int $id 
     * @return redirect back
     */
    public function unApproved($id)
    {
        UserStatus::where('user_id', $id)->update(['isApproved' => 0]);
        return back();
    }

    /**
     * Block user
     * @param  int $id
     * @return redirect back
     */
    public function block($id)
    {
        UserStatus::where('user_id', $id)->update(['isBanned' => 1]);
        return back();   
    }

    /**
     * Unblock user
     * @param  int $id
     * @return redirect back
     */
    public function unBlock($id)
    {
        UserStatus::where('user_id', $id)->update(['isBanned' => 0]);
        return back();     
    }
}
