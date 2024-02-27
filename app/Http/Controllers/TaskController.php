<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;


class TaskController extends Controller
{
    public function store(){
        $task = Task::create(request(['name','description','user_id','week_day']));
        return $task;
    }

    public function index(){
        $task = Task::all();
        return $task;
    }

    public function update(Request $request, Task $task){
        $task = Task::find($task->id);
        if($task){
            
            $task->name = $request->name;
            $task->description = $request->description;
            $task->week_day = $request->week_day;

        }else{
            return "task not found";
        }
    }

    public function destroy(Task $task){
        $task = Task::find($task->id);
        if($task){
            $task->delete();
            return "task deleted successfully";
        }else{
            return "task could'nt be deleted";
        }

    }

    public function getDay(){
        $fecha = Carbon::now();
        $diaSemana = $fecha->locale('es')->dayName; 
        echo "Hoy es " . $diaSemana;
    }

    public function completeTask(Task $task){
        $task = Task::find($task->id);
        
        if(!$task){
            return "Error task not found";
        }
            
        if($task->completed != true){
            $task->completed = true;
            return "task completed";
        }else{
            $task->completed = false;
            return "task marked as uncompleted";
        }

    }

}
