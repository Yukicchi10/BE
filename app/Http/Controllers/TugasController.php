<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\tugas;
use Illuminate\Http\Request;
use App\Http\Resources\TugasResource;
use App\Models\Dosen;
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
            $tugas = (TugasResource::collection(Tugas::all()));
            return $this->sendResponse($tugas, "tugas retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error tugas retrieved successfully", $th->getMessage());
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
            $tugas = new Tugas();
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

            $tugas = Tugas::where("id_mapel", $id)->get();
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
            $tugas->delete();
            return $this->sendResponse($tugas, "tugas deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting tugas", $th->getMessage());
        }
    }
}
