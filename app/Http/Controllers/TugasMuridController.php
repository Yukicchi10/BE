<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\TugasMurid;
use Illuminate\Http\Request;
use App\Http\Resources\TugasMuridResource;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class TugasMuridController extends BaseController
{
    const VALIDATION_RULES = [
        'id_tugas' => 'required',
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
            $tugasMurid = (TugasMuridResource::collection(TugasMurid::all()));
            return $this->sendResponse($tugasMurid, "tugasMurid retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error tugasMurid retrieved successfully", $th->getMessage());
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
            $mahasiswa = Mahasiswa::where("id_user", $user->id)->first();

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            $file->move(public_path('materi'), $originalName);
            $path = asset('materi/' . $originalName);

            $tugasMurid = new TugasMurid();
            $tugasMurid->id_tugas = $request->id_tugas;
            $tugasMurid->id_mahasiswa = $mahasiswa->id;
            $tugasMurid->file = $path;
            $tugasMurid->nilai = 0;
            $tugasMurid->save();

            return $this->sendResponse($tugasMurid, 'tugasMurid created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating tugasMurid', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TugasMurid  $tugasMurid
     * @return \Illuminate\Http\Response
     */
    public function show(TugasMurid $tugasMurid, $id)
    {
        try {
            $tugasMurid = TugasMurid::findOrFail($id);
            return $this->sendResponse(new TugasMuridResource($tugasMurid), "tugasMurid retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving tugasMurid", $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TugasMurid  $tugasMurid
     * @return \Illuminate\Http\Response
     */
    public function edit(TugasMurid $tugasMurid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TugasMurid  $tugasMurid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TugasMurid $tugasMurid, $id)
    {
        try {
            $tugasMurid = TugasMurid::findOrFail($id);
            $tugasMurid->nilai = $request->nilai;
            $tugasMurid->save();
            return $this->sendResponse($tugasMurid, 'tugasMurid updated successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error updating tugasMurid', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TugasMurid  $tugasMurid
     * @return \Illuminate\Http\Response
     */
    public function destroy(TugasMurid $tugasMurid, $id)
    {
        try {
            $tugasMurid = TugasMurid::findOrFail($id);
            $tugasMurid->delete();
            return $this->sendResponse($tugasMurid, "tugasMurid deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting tugasMurid", $th->getMessage());
        }
    }
}
