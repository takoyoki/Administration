<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkerController;
use App\Http\Middleware\RedirectBasedOnRole;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\CalendarController;


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
    Route::get('/admin/approved', [AdminController::class, 'approved'])->name('admin.approved');
    Route::put('/admin/approve/{user}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::delete('/admin/reject/{user}', [AdminController::class, 'reject'])->name('admin.reject');
    Route::get('/admin/create-srevice-order', [AdminController::class,'create'])->name('admin.create-service-order');
    Route::post('/admin/store-srevice-order', [AdminController::class,'store'])->name('admin.store-service-order');
    Route::delete('/service_orders/destroy/{id}', [AdminController::class, 'destroy'])->name('service_orders.destroy');
    Route::get('/admin/user', [AdminController::class,'list'])->name('admin.user');
    Route::get('/users/edit/{id}', [AdminController::class, 'edit'])->name('users.edit');
    Route::delete('/users/{id}', [AdminController::class, 'remove'])->name('users.destroy');
    Route::put('/users/{id}', [AdminController::class, 'editUser'])->name('users.editUser');
    
    Route::get('/worker/dashboard', [WorkerController::class, 'index'])->name('worker.dashboard');
    Route::get('/service_orders/{status}', [WorkerController::class, 'showByStatus'])->name('service_orders.status');
    Route::get('/worker/result/{id}', [WorkerController::class, 'resultShow'])->name('worker_result_show');
    Route::post('/worker/update/{id}', [WorkerController::class, 'update'])->name('worker.update');
    Route::get('/worker/{id}/edit', [WorkerController::class, 'edit'])->name('worker.edit');
    Route::put('/worker/editUser/{id}', [WorkerController::class, 'editUser'])->name('worker.editUser');
    
    Route::post('generate-pdf/{result}', [PdfController::class, 'generatePdf'])->name('generatePdf');
    Route::get('calendar/service_orders', [CalendarController::class, 'index'])->name('calendar.service_orders');
    
    
    Route::get('/result/{id}', [ResultController::class, 'show'])->name('result.show');

});

    Route::middleware(['auth', 'role.redirect'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
   
});


require __DIR__.'/auth.php';


