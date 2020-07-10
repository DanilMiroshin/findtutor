<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function find(Request $request)
    {
        $results = DB::table('users')
            ->join('users_status', 'users.id', '=', 'users_status.user_id')
            ->join('teachers', 'users.id', '=', 'teachers.user_id')
            ->where([
                    ['teachers.subject', 'like', $request->subject],
                    ['users_status.isApproved', '=', 1],
                    ['teachers.price', '<', $request->range],
                ])
            ->paginate(5);
        return  view('search', compact ('results'));
    }
}
