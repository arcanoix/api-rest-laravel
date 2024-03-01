<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
            public function index()
            {
                $users = User::get();

                return response()->json($users, 200);
            }

            public function store(Request $request)
            {
                $user = User::create($request->all());

                return response()->json($user, 201);
            }

            public function show(User $user)
            {
                return response()->json($user);
            }

            public function update(Request $request, User $user)
            {
                $user->update($request->all());

                return response()->json($user);
            }

            public function destroy(User $user)
            {
                $user->delete();

                return response()->json(null, 204);
            }
}
