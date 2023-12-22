<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProfilePassportPath;

class ProfilePassport extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ====== this statemnt check if the user has uploaded profile picture already ======
        $isExist = ProfilePassportPath::where('user_id', $request->user_id)->exists();

        // if so it will update not insert the record
        if ($isExist) {
            $update = ProfilePassportPath::where('user_id', $request->user_id)->update([
                'profile_url' => $request->profile_url
            ]);

            if ($update) {
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => 'Successfully updated profile picture'
                ]);
            }else {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Failed to upload profile picture please try again later'
                ]);
            }
        }
        // ====== else it will insert the record ======
        else {
            $create = ProfilePassportPath::create([
                'user_id' => $request->user_id,
                'profile_url' => $request->profile_url
            ]);

            if ($create) {
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => 'Successfully upload profile picture'
                ]);
            }else {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Failed to upload profile picture please try again later'
                ]);
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
