<?php

namespace App\Http\Controllers;

use App\Models\UserHistory;

class UserHistoryController extends Controller
{
    public function index()
    {
        $user_histories = UserHistory::get();
        
        return view('modules.user_histories.index', compact('user_histories'));
    }
}
