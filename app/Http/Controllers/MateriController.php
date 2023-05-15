<?php

namespace App\Http\Controllers;

use App\Models\materi;
use Illuminate\Http\Request;
use App\Http\Resources\MateriResource;

class MateriController extends Controller
{
    const VALIDATION_RULES = [
        'idMapel' => 'required',
        'idKelas' => 'required',
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
            $materi = (MateriResource::collection(Materi::all()));
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
            $this->validate($request, self::VALIDATION_RULES);
            $materi = new Materi();
            $materi->idMapel = $request->idMapel;
            $materi->idKelas = $request->idKelas;
            $materi->judul = $request->nama_materi;
            $materi->deskripsi = $request->deskripsi;
            $materi->file = $request->file;
            $materi->save();

            return $this->sendResponse(new MateriResource($materi), 'materi created successfully');
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
            $request->validate([
                'idMapel' => 'required',
                'idKelas' => 'required',
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
                'file' => 'nullable|string|max:255',
            ]);
            $materi = Materi::findOrFail($id);
            $materi->idMapel = $request->idMapel;
            $materi->idKelas = $request->idKelas;
            $materi->judul = $request->judul;
            $materi->deskripsi = $request->deskripsi;
            $materi->file = $request->file;
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
}
