<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\FriendshipRequestController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;


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


Broadcast::routes(['middleware' => ['auth:api']]);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/main', function () {
    return Inertia\Inertia::render('Main');
})->name('main');

Route::resource('profiles',ProfileController::class);
Route::resource('posts',PostController::class);
Route::resource('notifications',NotificationController::class);
Route::resource('conversations',ConversationController::class);
Route::resource('likes',LikeController::class);
Route::resource('comments',CommentController::class);
Route::resource('messenger',MessengerController::class);
Route::resource('messages',MessageController::class);
Route::resource('friendshipRequests',FriendshipRequestController::class);






// conversations/user/

Route::get('conversations/user/{id}',[ConversationController::class,'friendConversation']);



Route::get('profiles/{id}/posts',[UserController::class,'posts']);

Route::post('changePicture',[ProfileController::class,'changePicture']);

// friendship status



Route::get('readed',[NotificationController::class,'read']);


Route::middleware(['auth:sanctum', 'verified'])
    ->get('messenger/c/{id}',[MessengerController::class,'conversation']);


// All routes for friendship requests
Route::post('/friendshipStatus',[FriendshipController::class,'friendshipStatus']);
Route::post('profiles/{id}/status',[FriendshipRequestController::class,'find']);
Route::post('profiles/{id}/confirm',[FriendshipRequestController::class,'confirm']);
Route::post('profiles/{id}/unfriend',[FriendshipController::class,'unfriend']);



//messenger
Route::get('friends',[FriendshipController::class,'friends']);
// create new conversation
Route::get('messenger/{id}/new',[ConversationController::class,'new']);

