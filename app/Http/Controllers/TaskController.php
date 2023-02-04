<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Task; 

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

        return Inertia::render('Tasks/Index', [
            'collection'=>[
                'tasks' => $tasks
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'description' => 'required',
            'status'=> 'required',
            'assignee'=> 'required'
        ]);
        $validation->validate();
        
        $task = new Task();
        $task->description = $request->description;
        $task->status = $request->status == 'Active' ? 1 : 0;
        $task->assignee = $request->assignee;
        $task->save();

        request()->session()->flash('flash.banner', 'Successfully Saved Task');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task =Task::find($id);

        return Inertia::render('Tasks/Edit', [
            'task' => $task
        ]);
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
        $validation = $request->validate([
            'description' => 'required',
            'status'=> 'required',
            'assignee'=> 'required'
        ]);
        $validation->validate();

        $task = Task::find($id);
        $task->description = $request->description;
        $task->status = $request->status;
        $task->assignee = $request->assignee;
        $task->save();

        request()->session()->flash('flash.banner', 'Successfully Updated Task');

        return Inertia::location(route('tasks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        request()->session()->flash('flash.banner', 'Successfully Deleted Task');
        return back();
    }
}
