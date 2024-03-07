<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkerController;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\PdfController;


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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
   

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/orders/{status}', [AdminController::class, 'showOrdersByStatus'])->name('admin.orders');
    Route::get('/admin/search', [AdminController::class, 'search'])->name('admin.search');
    Route::get('/dashboard/show-worker-tickets', [AdminController::class, 'showWorkerTickets'])->name('show_worker_tickets');
    Route::post('/admin/assign/{id}', [AdminController::class, 'assignToWorker'])->name('admin.assign');
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    
    
    Route::get('/worker/dashboard', [WorkerController::class, 'index'])->name('worker.dashboard');
    Route::get('/service_orders/{status}', [WorkerController::class, 'showByStatus'])->name('service_orders.status');
    Route::get('/worker/result/{id}', [WorkerController::class, 'resultShow'])->name('worker_result_show');
    Route::post('/worker/update/{id}', [WorkerController::class, 'update'])->name('worker.update');
    Route::post('generate-pdf/{result}', [WorkerController::class, 'generatePdf'])->name('generatePdf');
    
    
    Route::get('/result/{id}', [ResultController::class, 'show'])->name('result.show');

});

    Route::middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
   
});


require __DIR__.'/auth.php';


