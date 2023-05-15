<?php

namespace App\Http\Controllers;

use App\Models\TugasMurid;
use Illuminate\Http\Request;
use App\Http\Resources\TugasMuridResource;

class TugasMuridController extends Controller
{
    const VALIDATION_RULES = [
        'idTugas' => 'required',
        'idSiswa' => 'required',
        'file' => 'required|string|max:255',
        'nilai' => 'required|string|max:255',
        'status' => 'required|max:255',
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
            $tugasMurid = new TugasMurid();
            $tugasMurid->idTugas = $request->idTugas;
            $tugasMurid->idMurid = $request->idMurid;
            $tugasMurid->file = $request->file;
            $tugasMurid->nilai = $request->nilai;
            $tugasMurid->status = $request->status;
            $tugasMurid->save();

            return $this->sendResponse(new TugasMuridResource($tugasMurid), 'tugasMurid created successfully');
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
            $request->validate([
                'idTugas' => 'required',
                'idSiswa' => 'required',
                'file' => 'required|string|max:255',
                'nilai' => 'required|string|max:255',
                'status' => 'required|max:255',
            ]);
            $tugasMurid = TugasMurid::findOrFail($id);
            $tugasMurid->idTugas = $request->idTugas;
            $tugasMurid->idMurid = $request->idMurid;
            $tugasMurid->file = $request->file;
            $tugasMurid->nilai = $request->nilai;
            $tugasMurid->status = $request->status;
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
