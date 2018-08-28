<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\TaskList;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function home(){
        return view('app');
    }
    public function index()
    {
        if(Auth::check()){
            $taskLists = TaskList::where('user_id',Auth::id())->get();
            foreach( $taskLists as $tasklist){
                $tasklist->tasks = Tasks::where('tasks_list_id','=',$tasklist->id)->count();
            }

            return $taskLists;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'description' => 'required'
        ]);
        $id = Auth::id();
        $request->merge(['user_id' => Auth::id()]);
        $create = TaskList::create($request->all());

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
        if(Auth::check() && TaskList::find($id)->user_id == Auth::id()){
            return response()->json([
                'taskList' => TaskList::where('id',$id)->get(),
                'tasks' => Tasks::where('tasks_list_id',$id)->get()
                ]);
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
        return TaskList::find($id);
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
            'description' => 'required'
        ]);

        $task = TaskList::find($id);

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
        
        $task = TaskList::find($id);

        if($task->count()){
            $task->delete();
            return response()->json(['status'=>"Success"]);
        }
        else{
            return response()->json(['status'=>"Error"]);
        }


    }
}
