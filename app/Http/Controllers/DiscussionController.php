<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Dosen;
use App\Models\Likes;
use App\Models\Mahasiswa;
use App\Models\Replies;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends BaseController
{
    public function index($id)
    {
        try {
            $threads = Thread::where("id_mapel", $id)
                ->join('users', 'threads.id_user', '=', 'users.id')
                ->select('threads.*', 'users.role as role')
                ->orderBy('threads.created_at', 'desc')
                ->get();

            foreach ($threads as $key => $value) {
                if ($value->role == 'mahasiswa') {
                    $mahasiswa = Mahasiswa::where("id_user", $value->id_user)->first();
                    $value->name = $mahasiswa->nama;
                } else {
                    $dosen = Dosen::where("id_user", $value->id_user)->first();
                    $value->name = $dosen->nama;
                }
                $user = Auth::user();

                $likes = Likes::where("id_thread", $value->id)->count();
                $isLike = Likes::where("id_thread", $value->id)->where("id_user", $user->id)->count();
                if ($isLike == 0) {
                    $value->isLike = false;
                } else {
                    $value->isLike = true;
                }
                if ($user->id == $value->id_user) {
                    $value->isMe = true;
                } else {
                    $value->isMe = false;
                }
                $replies = Replies::where("id_thread", $value->id)->count();
                $value->likes = $likes;
                $value->replies = $replies;
            }



            return $this->sendResponse($threads, "threads retrieved successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error retrieving thread", $th->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $user = Auth::user();
            $thread = new Thread();
            $thread->id_mapel = $request->id_mapel;
            $thread->id_user = $user->id;
            $thread->content = $request->content;
            $thread->save();

            return $this->sendResponse($thread, 'thread created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating thread', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $thread = Thread::findOrFail($id);
            $thread->likes()->delete();
            $thread->replies()->delete();
            $thread->delete();
            return $this->sendResponse($thread, "thread deleted successfully");
        } catch (\Throwable $th) {
            return $this->sendError("error deleting thread", $th->getMessage());
        }
    }


    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $isLike = Likes::where("id_thread", $request->id_thread)->where("id_user", $user->id)->count();
            if ($isLike == 0) {
                $likes = new Likes();
                $likes->id_thread = $request->id_thread;
                $likes->id_user = $user->id;
                $likes->save();
            } else {
                $likes = Likes::where("id_thread", $request->id_thread)->where("id_user", $user->id)->delete();
            }


            return $this->sendResponse($likes, 'thread created successfully');
        } catch (\Throwable $th) {
            return $this->sendError('error creating thread', $th->getMessage());
        }
    }
}
