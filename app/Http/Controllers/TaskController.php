<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function store(){
        $task = Task::create(request(['name','description','user_id','week_day']));
        return $task;
    }

    public function index(){
        $tasks = DB::table('tasks')
        ->join('users', 'tasks.user_id', '=', 'users.id')
        ->select('tasks.*', 'users.name as user')
        ->get();

        return $tasks;
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

    private function adjustWeekday($weekDay){
        if ($weekDay === 0) {
            $adjustedWeekday = 7;
          }else{
            $adjustedWeekday = $weekDay;
          }
        return $adjustedWeekday;
    }

    public function getDay(){
        $fecha = Carbon::now();
        $weekDay = $fecha->dayOfWeek;
        $weekDay = $this->adjustWeekday($weekDay);
        $tasks = DB::table('tasks')
        ->join('users', 'tasks.user_id', '=', 'users.id')
        ->select('tasks.*', 'users.name as user')
        ->where('week_day', '=', $weekDay)
        ->get();
        return $tasks;
    }

    public function completeTask(Task $task){
        $task = Task::find($task->id);
        
        if(!$task){
            return "Error task not found";
        }
            
        if($task->completed != true){
            $task->completed = true;
            $task->save();
            return "task completed";
        }else{
            $task->completed = false;
            $task->save();
            return "task marked as uncompleted";
        }

    }

}
