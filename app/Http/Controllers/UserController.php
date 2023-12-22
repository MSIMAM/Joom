<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')
                      ->with('role')
                      ->get()
                      ->transform(function($user){
                        return [
                            'id'       => Crypt::encrypt($user->id) ?? null,
                            'username' => $user->username ?? null,
                            'email'    => $user->email ?? null,
                            'role'     => $user->role->name ?? null
                        ];
                      });
        if ($users->isNotEmpty()) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'users' => $users
            ]);
        }else {
            return response()->json([
                'status' => Response::HTTP_NO_CONTENT,
                'message' => 'No record found'
            ]);
        }
    }
}
