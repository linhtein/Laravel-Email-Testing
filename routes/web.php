<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

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
    $title = 'New Mail Testing----'.rand(1,1000);
    $descrption = 'In order to use the database queue driver, you will need a database table to hold the jobs. To generate a migration that creates this table'.rand(1,1000);

    $mails = [
        'yoteshin5599@gmail.com',
        'yoteshin5599@gmail.com',
        'yoteshin5599@gmail.com',
        'yoteshin5599@gmail.com',
        'yoteshin5599@gmail.com',
    ];
    foreach($mails as $mail){
        Mail::to($mail)->later(now()->addMinute(1),new TestMail($title,$descrption));
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
