<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends BaseController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $count = StudentAttendance::where("id_pertemuan", $request->id_pertemuan)->where("id_mahasiswa", $request->id_mahasiswa)->count();
            $search = StudentAttendance::where("id_pertemuan", $request->id_pertemuan)->where("id_mahasiswa", $request->id_mahasiswa)->first();
            if ($count == 0) {
                $absen = new StudentAttendance();
                $absen->id_pertemuan = $request->id_pertemuan;
                $absen->id_mahasiswa = $request->id_mahasiswa;
                $absen->status = $request->status;
                $absen->keterangan = $request->keterangan;
                $absen->save();
            } else { 
                $absen = StudentAttendance::findOrFail($search->id);
                $absen->id_pertemuan = $request->id_pertemuan;
                $absen->id_mahasiswa = $request->id_mahasiswa;
                $absen->status = $request->status;
                $absen->keterangan = $request->keterangan;
                $absen->save();
            }


            return $this->sendResponse($absen, 'tugas created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating tugas', $th->getMessage());
        }
    }
}
