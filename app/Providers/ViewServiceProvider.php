<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
          
        /*
            {{-- foreign 外部  references 引用  cascade 联动  badge 徽章 pill 丸/球  provider 服务供应商 --}}
            

           1.生成一个服务提供者
                php artisan make:provider ViewServiceProvider  
           2.laravel启动后调用这个服务,在 config.app 中注册服务 
                'providers' => [
                    App\Providers\ViewServiceProvider::class,
                ]  
            3.在实际生产环境中，可能向公共模板传递的数据较多，一不把业务逻辑编码到这里
            4.数据业务分离到类中
                view()->composer('layouts.app','App\Http\ViewComposer\TaskCountComposer@compose');

            5.默认调用的就是compose方法，所以compose方法名可以省略 ，
                view()->composer('layouts.app','App\Http\ViewComposer\TaskCountComposer);
            */
            
        view()->composer('layouts.app','App\Http\ViewComposer\TaskCountComposer'); 

        // view()->composer(['layouts.app'],function($view){  //laravle 启动后 传递数据到公共模板    
        //     $view->with([
        //         'doneCount'=>10,
        //         'undoneCount'=>20,
        //         'AllCount'=>30
        //     ]);
        // });    
    }
}
