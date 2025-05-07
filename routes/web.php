    <?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[FormController::class,'home'])->name('home');
Route::get('/', [FormController::class,'index'] );
Route::post('/create', [FormController::class, 'storeOrUpdate'])->name('create');
Route::delete('/delete/{id}',[FormController::class,'destory'])->name('delete');
Route::get('/edit/{id}',[FormController::class,'edit'])->name('edit');
Route::get('/showtable',[FormController::class,'showtable'])->name('showtable');
Route::get('/showform',[FormController::class,'showform'])->name('showform');
Route::get('/countries',[FormController::class,'countryList'])->name('countriesList');

Route::post('api/fetch-states',[FormController::class,'fetchState']);
Route::post('api/fetch-cities',[FormController::class,'fetchCity']);