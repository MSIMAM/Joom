<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::orderBy('id', 'DESC')
                            ->with('user')
                            ->with('city')
                            ->get()
                            ->transform(fn($artist) => [
                                'id'   => Crypt::encrypt($artist->id) ?? null,
                                'username' => $artist->user->username ?? null,
                                'email' => $artist->user->email ?? null,
                                'biograpy' => $artist->biography ?? null,
                                'city_name' => $artist->city->state_name ?? null,
                            ]);
        if ($artists) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'artists' => $artists
            ]);
        }else {
            return response()->json([
                'status' => Response::HTTP_NO_CONTENT,
                'message' => 'No record found'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Auth/SignUp', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $create = Artist::create([
            'user_id' => $request->user_id,
            'biography' => $request->biography,
            'city_id'   => $request->city_id
        ]);
        if ($create) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Profile successfully updated'
            ]);
        }else {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Fail to update profile please try again'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        $artists = [
            'biography' => $artist->biography ?? null,
            'city'      => $artist->city->state_name ?? null
        ];

        if ($artists) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'artists' => $artists
            ]);
        }
        return response()->json([
            'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'No record found'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $update = $artist->update([
            'biography' => $request->biography,
            'city_id'   => $request->city_id
        ]);
        if ($update) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'message' => 'Profile updated successfully'
            ]);
        }else {
            return response()->json([
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Fail to update profile please try again'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {

    }
}
