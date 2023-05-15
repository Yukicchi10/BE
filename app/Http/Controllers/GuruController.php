<?php

namespace App\Http\Controllers;

use App\Models\guru;
use Illuminate\Http\Request;
use App\Http\Resources\GuruResource;
use App\Http\Controllers\API\BaseController;

class GuruController extends BaseController
{
    const VALIDATION_RULES = [
        'nama' => 'required|string|max:255',
        'nip' => 'required|string|max:255',
        'email' => 'required|string|max:255',
        'password' => 'required|string|max:255',
        'tempat' => 'required|string|max:255',
        'tgl_lahir' => 'required|date',
        'jns_kelamin' => 'required|string|max:255',
        'agama' => 'required|string|max:255',
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
            $guru = (GuruResource::collection(Guru::all()));
            return $this->sendResponse($guru, "guru retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error guru retrieved successfully", $th->getMessage());
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
            $guru = new guru;
            $guru->nama = $request->nama;
            $guru->nip = $request->nip;
            $guru->email = $request->email;
            $guru->password = bcrypt($request->password);
            $guru->tempat = $request->tempat;
            $guru->tgl_lahir = $request->tgl_lahir;
            $guru->jns_kelamin = $request->jns_kelamin;
            $guru->agama = $request->agama;
            $guru->alamat = $request->alamat;
            $guru->telepon = $request->telepon;
            $guru->kd_pos = $request->kd_pos;
            $guru->save();

            return $this->sendResponse(new GuruResource($guru), 'guru created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating guru', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            return $this->sendResponse(new GuruResource($guru), "guru retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving guru", $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nip' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'tempat' => 'required|string|max:255',
                'tgl_lahir' => 'required|date',
                'jns_kelamin' => 'required|string|max:255',
                'agama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'telepon' => 'required|string|max:255',
                'kd_pos' => 'required|string|max:255',
            ]);
            $guru = Guru::findOrFail($id);
            $guru->nama = $request->nama;
            $guru->nip = $request->nip;
            $guru->email = $request->email;
            $guru->tempat = $request->tempat;
            $guru->tgl_lahir = $request->tgl_lahir;
            $guru->jns_kelamin = $request->jns_kelamin;
            $guru->agama = $request->agama;
            $guru->alamat = $request->alamat;
            $guru->telepon = $request->telepon;
            $guru->kd_pos = $request->kd_pos;
            $guru->save();
            return $this->sendResponse($guru, 'guru updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating guru', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $guru = Guru::findOrFail($id);
            $guru->delete();
            return $this->sendResponse($guru, "guru deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting guru", $th->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, self::VALIDATION_RULES);
            $guru = new Guru;
            $guru->nama = $request->nama;
            $guru->nip = $request->nip;
            $guru->email = $request->email;
            $guru->password = bcrypt($request->password);
            $guru->tempat = $request->tempat;
            $guru->tgl_lahir = $request->tgl_lahir;
            $guru->jns_kelamin = $request->jns_kelamin;
            $guru->agama = $request->agama;
            $guru->alamat = $request->alamat;
            $guru->telepon = $request->telepon;
            $guru->kd_pos = $request->kd_pos;
            $guru->save();
            return $this->sendResponse(new GuruResource($guru), 'guru created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating guru', $th->getMessage());
        }
    }
}
