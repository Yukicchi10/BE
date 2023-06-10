<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\tugas;
use Illuminate\Http\Request;
use App\Http\Resources\TugasResource;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\Mahasiswa;
use App\Models\MataPelajaran;
use App\Models\TugasMurid;
use Illuminate\Support\Facades\Auth;

class TugasController extends BaseController
{
    const VALIDATION_RULES = [
        'id_mapel' => 'required',
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
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
            $user = Auth::user();
            $dosen = Dosen::where("id_user", $user->id)->first();
            $tugas = Tugas::where("id_dosen", $dosen->id)->get();
            return $this->sendResponse($tugas, "tugas retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error tugas retrieved successfully", $th->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTugas()
    {
        try {
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where("id_user", $user->id)->first();
            $tugas = Tugas::where("id_kelas", $mahasiswa->id_class)
                ->join('mata_pelajarans', 'tugas.id_mapel', '=', 'mata_pelajarans.id')
                ->select('tugas.*', 'mata_pelajarans.nama_mapel as nama_mapel')->get();
            return $this->sendResponse($tugas, "materi retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error materi retrieved successfully", $th->getMessage());
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
            $user = Auth::user();
            $dosen = Dosen::where("id_user", $user->id)->first();
            $mapel = MataPelajaran::findOrFail($request->id_mapel);
            $tugas = new Tugas();
            $tugas->id_kelas = $mapel->id_class;
            $tugas->id_mapel = $request->id_mapel;
            $tugas->id_dosen = $dosen->id;
            $tugas->title = $request->title;
            $tugas->description = $request->description;
            $tugas->save();

            return $this->sendResponse($tugas, 'tugas created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating tugas', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where("id_user", $user->id)->first();
            $tugas = Tugas::findOrFail($id);
            $tugasMurid = TugasMurid::where("id_tugas", $id)->where("id_mahasiswa", $mahasiswa->id)->get();
            $tugas->pengumpulan = $tugasMurid;
            return $this->sendResponse($tugas, "tugas retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving tugas", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function detailTugas($id)
    {
        try {
            $tugas = Tugas::findOrFail($id);
            $tugasMurid = TugasMurid::where("id_tugas", $id)
                ->join('mahasiswas', 'tugas_murids.id_mahasiswa', '=', 'mahasiswas.id')
                ->select('tugas_murids.*', 'mahasiswas.nama as nama_mahasiswa', 'mahasiswas.nim as nim')
                ->get();
            $tugas->pengumpulan = $tugasMurid;
            return $this->sendResponse($tugas, "tugas retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving tugas", $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugas $tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugas $tugas, $id)
    {
        try {
            $request->validate([
                'id_mapel' => 'required',
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
            $tugas = Tugas::findOrFail($id);
            $tugas->id_mapel = $request->id_mapel;
            $tugas->title = $request->title;
            $tugas->description = $request->description;
            $tugas->save();
            return $this->sendResponse($tugas, 'tugas updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating tugas', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tugas, $id)
    {
        try {
            $tugas = Tugas::findOrFail($id);
            $tugas->tugasMurid()->delete();
            $tugas->delete();
            return $this->sendResponse($tugas, "tugas deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting tugas", $th->getMessage());
        }
    }
}
