<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TanggapanController;

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

Auth::routes([
    'register' => false,
]);

Route::get('/home', function(){
    if (Auth::user()->role == 'siswa') {
        return redirect()->route('siswa.dashboard');
    } else if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } else if (Auth::user()->role == 'kepsek') {
        return redirect()->route('kepsek.dashboard');
    } else if (Auth::user()->role == 'parent') {
        return redirect()->route('parent.dashboard');
    }
})->middleware('auth');

Auth::routes();

$roles = ['admin','siswa','parent','kepsek'];
foreach ($roles as $role) {
    Route::prefix($role)->middleware(['auth', "role:$role"])->group(function () use ($role) {
        Route::get('dashboard', function() use ($role){
            $controller = app(HomeController::class);
            $method = $role;
            return $controller->$method();
        })->name("$role.dashboard");
        Route::get('/profile',[ProfileController::class,'index'])->name("profile.$role");
        Route::post('/profile/update',[ProfileController::class,'update'])->name("update.$role");
    });
}

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function(){
    // Export data pengaduan
    Route::get('/exports',[PengaduanController::class,'export'])->name('admin.export');
    // Data Siswa
    Route::prefix('siswa')->group(function(){
        Route::get('/',[SiswaController::class,'index'])->name('user.siswa.index');
        Route::post('/store',[SiswaController::class,'store'])->name('user.siswa.store');
        Route::delete('/delete/{id}',[SiswaController::class,'delete'])->name('user.siswa.delete');
    });

    // Data Orang Tua
    Route::prefix('wali')->group(function(){
        Route::get('/',[ParentController::class,'index'])->name('user.parent.index');
        Route::post('/store',[ParentController::class,'store'])->name('user.parent.store');
        Route::prefix('{id}')->group(function(){
            Route::get('/detail',[ParentController::class,'detail'])->name('user.parent.detail');
            Route::post('/add',[ParentController::class,'addStudent'])->name('parent.add.student');
            Route::post('/remove',[ParentController::class,'removeStudent'])->name('parent.remove.student');
        });
        Route::delete('/delete/{id}',[ParentController::class,'delete'])->name('user.parent.delete');
        // Untuk Tambah dan Hapus Siswa on Parent
    });

    // Memproses Pengaduan
    Route::get('/pengaduan/detail/{id}',[PengaduanController::class,'detail'])->name('admin.tanggapan');
    Route::post('/proses/{id}',[TanggapanController::class,'proses'])->name('admin.proses');
    Route::post('/selesai/{id}',[TanggapanController::class,'selesai'])->name('admin.selesai');
    Route::post('/pengaduan/{id}/store',[TanggapanController::class,'store'])->name('admin.tanggapan.store');
    Route::get('/pengaduan/cetak/{id}',[PengaduanController::class,'print'])->name('admin.pengaduan.cetak');
});
// Role Siswa dan Buat Pengaduan
Route::prefix('siswa')->middleware(['auth','role:siswa'])->group(function(){
    Route::prefix('pengaduan')->group(function(){
        Route::get('/create',[PengaduanController::class,'create'])->name('siswa.pengaduan.create');
        Route::post('/store',[PengaduanController::class,'store'])->name('siswa.pengaduan.store');
        Route::get('/edit/{id}',[PengaduanController::class,'edit'])->name('siswa.pengaduan.edit');
        Route::post('/update/{id}',[PengaduanController::class,'update'])->name('siswa.pengaduan.update');
        Route::get('/detail/{id}',[PengaduanController::class,'detail'])->name('siswa.pengaduan.detail');
        Route::delete('/delete/{id}',[PengaduanController::class,'delete'])->name('siswa.pengaduan.delete');
    });
});

// Role orang tua
Route::prefix('parent')->middleware(['auth','role:parent'])->group(function(){
    Route::get('/detailsiswa/{nisn}',[ParentController::class,'detailSiswa'])->name('parent.detail.siswa');
    Route::get('/pengaduan/{pengaduan}',[PengaduanController::class,'detail'])->name('parent.detail.pengaduan');
});

Route::prefix('kepsek')->middleware(['auth','role:kepsek'])->group(function(){
    Route::get('/pengaduan/detail/{id}',[PengaduanController::class,'detail'])->name('kepsek.pengaduan.detail');
});

