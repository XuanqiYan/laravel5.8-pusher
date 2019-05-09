<?php
use App\Events\OrderUpdated;
use Pusher\Pusher;
use App\Message;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//测试pusher
Route::get('/pusher/test', function () {  
    $pusher = app()->make('pusher');
    /** 
     * channel:  频道 类似于电视台有同的频道
     * evnet  :  事件 类似于在一个频道有不同的节目名称
     * data   :  数据 类似于节目的内容
     * trigger() 相当于电视台有一个节目要播放了，那么下一步要收看电视节目，就需要每个人都有一个电视机去监听频道中的事件
    */
    $pusher->trigger('cctv-1','三国演绎',['data'=>'第一章：桃源三结义']);
    return view('pusher.test');
});










//登录用户点击和谁通话后 
Route::post('/notification/auth','ChatController@notificationAuth');
Route::post('/pusher/auth','ChatController@auth');
Route::post('/chat/create','ChatController@create')->name('chat.create');
Route::get('/chat/{chat}','ChatController@show')->name('chat.show');
Route::get('/chat/{chat}/messages','ChatController@messages');
Route::post('/chat/{chat}/store','ChatController@store');

Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ProjectsController@index')->name('projects.index');


// Route::get('/orders',function(){
//     OrderUpdated::dispatch();
//     // event( new OrderUpdated());
// });
// // Route::post('/project/store', 'ProjectsController@store')->name('projects.store');
// // Route::delete('/project/{projectId}', 'ProjectsController@destroy')->name('projects.destroy');
// // Route::patch('/project/{projectId}', 'ProjectsController@update')->name('projects.update');
// // Route::get('/project/{projectId}', 'ProjectsController@show')->name('projects.show');

Route::get('tasks/{task}/check', "TasksController@check")->name('tasks.check');
Route::post('tasks/{task}/steps/complete','StepController@completedAll');
Route::resource('projects', 'ProjectsController');
Route::resource('tasks', 'TasksController');
Route::resource('tasks.steps', 'StepController');

Route::get('/company/search','CompanySearchController@index');
Route::post('/company/search','CompanySearchController@search');








// Route::post('/project/store',[
//     'uses'=>'ProjectsController@store',
//     'as'=>'project.store'
// ]);

