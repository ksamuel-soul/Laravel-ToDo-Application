<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function retriveAll($uname)
    {
        return task::where('User_Name', $uname)->get();
    }
    
    public function store(Request $request)
    {
        $fields = $request->validate([
            'Task_Name'=>'required|max:255',
            'User_Name'=>'required|max:255',
            'Task_Description'=>'required|max:255',
            'Status'=>'required|max:255'
        ]);
        $post = task::create($fields);
        return [
            // 'post'=>$post,
            "Id"=>$post->id,
            'Status'=>200,
            'Message'=>'Task Created Successfully..!!!'
        ];
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $fields = $request->validate([
            'Task_Name'=>'required|max:255',
            'Task_Description'=>'required|max:255',
            'Status'=>'required|max:255'
        ]);
        $task->update($fields);
        return [
            'Message'=>'Task Updated Successfully..!!!',
            'Status'=>200
        ];
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return[
            'Message'=>'Task Deleted Successfully..!!!',
            'Status'=>200
        ];
    }
}
