<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;


class TaskManager extends Controller
{
    function listTask()
    {
        $tasks = Tasks::where("user_id", auth()->user()->id)->where("status", NULL)->paginate(4);
        return view("welcome", compact("tasks"));
    }

    function addTask()
    {
        return view('tasks.add');
    }

    function addTaskPost(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'deadline' => 'required',
        ]);
        // Create a new task
        $task = new Tasks();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->user_id = auth()->user()->id; // Assuming you have user authentication

        if($task->save()){
            return redirect(route("home"))
                ->with("success", "Task added successfully.");
        }
        return redirect(route("task.add"))
            ->with("error", "Failed to add task. Please try again.");
        
    }

    function updateTaskStatus($id)
    {
        if(Tasks::where("user_id", auth()->user()->id)->where('id', $id)->update(['status' => "completed"])){
            return redirect(route("home"))->with("success", "Task completed successfully.");
        }
        return redirect(route("home"))->with("error", "Failed to completed task. Please try again.");

    }

    function deleteTask($id)
    {
        if(Tasks::where("user_id", auth()->user()->id)->where('id', $id)->delete()){
            return redirect(route("home"))->with("error", "Task Deleted !!");
        }
        return redirect(route("home"))->with("error", "An error occurred while deleting the task !!");

    }

}
