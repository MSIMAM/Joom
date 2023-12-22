<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Requests\GenreUpdateRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::orderBy('id', 'DESC')
                        ->get()
                        ->transform(fn($genre) => [
                            'id'     => Crypt::encrypt($genre->id) ?? null,
                            'name'   => $genre->genre_name ?? null
                        ]);

        if ($genres->isNotEmpty()) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'genres' => $genres
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

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreStoreRequest $request)
    {
            $create = Genre::create([
                'genre_name' => $request->genre_name
            ]);

            if ($create) {
                return response()->json([
                    'status' => Response::HTTP_OK,
                    'message' => 'Successfully saved genre'
                ]);
            }else {
                return response()->json([
                    'status' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message' => 'Fail to save please try again'
                ]);
            }

    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        $genre = [
            'id'  => Crypt::encrypt($genre->id) ?? null,
            'genre_name' => $genre->genre_name ?? null
        ];

        if ($genre) {
            return response()->json([
                'success' => Response::HTTP_OK,
                'genre' => $genre
            ]);
        }else {
            return response()->json([
                'success' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'The Requested record not found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GenreUpdateRequest $request, Genre $genre)
    {
        $update = $genre->update([
            'genre_name' => $request->genre_name
        ]);
        if ($update) {
            return response()->json([
                'success' => Response::HTTP_OK,
                'message' => 'Genre name updated successfully'
            ]);
        }else {
            return response()->json([
                'success' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Fail to update genre please try again'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $delete = $genre->delete();
        if ($delete) {
            return response()->json([
                'success' => Response::HTTP_OK,
                'message' => 'Genre deleted successfully'
            ]);
        }else {
            return response()->json([
                'success' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Fail to delete genre please try again'
            ]);
        }
    }
}
