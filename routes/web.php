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

