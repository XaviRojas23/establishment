<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Establishment;

class ApiController extends Controller
{

    // Método para obtener todos los establishments
    public function index()
    {
        $establishments = Establishment::with('category')->get();

        return response()->json($establishments);
    }

    // Método para obtener todas las categories
    public function categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Muestra los establishments de la category en especifico
    public function category( Category $category)
    {
        $establishments = Establishment::where('category_id', $category->id)->with('category')->take(3)->get();

        return response()->json($establishments);

        dd($category);
    }

    public function establishmentscategory( Category $category )
    {
        $establishments = Establishment::where('category_id', $category->id)->with('category')->get();
        return response()->json($establishments);
    }


    // Muestra un establishment en especifico
    public function show( Establishment $establishment ) {

        $images = Image::where('id_establishment', $establishment->uuid)->get();
        $establishment->images = $images;

        return response()->json($establishment);
    }
}
