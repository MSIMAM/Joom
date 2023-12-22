<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Http\Requests\FollwersStoreRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $follower = Follower::with("artist")
                            ->with("user")
                            ->get()
                            ->transform(fn($data) => [
                                'id' => Crypt::encrypt($data->id) ?? null,
                                'artist_id' => $data->artist_id ?? null,
                                'artist_name' => $data->artist->user->username ?? null,
                                'user_id' => $data->user_id ?? null,
                                'username' => $data->artist->user->username ?? null,
                            ]);

        if($follower->isNotEmpty()){
            return response()->json([
                'status'    => Response::HTTP_OK,
                'followers'   => $follower
            ]);
        }
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
    public function store(FollwersStoreRequest $request)
    {
        //
        $wallet = Follower::create($request->all());
        return $request;
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
    public function destroy(Follower $follower)
    {
        //
        $followers = $follower->delete();

        if($followers){
            return response()->json([
                'status'    => Response::HTTP_OK,
                'message'   => "Unfollow artist successfully"
            ]);
        }
        return response()->json([
            'status'    => Response::HTTP_NOT_FOUND,
            'message'   => "Somthing went wrong"
        ]);
    }
}
