<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Attendance;
use App\Models\Dosen;
use App\Models\Likes;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\Replies;
use App\Models\StudentAttendance;
use App\Models\Thread;
use App\Models\tugas;
use App\Models\TugasMurid;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KelasController extends BaseController
{
    const VALIDATION_RULES = [
        'nama_kelas' => 'required|string|max:255',
        'angkatan' => 'required|string|max:255',
    ];
    const NumPaginate = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $kelas = (KelasResource::collection(Kelas::all()));
            $kelas = DB::table('kelas')->get();
            return $this->sendResponse($kelas, "kelas retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error kelas retrieved successfully", $th->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        try {
            $kelas = Kelas::count();
            $dosen = Dosen::count();
            $mahasiswa = Mahasiswa::count();
            $res  = [
                'kelas' => $kelas,
                'dosen' => $dosen,
                'mahasiswa' => $mahasiswa
            ];
            return $this->sendResponse($res, "dashboard retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error kelas retrieved successfully", $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, self::VALIDATION_RULES);
            $kelas = new Kelas();
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->angkatan = $request->angkatan;
            $kelas->save();

            return $this->sendResponse($kelas, 'kelas created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating kelas', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        try {
            $kelas = Kelas::findOrFail($id);
            $mahasiswa = Mahasiswa::where('id_class', $id)->get();
            $subjects = DB::table('mata_pelajarans')->where('id_class', $id)
                ->join('dosens', 'mata_pelajarans.id_dosen', '=', 'dosens.id')
                ->select('mata_pelajarans.*', 'dosens.nama as teacher_name')
                ->get();
            $kelas->mahasiswa = $mahasiswa;
            $kelas->mapel = $subjects;
            return $this->sendResponse($kelas, "kelas retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving kelas", $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas, $id)
    {
        try {
            $request->validate([
                'nama_kelas' => 'required|string|max:255',
            ]);
            $kelas = kelas::findOrFail($id);
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->angkatan = $request->angkatan;
            $kelas->save();
            return $this->sendResponse($kelas, 'kelas updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating kelas', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas, $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            $mhs = Mahasiswa::where("id_class", $kelas->id)->get();
            foreach ($mhs as $key => $value) {
                $mahasiswa = Mahasiswa::findOrFail($value->id);
                $mahasiswa->studentAttendance()->delete();
                $mahasiswa->tugasMurid()->delete();
                $mahasiswa->delete();
                $user = User::findOrFail($mahasiswa->id_user);
                $thread = Thread::where("id_user", $user->id)->get();
                foreach ($thread as $key => $value) {
                    Likes::where("id_thread", $value->id)->delete();
                    Replies::where("id_thread", $value->id)->delete();
                }
                $user->thread()->delete();
                $user->delete();
            }

            $mataPelajaran = MataPelajaran::where("id_class", $kelas->id)->get();
            foreach ($mataPelajaran as $key => $value) {
                $mapel = MataPelajaran::findOrFail($value->id);
                $mapel->materi()->delete();

                $tugas = tugas::where("id_mapel", $mapel->id)->get();
                foreach ($tugas as $key => $value) {
                    TugasMurid::where("id_tugas", $value->id)->delete();
                }
                $mapel->tugas()->delete();

                $attendance = Attendance::where("id_mapel", $mapel->id)->get();
                foreach ($attendance as $key => $value) {
                    StudentAttendance::where("id_pertemuan", $value->id)->delete();
                }
                $mapel->attendance()->delete();

                $thread = Thread::where("id_mapel", $mapel->id)->get();
                foreach ($thread as $key => $value) {
                    Likes::where("id_thread", $value->id)->delete();
                    Replies::where("id_thread", $value->id)->delete();
                }
                $mapel->thread()->delete();

                $mapel->delete();
            }


            $kelas->delete();
            return $this->sendResponse($kelas, "kelas deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting kelas", $th->getMessage());
        }
    }
}
