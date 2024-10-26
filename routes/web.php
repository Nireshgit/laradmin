<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\ChatController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check/{id}', [CheckController::class, 'getUserName']);

Route::get('/dashboard', function () {
    return view('dashboard', [
        'users' => User::where('id', '!=', Auth::id())->get()
      ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/chat/messages/{user}', function (User $user){
    return view('chat', [
        'user' => $user
    ]);
})->middleware(['auth', 'verified'])->name('chat');

Route::resource(
    'messages/{user}', 
    ChatController::class, ['only' => ['index', 'store']]
)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
