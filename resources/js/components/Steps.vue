<template>
    <div class="container">
        <div class="row justify-content-center" >
            <div class="col-4 mr-5" >
                <div class="card mb-4" v-show=' inProcess.length '>
                    <div class="card-header">
                        <span class='badge badge-pill badge-danger'>{{ inProcess.length }}</span>
                        待完成的步骤：
                        <button class='btn btn-sm btn-success pull-right' @click='completeAll'>完成所有</button>            
                    </div>
                    <div class="card-body">
                        <ul class='list-group'>
                            <li class='list-group-item' v-for='step in inProcess'>
                                <span @dblclick='edit(step)'>{{ step.name }}</span>
                                <span class='pull-right'>
                                    <i class='fa fa-check '  @click='toggle(step)'></i>
                                    <i class='fa fa-close '  @click='remove(step)'></i>
                                    <!-- 注意不能使用delete  -->
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-header">
                        <div class="form-group">
                            <label for="" v-if='!newStep'>要完成当前任务需要那些步骤呢?</label>
                            <input type="text" v-model='newStep' ref='newStep' @keyup.enter='addStep' class='form-control' placeholder="Please add an new Step~~">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="col-4">
                <div class="card" v-show=' processed.length '>
                    <div class="card-header" >
                        <span class='badge badge-pill badge-success'>{{ processed.length }}</span>
                        已经完成的步骤：
                        <button class='btn btn-sm btn-danger pull-right' @click='clearcompletion'>清除所有</button>
                    </div>
                    <div class="card-body">
                        <ul class='list-group'>
                            <li class='list-group-item' v-for='step in processed'>
                                {{ step.name }}
                                <span class='pull-right'>
                                    <i class='fa fa-check '  @click='toggle(step)'></i>
                                    <i class='fa fa-close '  @click='remove(step)'></i>
                                    <!-- 注意不能使用delete  -->
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>   
        </div>        
    </div>
</template>

<script>
    export default {
        props:['route'],
        created(){
            //created 时候并不能获取到dom元素 mounted时候能获取到dom元素 
            //created 发生的时间早于 mounted
            this.fetchSteps()
        },
        data(){
            return {
                'steps':[
                    {"name":"",'completion':false},
                   
                ],
                'newStep':''
            }
        },
        computed:{
            inProcess(){//未完成的
                return this.steps.filter((step)=>{//不更改原数组
                    return !step.completion;// true 为 保留  false 为不保留
                })
            },
            processed(){//完成的
                return this.steps.filter((step)=>{
                    return step.completion;
                });
            }
        },
        methods:{
            fetchSteps(){
                axios.get(this.route + '/steps').then((res)=>{
                    /*动态获取url
                        1.window.location.href+'/steps'
                            组件可以在别的地方使用，假如不再这个url下 ，那么这样的写法创建的url将不可用
                        2.this.route+'/steps'
                            props:['route']
                            <steps route='{{ route('tasks.show',$task->id) }}'></steps>   
                        3.一步到位
                            <steps route='{{ route('tasks.steps.index',$task->id) }}'></steps>  
                        4.返回数据
                            //一般返回api数据格式
                                response()->json([
                                    'steps'=>$task->steps
                                    ...其他数据
                                ],200);    
                            
                            
                    */
                    this.steps = res.data.steps;
                }).catch((err)=>{
                    alert(`很抱歉发生错误 \n ${err.response.data.message} \n 错误码：${err.response.status}`)
                    
                })
            },
            //添加step
            addStep(){
                if(!this.newStep.length){//判断结果
                    return;
                }
                axios.post(this.route+ '/steps',{'name':this.newStep}).then((res)=>{
                    //问题1.获取可以直接通过this.fetchSteps 重新获取新的数据,但是这样需要多一次ajax 请求
                    
                    //问题2.新创建的数据没有completion属性，
                    //  a.原因是$step是返回模型层面在创建的数据，并没有在数据库层面的数据对象
                    //          $step->refresh() 刷新来重新获取数据库层面的数据   
                    //  b.setp模型不知道数据库还有completion默认值这一栏，所以可以告诉模型有数据库有默认值一栏
                    //          protected $attributes = ['completion' => false ]
                    // c.创建的时候在封装一个completion=>0 
                    //          $step = $task->steps()->create([
                    //                'name'=>$request->name,
                    //                'completion'=> false
                    //           ])
                    //
                    this.steps.push(res.data.step);
                    this.newStep=''; //消除绑定效果
                })   
            },
            //完成未完成切换
            toggle(step){
                axios.patch(this.route+'/steps/'+step.id,{'completion':!step.completion}).then((res)=>{
                     step.completion=!step.completion;
                })    
            },
            //删除step
            remove(step){
                console.log(this.route+'/steps/'+ step.id);
                axios.delete(this.route+'/steps/'+ step.id).then((res)=>{
                    let i = this.steps.indexOf(step);//这个step在原数组中的索引
                    this.steps.splice(i,1);
                    /*注意 此时不能使用v-for的index 因为这个index是指在inProcess数组中的索引和steps中的索引不对应*/
                })      
            },
            //双击name属性实现编辑step
            edit(step){
                //1.删除当前step
                // this.steps.splice(this.steps.indexOf(step),1);//元素组中删除
                this.remove(step);//调用删除方法
                //2.input框中显示默认值
                this.newStep = step.name;
                //3.focus当前的输入框
                this.$refs.newStep.focus();

                //4.processed 和 inProcess 没有step 时候隐藏
                //5.input 输入值的时候隐藏
            },
            //完成所有未完成的step
            completeAll(){
                //console.log(this.route+'/steps/complete');
                axios.post(this.route+'/steps/completedAll',{}).then(()=>{
                    this.inProcess.map((step)=>{
                        step.completion=true;
                    })
                })
            },
            //清除所有已完成的step
            clearcompletion(){
                this.processed=[];//注意 这里是计算属性，直接设置值，没有设置setter的情况下下会报错
                this.steps = this.inProcess;//清除所有已完成的等于保留所有未完成的
            }

        }   
    }
</script>
