<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Support\Arr;

class MainPageController extends Controller
{

    public function __invoke()
    {
        $teachers = User::whereHas('status', function (Builder $query) {
            $query->where('isApproved', 1);
        })
        ->get();

        return view('main', 
            $teachers->count() < 4 ? 
            ['teachers' => $teachers ] : 
            ['teachers' => $teachers->random(4) ]);
    }
}
