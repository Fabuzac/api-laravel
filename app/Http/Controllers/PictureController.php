<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PictureRequest;
use Illuminate\Support\Facades\Validator;

class PictureController extends Controller
{

    public function index()
    {
        $pictures = Picture::all();

        return response()->json($pictures);
    }

    public function show($id)
    {
        $picture = Picture::find($id);

        if(!$picture) {
            return response()->json(['message' => 'Ressource not found'], 403);
        }

        return response()->json($picture);
    }

    public function store(Request $request, PictureRequest $validation)
    {
        // CHECK INPUT AND FILE PICTURE
        $validator = Validator::make(
            $request->all(), 
            $validation->rules(), 
            $validation->messages()
        );

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        // CATCH DATA REQUEST
        $fullFileName = $request->file('image')->getClientOriginalName();
        $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $file = $fileName . '_' . time() . '.' . $extension;

        $request->file('image')->storeAs('public/pictures', $file);

        // SAVE IN DB
        $picture = Picture::create([
            'image' => $file,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => 1,
        ]);

        return response()->json($picture);
    }
}
