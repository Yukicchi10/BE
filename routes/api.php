<?php

use App\Http\Controllers\API\AuthenticatedController;
use App\Http\Controllers\API\AuthenticatedControllerDosen;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\MateriController;
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

// all user
Route::post('/auth/login', [AuthenticatedController::class, 'login']);
Route::post('/auth/logout', [AuthenticatedController::class, 'logout']);
Route::post('/auth/refresh', [AuthenticatedController::class, 'refresh']);

Route::middleware(['auth'])->group(function () {
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
    Route::get('/admin/class/{id}', [KelasController::class, "show"])->middleware('userAkses:admin');
    Route::post('/admin/class', [KelasController::class, "store"])->middleware('userAkses:admin');
    Route::put('/admin/class/{id}', [KelasController::class, "update"])->middleware('userAkses:admin');
    Route::delete('/admin/class/{id}', [KelasController::class, "destroy"])->middleware('userAkses:admin');

    // Admin role, to manage Mapel
    // Route::get('/admin/mapel', [MataPelajaranController::class, "index"])->middleware('UserAkses:admin');
    Route::get('/admin/mapel/{id}', [MataPelajaranController::class, "show"])->middleware('userAkses:admin');
    Route::post('/admin/mapel', [MataPelajaranController::class, "store"])->middleware('userAkses:admin');
    Route::put('/admin/mapel/{id}', [MataPelajaranController::class, "update"])->middleware('userAkses:admin');
    Route::delete('/admin/mapel/{id}', [MataPelajaranController::class, "destroy"])->middleware('userAkses:admin');

    //lecturer role
    Route::get('/dosen/mapel', [MataPelajaranController::class, "listSubjectLecturer"])->middleware('userAkses:dosen');
    Route::get('/dosen/mapel/{id}', [MataPelajaranController::class, "show"])->middleware('userAkses:dosen');

    Route::get('/dosen/materi', [MateriController::class, "index"])->middleware('userAkses:dosen');
    Route::post('/dosen/materi/upload', [MateriController::class, "store"])->middleware('userAkses:dosen');
    Route::put('/dosen/materi/{id}', [MateriController::class, "update"])->middleware('userAkses:dosen');
    Route::delete('/dosen/materi/{id}', [MateriController::class, "destroy"])->middleware('userAkses:dosen');

    Route::post('/dosen/mapel/tugas', [TugasController::class, "store"])->middleware('userAkses:dosen');
    Route::get('/dosen/mapel/{id}/tugas', [TugasController::class, "show"])->middleware('userAkses:dosen');
    Route::put('/dosen/tugas/{id}', [TugasController::class, "update"])->middleware('userAkses:dosen');
    Route::delete('/dosen/tugas/{id}', [TugasController::class, "destroy"])->middleware('userAkses:dosen');

    
    //student role
    Route::get('/mahasiswa/mapel', [MataPelajaranController::class, "listSubjectStudent"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/mapel/{id}', [MataPelajaranController::class, "show"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/materi', [MateriController::class, "listMateri"])->middleware('userAkses:mahasiswa');

});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('siswa', SiswaController::class);
});

// user information
Route::get('/auth/me', [AuthenticatedController::class, 'me']); //student
Route::get('/auth/lecturer/me', [AuthenticatedControllerDosen::class, 'me']); //lecturer

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('dosen', DosenController::class);
});
// Dosen

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('mata_pelajaran', MataPelajaran::class);
});

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
