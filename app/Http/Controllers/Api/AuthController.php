<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Mobile API login.
     */
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Find User
        |--------------------------------------------------------------------------
        */

        $user = User::where(
            'email',
            $validated['email']
        )->first();


        /*
        |--------------------------------------------------------------------------
        | Validate Credentials
        |--------------------------------------------------------------------------
        */

        if (
            !$user ||
            !Hash::check(
                $validated['password'],
                $user->password
            )
        ) {

            return response()->json([
                'success' => false,
                'message' => 'The email or password is incorrect.',
            ], 401);

        }


        /*
        |--------------------------------------------------------------------------
        | Validate Account
        |--------------------------------------------------------------------------
        */

        if ($user->status !== 'active') {

            return response()->json([
                'success' => false,
                'message' => 'Your account is currently inactive.',
            ], 403);

        }


        /*
        |--------------------------------------------------------------------------
        | Load Voter
        |--------------------------------------------------------------------------
        */

        $voter = $user->voter;


        /*
        |--------------------------------------------------------------------------
        | Create Mobile Token
        |--------------------------------------------------------------------------
        */

        $token = $user->createToken(
            'electo-mobile'
        )->plainTextToken;


        /*
        |--------------------------------------------------------------------------
        | User Response
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => true,

            'message' => 'Login successful.',

            'token' => $token,

            'user' => [

                'id' =>
                    $user->id,

                'name' =>
                    $user->name,

                'email' =>
                    $user->email,

                'phone' =>
                    $user->phone,

                'avatar' =>
                    $user->avatar,

                /*
                |--------------------------------------------------------------------------
                | Legacy Role
                |--------------------------------------------------------------------------
                */

                'role' =>
                    $user->role,

                /*
                |--------------------------------------------------------------------------
                | Spatie Roles
                |--------------------------------------------------------------------------
                */

                'roles' =>
                    $user->getRoleNames()->values()->toArray(),

            ],

            'voter' => $voter
                ? [

                    'id' =>
                        $voter->id,

                    'name' =>
                        $voter->name,

                    'voter_id' =>
                        $voter->voter_id,

                    'email' =>
                        $voter->email,

                    'phone' =>
                        $voter->phone,

                    'photo' =>
                        $voter->photo,

                    'status' =>
                        $voter->status,

                ]
                : null,

        ]);

    }


    /**
     * Return authenticated mobile user.
     */
    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->load('voter');

        return response()->json([

            'success' => true,

            'user' => [

                'id' =>
                    $user->id,

                'name' =>
                    $user->name,

                'email' =>
                    $user->email,

                'phone' =>
                    $user->phone,

                'avatar' =>
                    $user->avatar,

                /*
                |--------------------------------------------------------------------------
                | Legacy Role
                |--------------------------------------------------------------------------
                */

                'role' =>
                    $user->role,

                /*
                |--------------------------------------------------------------------------
                | Spatie Roles
                |--------------------------------------------------------------------------
                */

                'roles' =>
                    $user->getRoleNames()->values()->toArray(),

            ],

            'voter' => $user->voter
                ? [

                    'id' =>
                        $user->voter->id,

                    'name' =>
                        $user->voter->name,

                    'voter_id' =>
                        $user->voter->voter_id,

                    'email' =>
                        $user->voter->email,

                    'phone' =>
                        $user->voter->phone,

                    'photo' =>
                        $user->voter->photo,

                    'status' =>
                        $user->voter->status,

                ]
                : null,

        ]);

    }


    /**
     * Logout mobile device.
     */
    public function logout(Request $request): JsonResponse
    {
        $request
            ->user()
            ->currentAccessToken()
            ?->delete();


        return response()->json([

            'success' => true,

            'message' =>
                'Logged out successfully.',

        ]);

    }
}