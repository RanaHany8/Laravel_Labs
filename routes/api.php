<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});



Route::middleware('auth:sanctum')->group(function () {
    
  
    Route::get('/posts', [PostController::class, 'index']);      
    Route::post('/posts', [PostController::class, 'store']);     
    Route::get('/posts/{id}', [PostController::class, 'show']); 
    Route::put('/posts/{id}', [PostController::class, 'update']); 
    Route::delete('/posts/{id}', [PostController::class, 'destroy']);

  
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});



Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);