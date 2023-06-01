<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\DosenResource;
use App\Http\Controllers\API\BaseController;

class DosenController extends BaseController
{
    const VALIDATION_RULES = [
        'nama' => 'required|string|max:255',
        'nidn' => 'required|string|max:255',
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
            $dosen = (DosenResource::collection(Dosen::all()));
            return $this->sendResponse($dosen, "guru retrieved successfully");
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
            $user = new User;
            $user->name = $request->nama;
            $user->role = "dosen";
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->save();
            
            $dosen = new Dosen;
            $dosen->id_user = $user->id;
            $dosen->nama = $request->nama;
            $dosen->nidn = $request->nidn;
            $dosen->email = $request->email;
            $dosen->password = bcrypt($request->password);
            $dosen->tempat = $request->tempat;
            $dosen->tgl_lahir = $request->tgl_lahir;
            $dosen->jns_kelamin = $request->jns_kelamin;
            $dosen->agama = $request->agama;
            $dosen->alamat = $request->alamat;
            $dosen->telepon = $request->telepon;
            $dosen->kd_pos = $request->kd_pos;
            $dosen->save();

            return $this->sendResponse(new DosenResource($dosen), 'dosen created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating lecturer', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $dosen = Dosen::findOrFail($id);
            return $this->sendResponse(new DosenResource($dosen), "guru retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving guru", $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nidn' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'tempat' => 'required|string|max:255',
                'tgl_lahir' => 'required|date',
                'jns_kelamin' => 'required|string|max:255',
                'agama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'telepon' => 'required|string|max:255',
                'kd_pos' => 'required|string|max:255',
            ]);
            $user = User::findOrFail($id);
            $user->name = $request->nama;
            $user->role = "dosen";
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->save();

            $dosen = Dosen::findOrFail($id);
            $dosen->nama = $request->nama;
            $dosen->nidn = $request->nidn;
            $dosen->email = $request->email;
            $dosen->tempat = $request->tempat;
            $dosen->tgl_lahir = $request->tgl_lahir;
            $dosen->jns_kelamin = $request->jns_kelamin;
            $dosen->agama = $request->agama;
            $dosen->alamat = $request->alamat;
            $dosen->telepon = $request->telepon;
            $dosen->kd_pos = $request->kd_pos;
            $dosen->save();
            return $this->sendResponse($dosen, 'guru updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating guru', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dosen = Dosen::findOrFail($id);
            $dosen->delete();
            return $this->sendResponse($dosen, "guru deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting guru", $th->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, self::VALIDATION_RULES);
            $dosen = new Dosen;
            $dosen->nama = $request->nama;
            $dosen->nidn = $request->nidn;
            $dosen->email = $request->email;
            $dosen->password = bcrypt($request->password);
            $dosen->tempat = $request->tempat;
            $dosen->tgl_lahir = $request->tgl_lahir;
            $dosen->jns_kelamin = $request->jns_kelamin;
            $dosen->agama = $request->agama;
            $dosen->alamat = $request->alamat;
            $dosen->telepon = $request->telepon;
            $dosen->kd_pos = $request->kd_pos;
            $dosen->save();
            return $this->sendResponse(new DosenResource($dosen), 'guru created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating guru', $th->getMessage());
        }
    }
}
