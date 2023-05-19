<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *   title="School API REST Documentation",
 *   version="1",
 *   contact={
 *     "email": "ftorrensabeal@gmail.com"
 *   }
 * )
 * @OA\SecurityScheme(
 *  type="http",
 *  description="Acess token from authentication",
 *  name="Authorization",
 *  in="header",
 *  scheme="bearer",
 *  bearerFormat="JWT",
 *  securityScheme="bearerToken"
 * )
 * @OA\Server(url="http://127.0.0.1:8000")
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
