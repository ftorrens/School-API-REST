<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;

class StudentsController extends Controller
{

    //TODO: Implement try and catch

    /**
     * @OA\Get(
     *     path="/api/students",
     *     tags={"Students"},
     *     summary="Get all students",
     *     operationId="getStudents",
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
    public function getStudents()
    {
        return Student::all();
    }

    /**
     * Create a student.
     *
     * @OA\Post(
     *     path="/api/students",
     *     tags={"Students"},
     *     operationId="saveStudent",
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
     *                  "name",
     *                  "last_name"
     *                  },
     *                 @OA\Property(
     *                     property="name",
     *                     description="Insert name of the student",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     description="Insert last name of the student",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="foto",
     *                     description="Insert foto of the student",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function saveStudent(StudentRequest $request)
    {
        $data = $request->input();

        $response = Student::create($data);
        return response()->json([
            "data" => $response,
            "status" => "Success",
            "mensaje" => "Success operation"
        ]);
    }

    /**
     * Get an existing student.
     *
     * @OA\Get(
     *     path="/api/students/{id}",
     *     tags={"Students"},
     *     operationId="getStudentById",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the student",
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
     *         description="Student not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function getStudentById(string $id)
    {
        $data = Student::find($id);

        if(isset($data)){
            return response()->json([
                "data" => $data,
                "status" => "Success",
                "mensaje" => "Success operation"
            ]);
        }else{
            return response()->json([
                "data" => null,
                "status" => "error",
                "mensaje" => "The element no exits"
            ]);
        }
    }

    /**
     * Update an existing student.
     *
     * @OA\Put(
     *     path="/api/students/{id}",
     *     tags={"Students"},
     *     operationId="updateStudent",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the student that needs to be updated",
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
     *         description="Student not found"
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
     *                  "name",
     *                  "last_name"
     *                  },
     *                 @OA\Property(
     *                     property="name",
     *                     description="Updated name of the student",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     description="Updated last name of the student",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="foto",
     *                     description="Updated foto of the student",
     *                     type="string"
     *                 )
     *             )
     *         )
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function updateStudent(Request $request, string $id)
    {
        $data = Student::find($id);

        if (isset($data)) {
            $data->name = $request->name;
            $data->last_name = $request->last_name;
            $data->foto = $request->foto;

            if($data->save()){
                return response()->json([
                    "data" => $data,
                    "status" => "Success",
                    "mensaje" => "Operación exitosa"
                ]);
            }else{
                return response()->json([
                    "data" => null,
                    "status" => "error",
                    "mensaje" => "Fallo al modificar el elemento"
                ]);
            }
        } else {
            return response()->json([
                "data"=>null,
                "status" => "error",
                "mensaje"=>"No existe el elemento"
            ]);
        }
    }

    /**
     * Delete an existing student.
     *
     * @OA\Delete(
     *     path="/api/students/{id}",
     *     tags={"Students"},
     *     operationId="deleteStudent",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the student that needs to be delete",
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
     *         description="Student not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function deleteStudent(string $id)
    {
        $data = Student::find($id);

        if (isset($data)) {
            if(Student::destroy($id)) {
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
                "mensaje" => "The element no exist"
            ]);
        }
    }

    /**
     * Get student's courses.
     *
     * @OA\Get(
     *     path="/api/student_courses/{id}",
     *     tags={"Students"},
     *     operationId="getStudentCourses",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the student",
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
     *         description="Student not found"
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Validation exception"
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function getStudentCourses(string $id)
    {
        $data = Student::find($id);

        if (isset($data)) {

            $courses = $data->Courses;

            return response()->json([
                "data" => $courses,
                "status" => "Success",
                "mensaje" => "Success operation"
            ]);
        } else {
            return response()->json([
                "data" => null,
                "status" => "error",
                "mensaje" => "The element no exits"
            ]);
        }
    }
}
