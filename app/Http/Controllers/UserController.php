<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get all users",
     *     operationId="getUsers",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value"
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function getUsers()
    {
        return User::all();
    }

    /**
     * Register a user.
     *
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Users"},
     *     operationId="register",
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
     *                  "first_name",
     *                  "last_name",
     *                  "email",
     *                  "password"
     *                  },
     *                 @OA\Property(
     *                     property="first_name",
     *                     description="Insert the username",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     description="Insert the last name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="Insert the email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Insert the password",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function register(UserRequest $request)
    {
        try{

            $user = User::create([
                "first_name" => $request->input("first_name"),
                "last_name" => $request->input("last_name"),
                "email" => $request->input("email"),
                "password" => Hash::make(trim($request->input("password")))
            ]);

            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                "status" => "Success",
                "data" => $user,
                "token" => $token,
                "mensaje" => "Success operation"
            ], 200);

        }catch(\Exception $e){
            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Something went wrong in register method"
            ]);
        }

    }

    /**
     * Get an existing user.
     *
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     operationId="getUserById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
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
     *     security={{"bearerToken":{}}}
     * )
     */
    public function getUserById(string $id)
    {
        $data = User::find($id);

        if (isset($data)) {
            return response()->json([
                "data" => $data,
                "status" => "Success",
                "mensaje" => "Success operation"
            ]);
        } else {
            return response()->json([
                "data" => null,
                "status" => "error",
                "mensaje" => "The element no exist"
            ]);
        }
    }

    /**
     * Update an existing user.
     *
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     operationId="updateUser",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
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
     *                  "first_name",
     *                  "last_name",
     *                  "email",
     *                  "password"
     *                  },
     *                 @OA\Property(
     *                     property="first_name",
     *                     description="Updated user's name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     description="Updated user's last name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="Updated user's email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Updated user's password",
     *                     type="string",
     *                     format="password"
     *                 )
     *             )
     *         )
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function updateUser(Request $request, string $id)
    {
        $data = User::find($id);

        if (isset($data)) {
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->password = Hash::make(trim($request->password));

            if ($data->save()) {
                return response()->json([
                    "data" => $data,
                    "status" => "Success",
                    "mensaje" => "Success operation"
                ]);
            } else {
                return response()->json([
                    "data" => null,
                    "status" => "error",
                    "mensaje" => "Something went wrong in update method"
                ]);
            }
        } else {
            return response()->json([
                "data" => null,
                "status" => "error",
                "mensaje" => "The element no exist"
            ]);
        }
    }

    /**
     * Delete an existing user.
     *
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"Users"},
     *     operationId="deleteUser",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the user that needs to be delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
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
     *     security={{"bearerToken":{}}}
     * )
     */
    public function deleteUser(string $id)
    {
        $data = User::find($id);

        if (isset($data)) {
            if (User::destroy($id)) {
                return response()->json([
                    "data" => $data,
                    "status" => "Success",
                    "mensaje" => "Success operation"
                ]);
            } else {
                return response()->json([
                    "data" => null,
                    "status" => "error",
                    "mensaje" => "Something went wrong in delete method"
                ]);
            }
        } else {
            return response()->json([
                "data" => null,
                "status" => "error",
                "mensaje" => "The element no exits"
            ]);
        }
    }
}
