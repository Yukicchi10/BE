<?php

use App\Http\Controllers\API\AuthenticatedController;
use App\Http\Controllers\API\AuthenticatedControllerDosen;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\TugasMuridController;
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
    Route::get('/admin/dashboard', [KelasController::class, "dashboard"])->middleware('userAkses:admin');

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
    Route::get('/admin/mapel/{id}', [MataPelajaranController::class, "show"])->middleware('userAkses:admin');
    Route::post('/admin/mapel', [MataPelajaranController::class, "store"])->middleware('userAkses:admin');
    Route::put('/admin/mapel/{id}', [MataPelajaranController::class, "update"])->middleware('userAkses:admin');
    Route::delete('/admin/mapel/{id}', [MataPelajaranController::class, "destroy"])->middleware('userAkses:admin');

    Route::get('/admin/calendar', [CalendarController::class, "index"])->middleware('userAkses:admin');
    Route::post('/admin/calendar', [CalendarController::class, "store"])->middleware('userAkses:admin');
    Route::delete('/admin/calendar/{id}', [CalendarController::class, "destroy"])->middleware('userAkses:admin');

    //lecturer role
    Route::get('/auth/lecturer/me', [AuthenticatedControllerDosen::class, 'me'])->middleware('userAkses:dosen');
    Route::get('/dosen/mapel', [MataPelajaranController::class, "listSubjectLecturer"])->middleware('userAkses:dosen');
    Route::get('/dosen/mapel/{id}', [MataPelajaranController::class, "show"])->middleware('userAkses:dosen');

    Route::get('/dosen/materi', [MateriController::class, "index"])->middleware('userAkses:dosen');
    Route::post('/dosen/materi/upload', [MateriController::class, "store"])->middleware('userAkses:dosen');
    Route::put('/dosen/materi/{id}', [MateriController::class, "update"])->middleware('userAkses:dosen');
    Route::delete('/dosen/materi/{id}', [MateriController::class, "destroy"])->middleware('userAkses:dosen');

    Route::get('/dosen/tugas', [TugasController::class, "index"])->middleware('userAkses:dosen');
    Route::get('/dosen/tugas/{id}', [TugasController::class, "detailTugas"])->middleware('userAkses:dosen');
    Route::post('/dosen/tugas', [TugasController::class, "store"])->middleware('userAkses:dosen');
    Route::put('/dosen/tugas/{id}', [TugasController::class, "update"])->middleware('userAkses:dosen');
    Route::delete('/dosen/tugas/{id}', [TugasController::class, "destroy"])->middleware('userAkses:dosen');
    Route::put('/dosen/tugas/penilaian/{id}', [TugasMuridController::class, "update"])->middleware('userAkses:dosen');

    Route::post('/dosen/pertemuan', [StudentAttendanceController::class, "add"])->middleware('userAkses:dosen');
    Route::get('/dosen/mapel/absen/{id}', [StudentAttendanceController::class, "show"])->middleware('userAkses:dosen');
    Route::post('/dosen/absen/siswa', [StudentAttendanceController::class, "store"])->middleware('userAkses:dosen');
    Route::get('/dosen/calendar', [CalendarController::class, "index"])->middleware('userAkses:dosen');

    // Ruang diskusi
    Route::get('/dosen/mapel/{id}/thread', [DiscussionController::class, "index"])->middleware('userAkses:dosen');
    Route::post('/dosen/thread', [DiscussionController::class, "create"])->middleware('userAkses:dosen');
    Route::delete('/dosen/thread/{id}', [DiscussionController::class, "destroy"])->middleware('userAkses:dosen');
    Route::post('/dosen/thread/likes', [DiscussionController::class, "store"])->middleware('userAkses:dosen');
    Route::get('/dosen/thread/{id}', [DiscussionController::class, "show"])->middleware('userAkses:dosen');
    Route::post('/dosen/thread/replies', [DiscussionController::class, "createReply"])->middleware('userAkses:dosen');
    Route::delete('/dosen/replies/{id}', [DiscussionController::class, "destroyReplies"])->middleware('userAkses:dosen');

    //student role
    Route::get('/auth/me', [AuthenticatedController::class, 'me'])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/mapel', [MataPelajaranController::class, "listSubjectStudent"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/mapel/{id}', [MataPelajaranController::class, "show"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/materi', [MateriController::class, "listMateri"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/tugas', [TugasController::class, "listTugas"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/tugas/{id}', [TugasController::class, "show"])->middleware('userAkses:mahasiswa');
    Route::post('/mahasiswa/tugas/upload', [TugasMuridController::class, "store"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/calendar', [CalendarController::class, "index"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/mapel/absen/{id}', [StudentAttendanceController::class, "show"])->middleware('userAkses:mahasiswa');

    // Ruang diskusi
    Route::get('/mahasiswa/mapel/{id}/thread', [DiscussionController::class, "index"])->middleware('userAkses:mahasiswa');
    Route::post('/mahasiswa/thread', [DiscussionController::class, "create"])->middleware('userAkses:mahasiswa');
    Route::delete('/mahasiswa/thread/{id}', [DiscussionController::class, "destroy"])->middleware('userAkses:mahasiswa');
    Route::post('/mahasiswa/thread/likes', [DiscussionController::class, "store"])->middleware('userAkses:mahasiswa');
    Route::get('/mahasiswa/thread/{id}', [DiscussionController::class, "show"])->middleware('userAkses:mahasiswa');
    Route::post('/mahasiswa/thread/replies', [DiscussionController::class, "createReply"])->middleware('userAkses:mahasiswa');
    Route::delete('/mahasiswa/replies/{id}', [DiscussionController::class, "destroyReplies"])->middleware('userAkses:mahasiswa');
});
