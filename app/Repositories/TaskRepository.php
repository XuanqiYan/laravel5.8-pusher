<?php
namespace App\Repositories;

use App\Project;
use App\Task;

class TaskRepository{

    public function store($request) {
        
         $project = Project::findOrFail($request->projectId);
        
        $project->tasks()->create([
            'name' => $request->name,
            'completion' => (int) false
        ]);
    }

    public function find($id){
        return Task::findOrFail($id);
    }
    public function check($id){
        $task = $this->find($id);
        $task->completion = (int) true;
        $task->save();
    }

    public function update($request,$id){
        $task = $this->find($id);
        $task->name = $request->name;
        $task->project_id = $request->project_id;
        $task->save();
    }

    public function done(){
        return auth()->user()->tasks()->where('completion',(int) true)->paginate(3,['*'],'page');
    }
    public function undone(){
        return auth()->user()->tasks()->where('completion',(int) false)->paginate(3);
    }

    public function doneCount(){
        return auth()->user()->tasks()->where('completion',(int) true)->count();
    }
    public function undoneCount(){
        return auth()->user()->tasks()->where('completion',(int) false)->count();
    }
    public function AllCount(){
        return auth()->user()->tasks()->count();
    }
}
