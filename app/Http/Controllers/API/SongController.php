<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SongController extends Controller
{



    public function add_song(Request $request)
    {
        $data = $request->all();
        $v = Validator::make($data, [
            'judul' => 'required|string',
            'cover' => 'required|string',
            'lagu' => 'required|mimes:mpga,wav,mp3',
            'tanggal_rilis' => 'required|date',
            'status' => 'in:pending,published,rejected|default:pending',
            'id_user' => 'required|integer',
            'id_label' => 'required|integer',
        ]);

        if ($v->fails()) {
            return response()->json([
                'message' => 'Invalid data',
                'statusCode' => 400,
            ], 400);
        }

        $user = User::find($data['id_user']);
        if (!$artist) {
            return response()->json([
                'message' => 'user not found',
                'statusCode' => 404,
            ], 404);
        }

        $label = $data['id_label'] ? Label::find($data['id_label']) : null;
        if (isset($data['id_label']) && !$label) {
            return response()->json([
                'message' => 'LAbel not found',
                'statusCode' => 404,
            ], 404);
        }

      
        $lagu = $request->file('lagu');

        $lagu = time() . '_' . $lagu->getClientOriginalName();

        $lagu->move(public_path('lagu'), $lagu);

        try {
            $data = $v->validated();

            $song = Song::create([
                'judul' => $data['judul'],
                'lagu' => $lagu,
                'tanggal_rilis' => $data['tanggal_rilis'],
                'status' => $data['status'] ?? 'pending',
                'id_user' => $data['artist_id'],
                'id_label' => $data['album_id'] ?? null,
            ]);

            $song['audio'] ? $song['audio'] = url('audio/' . $song['audio']) : null;

            return response()->json([
                'message' => 'Create song successful',
                'statusCode' => 200,
                'data' => $song,
            ], 200);
        } catch (Exception $e) {
            // if (file_exists(public_path('images/song/' . $image_name))) unlink(public_path('images/song/' . $image_name));
            if (file_exists(public_path('audio/' . $audio_name))) unlink(public_path('audio/' . $audio_name));

            return response()->json([
                'message' => 'Create song failed',
                'statusCode' => 500,
            ], 500);
        }
    }

}
