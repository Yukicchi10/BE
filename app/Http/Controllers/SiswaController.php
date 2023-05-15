<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\SiswaResource;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends BaseController
{
    const VALIDATION_RULES = [
        'nama' => 'required|string|max:255',
        'nisn' => 'required|string|max:255',
        'idKelas' => 'nullable',
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'tempat' => 'required|string|max:255',
        'tgl_lahir' => 'required|date',
        'jns_kelamin' => 'required|string|max:255',
        'agama' => 'required|string|max:255',
        'nama_ayah' => 'required|string|max:255',
        'nama_ibu' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:255',
        'kd_pos' => 'required|string|max:255',
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
            $siswa = (SiswaResource::collection(Siswa::all()));
            return $this->sendResponse($siswa, "siswa retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error siswa retrieved successfully", $th->getMessage());
        }
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
            $siswa = new Siswa;
            $siswa->nama = $request->nama;
            $siswa->nisn = $request->nisn;
            $siswa->idKelas = $request->idKelas;
            $siswa->email = $request->email;
            $siswa->password = bcrypt($request->password);
            $siswa->tempat = $request->tempat;
            $siswa->tgl_lahir = $request->tgl_lahir;
            $siswa->jns_kelamin = $request->jns_kelamin;
            $siswa->agama = $request->agama;
            $siswa->nama_ayah = $request->nama_ayah;
            $siswa->nama_ibu = $request->nama_ibu;
            $siswa->alamat = $request->alamat;
            $siswa->telepon = $request->telepon;
            $siswa->kd_pos = $request->kd_pos;
            $siswa->save();

            return $this->sendResponse(new SiswaResource($siswa), 'siswa created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating siswa', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            return $this->sendResponse(new SiswaResource($siswa), "siswa retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving siswa", $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nisn' => 'required|string|max:255',
                'idKelas' => 'nullable',
                'email' => 'required|string|max:255',
                'tempat' => 'required|string|max:255',
                'tgl_lahir' => 'required|date',
                'jns_kelamin' => 'required|string|max:255',
                'agama' => 'required|string|max:255',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'telepon' => 'required|string|max:255',
                'kd_pos' => 'required|string|max:255',
            ]);
            $siswa = Siswa::findOrFail($id);
            $siswa->nama = $request->nama;
            $siswa->nisn = $request->nisn;
            $siswa->idKelas = $request->idKelas;
            $siswa->email = $request->email;
            $siswa->tempat = $request->tempat;
            $siswa->tgl_lahir = $request->tgl_lahir;
            $siswa->jns_kelamin = $request->jns_kelamin;
            $siswa->agama = $request->agama;
            $siswa->nama_ayah = $request->nama_ayah;
            $siswa->nama_ibu = $request->nama_ibu;
            $siswa->alamat = $request->alamat;
            $siswa->telepon = $request->telepon;
            $siswa->kd_pos = $request->kd_pos;
            $siswa->save();
            return $this->sendResponse($siswa, 'siswa updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating siswa', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();
            return $this->sendResponse($siswa, "siswa deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting siswa", $th->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, self::VALIDATION_RULES);
            $siswa = new Siswa;
            $siswa->nama = $request->nama;
            $siswa->nisn = $request->nisn;
            $siswa->idKelas = $request->idKelas;
            $siswa->email = $request->email;
            $siswa->password = bcrypt($request->password);
            $siswa->tempat = $request->tempat;
            $siswa->tgl_lahir = $request->tgl_lahir;
            $siswa->jns_kelamin = $request->jns_kelamin;
            $siswa->agama = $request->agama;
            $siswa->nama_ayah = $request->nama_ayah;
            $siswa->nama_ibu = $request->nama_ibu;
            $siswa->alamat = $request->alamat;
            $siswa->telepon = $request->telepon;
            $siswa->kd_pos = $request->kd_pos;
            $siswa->save();
            return $this->sendResponse(new SiswaResource($siswa), 'siswa created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating siswa', $th->getMessage());
        }
    }
}
