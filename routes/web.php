<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/items', [ApiController::class, 'index']);
Route::get('/items/{id}', [ApiController::class, 'getObject']);
Route::post('/items', [ApiController::class, 'postObject']);
Route::put('/items/{id}', [ApiController::class, 'putObject']);
Route::patch('/items/{id}', [ApiController::class, 'patchObject']);
Route::delete('/items/{id}', [ApiController::class, 'deleteObject']);
Route::get('/table', [ApiController::class, 'showAllItems']);

Route::get('/create', [ApiController::class, 'create'])->name('create');

Route::post('/store', [ApiController::class, 'store'])->name('store');

Route::get('/objects/{id}', [ApiController::class, 'getObject']);

Route::get('/search', [ApiController::class, 'searchItem'])->name('search');
Route::delete('/search/{id}', [ApiController::class, 'deleteItem'])->name('delete');



