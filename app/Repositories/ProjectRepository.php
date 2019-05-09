<?php
namespace  App\Repositories;

use Image;
use App\Project;
use Illuminate\Support\Facades\Auth;

class ProjectRepository{

    public function index(){
        return  Auth::user()->projects()->get(); // ---> 列出登录用户的所有projects
    }
    public function store($request){
        $request->user()->projects()->create([
            'name'=>$request->input('name'),
            'thumbnail'=> $this->savePic($request)
        ]);
    }
    
    private function savePic($request){
        
        if($request->hasFile('thumbnail')){
            //获取原始图片
            $thumbnail = $request->thumbnail;
            //生成一个HashName名称
            $name = $thumbnail->hashName();
            //保存用户原始图片
            $thumbnail->storeAs('public/thumbs/original',$name);
            //image只能根据系统绝对路径保存图片
            $path = storage_path('app/public/thumbs/cropped/'.$name);
            /*
                报错："Can't write image data to path “
                1.image 图片路径不会自动生成 --> 需要手动创建
                2.对storage没有写入权限     --> chmod -R 777 ~/code

            */
            //保存更改大小的图片 
            Image::make($thumbnail)->resize(200,90)->save($path);
            /* 
                    make   读取图片文件信息
                    resize 已制定的宽高保存图片
                    save   保存到指定的文件夹和文件片
            */
            return $name;
        }
        
        //return $request->hasFile('thumbnail') ? $request->thumbnail->store('public/thumbs') : null ;    
    }
    public function find($id){
        return Project::findOrFail($id);   
    }
    public function dones(Project $project){
        return $project->tasks()->where('completion',1)->get();

    }
    public function undones(Project $project){
        return $project->tasks()->where('completion',0)->get();

    }
    public function findWithTasks($id){
        return Project::with('tasks')->findOrFail($id);
    }
    public function destroy($id){   
        $this->find($id)->delete();
    }

    public function update($id,$request){
        $project = $this->find($id);
        $project->name = $request->name;
        if($request->hasFile('thumbnail')){
            $project->thumbnail = $this->savePic($request);
        }
        $project->save();
    }

}

