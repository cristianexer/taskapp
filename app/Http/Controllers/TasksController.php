<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskList;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'content' => 'required',
            'status' => 'required',
            'deadline' => 'required',
            'tasks_list_id' => 'required'
        ]);

        $create = Tasks::create($request->all());

        return response()->json(['status' => $create,'msg'=>'Task list was created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        if(Auth::check() && TaskList::find(Tasks::find($id)->tasks_list_id)->user_id == Auth::id() ){
            return response()->json(Tasks::where('id',$id)->get());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Tasks::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=> 'required',
            'content' => 'required',
            'status' => 'required',
            'deadline' => 'required',
            'tasks_list_id' => 'required'
        ]);

        $task = Tasks::find($id);

        if($task->count()){
            $task->update($request->all());
            return response()->json(["status"=>"success"]);
        }
        else{
            return response()->json(["status"=>"error"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tasks::find($id);

        if($task->count()){
            $task->delete();
            return response()->json(['status'=>"Success"]);
        }
        else{
            return response()->json(['status'=>"Error"]);
        }
    }
}
