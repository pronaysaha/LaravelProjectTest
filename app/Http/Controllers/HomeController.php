<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $dateFilter = $request->input('date', now()->format('Y-m-d'));
        $userFilter = $request->input('user', null);

        $posts = Post::with('user')
            ->whereDate('created_at', $dateFilter)
            ->when($userFilter, function ($query, $userFilter) {
                return $query->whereHas('user', function ($query) use ($userFilter) {
                    $query->where('name', $userFilter);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $users = Post::distinct('user_id')->with('user')->get(['user_id']);

        return view('home', compact('posts', 'dateFilter', 'userFilter', 'users'));
    }
}
