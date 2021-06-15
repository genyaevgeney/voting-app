<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

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

Route::get('/', [IdeaController::class, 'index'])->name('idea.index');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('idea.show');

Route::get('/test', function () {
    $test = "public/5i2VOcIpPN46BfuhJJOqL48cRkr0le7Mv5CmyNjn.jpg";
    // $data = url(Storage::url('5i2VOcIpPN46BfuhJJOqL48cRkr0le7Mv5CmyNjn.jpg'));
    $data = str_replace("public/", "", "public/5i2VOcIpPN46BfuhJJOqL48cRkr0le7Mv5CmyNjn.jpg");

    dd($data);
});

require __DIR__.'/auth.php';