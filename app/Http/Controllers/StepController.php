<?php

namespace App\Http\Controllers;

use App\Step;
use Illuminate\Http\Request;
use App\Task;

class StepController extends Controller
{
    public function completedAll(Task $task){
        $task->steps()->update([
            'completion'=>true
        ]);
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        //一般返回api数据格式
        return response()->json([
            'steps'=>$task->steps
        ],200);
       
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
    public function store(Task $task , Request $request)
    {
        return response()->json([
            'step'=>$task->steps()->create($request->only('name'))->refresh()
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task , Step $step)
    {
        $step->completion = $request->completion;
        $step->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task , Step $step)
    {
        $step->delete();
        return response()->json([
            'message'=>'当前step删除成功'
        ],204); 
    }
}
