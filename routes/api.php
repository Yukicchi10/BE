<?php

use App\Http\Controllers\API\AuthenticatedController;
use App\Http\Controllers\API\AuthenticatedControllerDosen;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TugasController;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Siswa
Route::get('/auth/siswas', [SiswaController::class, 'index']);
Route::get('/auth/edit-siswa/{id}', [SiswaController::class, 'show']);
Route::put('/auth/update-siswa/{id}', [SiswaController::class, 'update']);
Route::delete('/auth/hapus-siswa/{id}', [SiswaController::class, 'destroy']);
Route::post('/auth/register', [SiswaController::class, 'register']);

Route::post('/auth/me', [AuthenticatedController::class, 'me']);
Route::post('/auth/login', [AuthenticatedController::class, 'login']);
Route::post('/auth/logout', [AuthenticatedController::class, 'logout']);
Route::post('/auth/refresh', [AuthenticatedController::class, 'refresh']);
//Route::post('/auth/logout', [AuthenticatedController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/abc', [SiswaController::class, 'show']);

Route::get('/hello', function () {
    return 'Hello, world!';
});

Route::middleware(['auth'])->group(function(){
    Route::get('/student/{id}', [MahasiswaController::class, "show"])->middleware('userAkses:mahasiswa');
   
    // Admin role, to manage lecturer
    Route::get('/lecturer', [DosenController::class, "index"])->middleware('userAkses:admin');
    Route::get('/lecturer/{id}', [DosenController::class, "show"])->middleware('userAkses:admin');
    Route::post('/lecturer', [DosenController::class, "store"])->middleware('userAkses:admin');
    Route::put('/lecturer/{id}', [DosenController::class, "update"])->middleware('userAkses:admin');
    Route::delete('/lecturer/{id}', [DosenController::class, "destroy"])->middleware('userAkses:admin');

    // Admin role, to manage Students
    Route::get('/students', [MahasiswaController::class, "index"])->middleware('userAkses:admin');
    Route::get('/students/{id}', [MahasiswaController::class, "show"])->middleware('userAkses:admin');
    Route::post('/students', [MahasiswaController::class, "store"])->middleware('userAkses:admin');
    Route::put('/students/{id}', [MahasiswaController::class, "update"])->middleware('userAkses:admin');
    Route::delete('/students/{id}', [MahasiswaController::class, "destroy"])->middleware('userAkses:admin');

    // Admin role, to manage Class
    Route::get('/admin/class', [KelasController::class, "index"])->middleware('userAkses:admin');
    Route::post('/admin/class', [KelasController::class, "store"])->middleware('userAkses:admin');
    Route::put('/admin/class/{id}', [KelasController::class, "update"])->middleware('userAkses:admin');
    Route::delete('/admin/class/{id}', [KelasController::class, "destroy"])->middleware('userAkses:admin');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('siswa', SiswaController::class);
});
// Mahasiswa

// Dosen
Route::get('/auth/dosen', [DosenController::class, 'index']);
Route::get('/auth/edit-dosen/{id}', [DosenController::class, 'show']);
Route::put('/auth/update-dosen/{id}', [DosenController::class, 'update']);
Route::delete('/auth/hapus-dosen/{id}', [DosenController::class, 'destroy']);
Route::post('/auth/register-dosen', [DosenController::class, 'register']);

Route::post('/auth/dosenme', [AuthenticatedControllerDosen::class, 'me']);
Route::post('/auth/dosen-login', [AuthenticatedControllerDosen::class, 'login']);
Route::post('/auth/dosen-logout', [AuthenticatedControllerDosen::class, 'logout']);
Route::post('/auth/dosen-refresh', [AuthenticatedControllerDosen::class, 'refresh']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('dosen', DosenController::class);
});
// Dosen

// Mata Pelajaran
Route::get('/mapel', [MataPelajaranController::class, 'index']);
Route::get('/mapel/show/{id}', [MataPelajaranController::class, 'show']);
Route::put('/mapel/update/{id}', [MataPelajaranController::class, 'update']);
Route::delete('/mapel/delete/{id}', [MataPelajaranController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('mata_pelajaran', MataPelajaran::class);
});
// Mata Pelajaran

// Materi
Route::get('/materi', [MateriController::class, 'index']);
Route::get('/materi/show/{id}', [MateriController::class, 'show']);
Route::put('/materi/update/{id}', [MateriController::class, 'update']);
Route::delete('/materi/delete/{id}', [MateriController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('materi', MateriController::class);
});
// Materi

// Tugas
Route::get('/tugas', [TugasController::class, 'index']);
Route::get('/tugas/show/{id}', [TugasController::class, 'show']);
Route::put('/tugas/update/{id}', [TugasController::class, 'update']);
Route::delete('/tugas/delete/{id}', [TugasController::class, 'destroy']);



Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('tugas', TugasController::class);
});
// Tugas

// TugasMurid
Route::get('/tugasMurid', [TugasMuridController::class, 'index']);
Route::get('/tugasMurid/show/{id}', [TugasMuridController::class, 'show']);
Route::put('/tugasMurid/update/{id}', [TugasMuridController::class, 'update']);
Route::delete('/tugasMurid/delete/{id}', [TugasMuridController::class, 'destroy']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('tugasMurid', TugasMuridController::class);
});
// TugasMurid

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('tugas', TugasController::class);
});
// Tugas

Route::resource('fileupload', 'FileuploadController');
Route::post('upload', [ImageGallary::class, 'saveImage']);
Route::get('list', [ImageGallary::class, 'dataList']);
Route::get('delete/{id}', [ImageGallary::class, 'deleteImg']);

// Route::post('/auth/register', function ()
// {
//     dd("hallo");
// });
// Route::post('/logout', [AuthenticatedController::class, 'destroy'])->middleware('auth:sanctum');
