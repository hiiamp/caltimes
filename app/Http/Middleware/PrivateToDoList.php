<?php

namespace App\Http\Middleware;

use App\Entities\Access;
use App\Entities\TodoList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateToDoList
{

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $code = '';
        $code = @$request->code;
        if ($code == '') {
            $list_id = '';
            $list_id = @$request->todo_list_id;
            if ($list_id == '') $list_id = $request->todoid;
            if ($list_id == '') return redirect()->route('home');
            $todoList = TodoList::where('id', $list_id)->first();
            $code = $todoList->link;
        } else {
            $todoList = TodoList::where('link', $code)->first();
        }
        if ($todoList == null) return redirect()->route('welcome')->with('status', 'This list isn\'t exist, please check your code!');
        if ($todoList->is_public) return $next($request);
        if (!Auth::check()) return redirect()->route('welcome')->with('status', 'This list is private, you need login to access it!');
        if (Auth::user()->level == 2) return $next($request);
        if (Auth::user()->id == $todoList->owner_id) return $next($request);
        $Access = Access::where('todo_list_id', $todoList->id)->get();
        foreach ($Access as $acs) {
            if ($acs->user_id == Auth::user()->id) return $next($request);
        }
        return redirect()->route('home');
    }
}
