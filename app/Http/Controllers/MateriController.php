<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\materi;
use Illuminate\Http\Request;
use App\Http\Resources\MateriResource;
use App\Models\Dosen;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Storage;

class MateriController extends BaseController
{
    const VALIDATION_RULES = [
        'id_kelas' => 'required',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string|max:255',
        'file' => 'nullable|string|max:255',
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
            $materi = Materi::where("createdBy", $dosen->id)
                ->join('mata_pelajarans', 'materis.id_mapel', '=', 'mata_pelajarans.id')
                ->select('materis.*', 'mata_pelajarans.nama_mapel as nama_mapel')->get();
            return $this->sendResponse($materi, "materi retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error materi retrieved successfully", $th->getMessage());
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listMateri()
    {
        try {
            $user = Auth::user();
            $dosen = Mahasiswa::where("id_user", $user->id)->first();
            $materi = Materi::where("id_kelas", $dosen->id_class)
                ->join('mata_pelajarans', 'materis.id_mapel', '=', 'mata_pelajarans.id')
                ->select('materis.*', 'mata_pelajarans.nama_mapel as nama_mapel')->get();
            return $this->sendResponse($materi, "materi retrieved successfully");
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
            // $this->validate($request, self::VALIDATION_RULES);
            $mapel = MataPelajaran::findOrFail($request->id_mapel);
            $user = Auth::user();
            $dosen = Dosen::where("id_user", $user->id)->first();
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            // Generate a unique filename
            $fileName = $this->generateUniqueFileName($originalName);

            $file->move(public_path('materi'), $originalName);

            $path = asset('materi/' . $originalName);
            $materi = new Materi();
            $materi->createdBy = $dosen->id;
            $materi->id_mapel = $request->id_mapel;
            $materi->id_kelas = $mapel->id_class;
            $materi->judul = $request->judul;
            $materi->deskripsi = $request->deskripsi;
            $materi->file = $path;
            $materi->save();
            return $this->sendResponse($materi, 'materi created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating materi', $th->getMessage());
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Materi  $Materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $Materi, $id)
    {
        try {
            $materi = Materi::findOrFail($id);
            return $this->sendResponse(new MateriResource($materi), "materi retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving materi", $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materi  $Materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $Materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materi  $Materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $Materi, $id)
    {
        try {
            $mapel = MataPelajaran::findOrFail($request->id_mapel);
            $user = Auth::user();
            $dosen = Dosen::where("id_user", $user->id)->first();

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            // Generate a unique filename
            $fileName = $this->generateUniqueFileName($originalName);

            $file->move(public_path('materi'), $fileName);
            $path = asset('materi/' . $fileName);

            $materi = new Materi();
            $materi->createdBy = $dosen->id;
            $materi->id_mapel = $request->id_mapel;
            $materi->id_kelas = $mapel->id_class;
            $materi->judul = $request->judul;
            $materi->deskripsi = $request->deskripsi;
            $materi->file = $path;
            $materi->save();
            return $this->sendResponse($materi, 'materi updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating materi', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materi  $Materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $Materi, $id)
    {
        try {
            $materi = Materi::findOrFail($id);
            $materi->delete();
            return $this->sendResponse($materi, "materi deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting materi", $th->getMessage());
        }
    }

    private function generateUniqueFileName($originalName)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $filename = pathinfo($originalName, PATHINFO_FILENAME);

        $uniqueName = Str::slug($filename) . '-' . Str::random(8) . '.' . $extension;

        // Check if the generated filename already exists
        if (file_exists(public_path('uploads/' . $uniqueName))) {
            // Generate a new unique filename recursively
            return $this->generateUniqueFileName($originalName);
        }

        return $uniqueName;
    }
}
