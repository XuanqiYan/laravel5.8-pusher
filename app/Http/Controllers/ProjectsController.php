<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectRepository;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;


class ProjectsController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepository $projectRepository){
       
        $this->projectRepository = $projectRepository; 
        $this->middleware('auth');   
    }   

    public function index(){
        $projects = $this->projectRepository->index();
        return view('welcome',compact('projects'));
    }

    public function show(Project $project){
        $dones = $this->projectRepository->dones($project);   
        $undones = $this->projectRepository->undones($project);
        $projects = auth()->user()->projects()->pluck('name','id')->toArray();
       
        return view('projects.show',compact('project','dones','undones','projects'));
    }

    public function store(CreateProjectRequest $request){
        $this->projectRepository->store($request);
        return back(); 
    }

    public function destroy($id){   
       $this->projectRepository->destroy($id);
       return back();
    }

    public function update($id,UpdateProjectRequest $request){
        $this->projectRepository->update($id,$request);
        return back();
    }
        
}
