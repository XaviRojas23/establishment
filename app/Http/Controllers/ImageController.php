<?php

namespace App\Http\Controllers;

use App\Models\Image as ImageModel;
use Illuminate\Http\Request;
use App\Models\Establishment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class ImageController extends Controller
{
    //
    public function store( Request $request )
    {

        // leer la image
        $route_image = $request->file('file')->store('establishments', 'public');

        // Resize a la image
        $image = Image::make( public_path("storage/{$route_image}"))->fit(800, 450);
        $image->save();

        // Almacenar con Modelo
        $imageDB = new ImageModel;
        $imageDB->id_establishment = $request['uuid'];
        $imageDB->route_image = $route_image;
        $imageDB->save();
        /*ImageModel::create([
            'id_establishment' => $request['uuid'],
            'route_image' => $route_image
        ]);*/

        // Retornar response
        $response = [
            'file' => $route_image
        ];

        return response()->json($response);
    }

    // Elimina una image de la BD y del servidor
    public function destroy( Request $request )
    {
        // Validación
        $uuid = $request->get('uuid');
        $establishment = Establishment::where('uuid', $uuid)->first();
        $this->authorize('delete', $establishment);

        $image = $request->get('image');

       if(File::exists('storage/' . $image)) {
           File::delete('storage/' . $image);
           ImageModel::where('route_image', $image )->delete();
       }
        $response = [
            'mensaje' => 'Imagen Eliminada',
            'image' => $image
        ];/*
       }*/
        return response()->json($response);
    }
}
