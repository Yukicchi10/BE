<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends BaseController
{
    public function index()
    {
        try {
            $calendar = (Calendar::all());
            return $this->sendResponse($calendar, "guru retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error guru retrieved successfully", $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $calendar = new Calendar();
            $calendar->title = $request->title;
            $calendar->start = $request->start;
            $calendar->end = $request->end;
            $calendar->save();

            return $this->sendResponse($calendar, 'kelas created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating kelas', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $calendar = Calendar::findOrFail($id);
            $calendar->delete();
            return $this->sendResponse($calendar, "guru deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting guru", $th->getMessage());
        }
    }
}
