<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Resources\MataPelajaranResource;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MataPelajaranController extends BaseController
{
    const VALIDATION_RULES = [
        'nama_mapel' => 'required|string|max:255',
        'deskripsi_mapel' => 'required|string|max:255',
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
            // $mapel = MataPelajaran::all();
            $subjects = DB::table('mata_pelajarans')
                ->join('dosens', 'mata_pelajarans.id_dosen', '=', 'dosens.id')
                ->select('mata_pelajarans.*', 'dosens.nama as teacher_name')
                ->get();
            return $this->sendResponse($subjects, "mapel retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error mapel retrieved successfully", $th->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSubjectLecturer()
    {
        try {
            $user = Auth::user();
            $dosen = Dosen::where('id_user', $user->id)->first();
            $subjects = DB::table('mata_pelajarans')->where("id_dosen", $dosen->id)
                ->join('kelas', 'mata_pelajarans.id_class', '=', 'kelas.id')
                ->select('mata_pelajarans.*', 'kelas.nama_kelas as class_name')
                ->get();
            return $this->sendResponse($subjects, "mapel retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error mapel retrieved successfully", $th->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSubjectStudent()
    {
        try {
            // $mapel = MataPelajaran::all();
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('id_user', $user->id)->first();
            $subjects = DB::table('mata_pelajarans')->where("id_class", $mahasiswa->id_class)
                ->join('dosens', 'mata_pelajarans.id_dosen', '=', 'dosens.id')
                ->select('mata_pelajarans.*', 'dosens.nama as teacher_name')
                ->get();
            return $this->sendResponse($subjects, "mapel retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error mapel retrieved successfully", $th->getMessage());
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
            $mapel = new MataPelajaran();
            $mapel->id_class = $request->id_class;
            $mapel->id_dosen = $request->id_dosen;
            $mapel->nama_mapel = $request->nama_mapel;
            $mapel->deskripsi_mapel = $request->deskripsi_mapel;
            $mapel->room = $request->room;
            $mapel->sks = $request->sks;
            $mapel->day = $request->day;
            $mapel->start_time = $request->start_time;
            $mapel->end_time = $request->end_time;

            $mapel->save();

            return $this->sendResponse($mapel, 'mapel created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating mapel', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(MataPelajaran $mataPelajaran, $id)
    {
        try {
            $mapel = MataPelajaran::findOrFail($id);
            return $this->sendResponse($mapel, "mapel retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving mapel", $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataPelajaran $mataPelajaran, $id)
    {
        try {
            $request->validate([
                'nama_mapel' => 'required|string|max:255',
            ]);
            $mapel = MataPelajaran::findOrFail($id);
            $mapel->id_class = $request->id_class;
            $mapel->id_dosen = $request->id_dosen;
            $mapel->nama_mapel = $request->nama_mapel;
            $mapel->deskripsi_mapel = $request->deskripsi_mapel;
            $mapel->room = $request->room;
            $mapel->sks = $request->sks;
            $mapel->day = $request->day;
            $mapel->start_time = $request->start_time;
            $mapel->end_time = $request->end_time;
            $mapel->save();
            return $this->sendResponse($mapel, 'mapel updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating mapel', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataPelajaran $mataPelajaran, $id)
    {
        try {
            $mapel = MataPelajaran::findOrFail($id);
            $mapel->delete();
            return $this->sendResponse($mapel, "mapel deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting mapel", $th->getMessage());
        }
    }
}
