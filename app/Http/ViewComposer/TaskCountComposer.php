<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Repositories\TaskRepository;

class TaskCountComposer {
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository ){
        $this->taskRepository = $taskRepository;
        
    }
    public function compose(View $view){
        //有关数据的处理尽量放置到repository中
        if(auth()->user()){
            $view->with([
                    'doneCount'=>$this->taskRepository->doneCount(),
                    'undoneCount'=>$this->taskRepository->undoneCount(),
                    'AllCount'=>$this->taskRepository->AllCount()
                ]);
        }
    }
}