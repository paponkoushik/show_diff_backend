<?php

    use App\Models\Document;
    use App\Models\DocumentVersion;
    use App\Models\User;
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

Route::get('/', function () {
    $user = User::query()->where('id', 1)->with('documents')->get();
    dd($user);
});
