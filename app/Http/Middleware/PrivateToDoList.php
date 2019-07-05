<?php

namespace App\Http\Middleware;

use App\Entities\Access;
use App\Entities\TodoList;
use App\Http\Controllers\Client\TodoListsController;
use App\Repositories\AccessRepository;
use App\Repositories\Eloquent\TodoListRepositoryEloquent;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Repositories\TodoListRepository;

class PrivateToDoList
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $code = '';
        $code = @$request->code;
        if($code == ''){
            $list_id = '';
            $list_id = @$request->todo_list_id;
            if($list_id == '') $list_id = $request->todoid;
            if($list_id == '') return redirect()->route('home');
            $todoList = TodoList::where('id', $list_id)->first();
            $code = $todoList->link;
        } else{
            $todoList = TodoList::where('link', $code)->first();
        }
        if($todoList == null ) return redirect()->route('home');
        if($todoList->is_public) return $next($request);
        if(Auth::user()->level==2) return $next($request);
        if(Auth::user()->id == $todoList->owner_id) return $next($request);
        $Access = Access::where('todo_list_id', $todoList->id)->get();
        foreach ($Access as $acs)
        {
            if($acs->user_id == Auth::user()->id) return $next($request);
        }
        return redirect()->route('home');
    }
}
