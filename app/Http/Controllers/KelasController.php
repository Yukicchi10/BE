<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\Mahasiswa;
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
            $kelas->mahasiswa = $mahasiswa;
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
            $kelas->delete();
            return $this->sendResponse($kelas, "kelas deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting kelas", $th->getMessage());
        }
    }
}
