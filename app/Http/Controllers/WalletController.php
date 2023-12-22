<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Requests\WalletStoreRequest;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;
use function response;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $wallets = Wallet::with("artist")
                    ->get()
                    ->transform(fn($data) => [
                        'id' => Crypt::encrypt($data->id) ?? null,
                        'username' => $data->artist->user->username ?? null,
                        'artise_name' => $data->artist->biography ?? null,
                        'balance'     => $data->balance ?? null,
                    ]);

        return response()->json([
            'status'    => Response::HTTP_OK,
            'wallets'   => $wallets
        ]);
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
    public function store(WalletStoreRequest $request)
    {
        //
        $wallet = Wallet::create($request->all());
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
    public function destroy(string $id)
    {
        //
    }
}
