<?php

namespace Modules\Swagger\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SwaggerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function index()
    {
        $jsonFilePath = base_path('Modules/Swagger/Resources/views/jsonApi/logins.json');
        if (!file_exists($jsonFilePath)) {
            throw new \Exception("El archivo JSON no se encuentra en la ruta: {$jsonFilePath}");
        }
        $jsonData = json_decode(file_get_contents($jsonFilePath), true);
        return view('swagger::index', compact('jsonData'));
    }

}
