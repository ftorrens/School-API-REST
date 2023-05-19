<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //TODO: Make the login validation Request

    /**
     * Login.
     *
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Authentication"},
     *     operationId="login",
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     @OA\RequestBody(
     *         description="Login",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 required={
     *                  "email",
     *                  "password"
     *                  },
     *                 @OA\Property(
     *                     property="email",
     *                     description="Insert the email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Insert the password",
     *                     type="password",
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        try {

            $user = User::where("email", "=", $request->input("email"))->firstOrFail();

            if(Hash::check($request->input("password"), $user->password)){

                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json([
                    "status" => "Success",
                    "data" => $user,
                    "token" => $token,
                    "mensaje" => "Success operation"
                ], 200);
            }

            return response()->json([
                "status" => "error",
                "message" => "Something went wrong in login method"
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Something went wrong in login method"
            ]);
        }
    }

    /**
     * Logout.
     *
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     operationId="logout",
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     @OA\RequestBody(
     *         description="Input data format",
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 type="object",
     *                 required={
     *                  "user_id",
     *                  },
     *                 @OA\Property(
     *                     property="user_id",
     *                     description="User id",
     *                     type="integer",
     *                 )
     *             )
     *         )
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function logout(Request $request)
    {
        try {

            $user = User::findOrFail($request->input("user_id"));

            $user->tokens()->delete();

            return response()->json([
                "status" => "Success",
                "data" => null,
                "mensaje" => "User Logged out"
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Something went wrong in logout method"
            ]);
        }
    }

}
