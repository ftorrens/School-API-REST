<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CoursesRequest;



class CoursesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/courses",
     *     tags={"Courses"},
     *     summary="Get all courses",
     *     operationId="getCourses",
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
    public function getCourses()
    {
        return Course::all();
    }

    /**
     * Create a course.
     *
     * @OA\Post(
     *     path="/api/courses",
     *     tags={"Courses"},
     *     operationId="insertCourses",
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
     *                  "hours",
     *                  "price",
     *                  "percent_teacher",
     *                  "start_date",
     *                  "finish_date"
     *                  },
     *                 @OA\Property(
     *                     property="name",
     *                     description="Insert courses's name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="hours",
     *                     description="Insert courses's hours",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="Insert courses's price",
     *                     type="float"
     *                 ),
     *                 @OA\Property(
     *                     property="percent_teacher",
     *                     description="Insert courses's percent teacher",
     *                     type="float",
     *                      format="%"
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     description="Insert courses's start date",
     *                     type="date",
     *                     format="YYYY-MM-DD"
     *                 ),
     *                 @OA\Property(
     *                     property="finish_date",
     *                     description="Insert courses's finish date",
     *                     type="date",
     *                     format="YYYY-MM-DD"
     *                 )
     *             )
     *         )
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function insertCourses(CoursesRequest $request)
    {
        $data = $request->input();

        $response = Course::create($data);
        return response()->json([
            "data" => $response,
            "status" => "Success",
            "mensaje" => "Success operation"
        ]);
    }

    /**
     * Get an existing course.
     *
     * @OA\Get(
     *     path="/api/courses/{id}",
     *     tags={"Courses"},
     *     operationId="getCourseById",
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
    public function getCourseById(string $id)
    {
        $data = Course::find($id);

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
                "mensaje" => "The element no exits"
            ]);
        }
    }

    /**
     * Update an existing course.
     *
     * @OA\Put(
     *     path="/api/courses/{id}",
     *     tags={"Courses"},
     *     operationId="updateCourse",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the course that needs to be updated",
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
     *                  "hours",
     *                  "price",
     *                  "percent_teacher",
     *                  "start_date",
     *                  "finish_date"
     *                  },
     *                 @OA\Property(
     *                     property="name",
     *                     description="Insert courses's name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="hours",
     *                     description="Insert courses's hours",
     *                     type="integer"
     *                 ),
     *                 @OA\Property(
     *                     property="price",
     *                     description="Insert courses's price",
     *                     type="float"
     *                 ),
     *                 @OA\Property(
     *                     property="percent_teacher",
     *                     description="Insert courses's percent teacher",
     *                     type="float",
     *                      format="%"
     *                 ),
     *                 @OA\Property(
     *                     property="start_date",
     *                     description="Insert courses's start date",
     *                     type="date",
     *                     format="YYYY-MM-DD"
     *                 ),
     *                 @OA\Property(
     *                     property="finish_date",
     *                     description="Insert courses's finish date",
     *                     type="date",
     *                     format="YYYY-MM-DD"
     *                 )
     *             )
     *         )
     *     ),
     *     security={{"bearerToken":{}}}
     * )
     */
    public function updateCourse(CoursesRequest $request, string $id)
    {
        $data = Course::find($id);

        if (isset($data)) {
            $data->name = $request->name;
            $data->hours = $request->hours;
            $data->price = $request->price;
            $data->percent_teacher = $request->percent_teacher;
            $data->start_date = $request->start_date;
            $data->finish_date = $request->finish_date;

            if ($data->save()) {
                return response()->json([
                    "data" => $data,
                    "status" => "Success",
                    "mensaje" => "Operación exitosa"
                ]);
            } else {
                return response()->json([
                    "data" => null,
                    "status" => "error",
                    "mensaje" => "Fallo al modificar el elemento"
                ]);
            }
        } else {
            return response()->json([
                "data" => null,
                "status" => "error",
                "mensaje" => "No existe el elemento"
            ]);
        }
    }

    /**
     * Delete an existing course.
     *
     * @OA\Delete(
     *     path="/api/courses/{id}",
     *     tags={"Courses"},
     *     operationId="deleteCourse",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the course that needs to be delete",
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
    public function deleteCourse(string $id)
    {
        $data = Course::find($id);

        if (isset($data)) {
            if (Course::destroy($id)) {
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
     * Get courses's students.
     *
     * @OA\Get(
     *     path="/api/courses_student/{id}",
     *     tags={"Courses"},
     *     operationId="getCourseStudents",
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
    public function getCourseStudents(string $id)
    {
        $data = Course::find($id);

        if (isset($data)) {

            $courses = $data->Students;

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
