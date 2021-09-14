<?php

namespace App\Http\Controllers;

use App\Http\Requests\Establishment\StoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Establishment;
use Intervention\Image\Facades\Image;
use App\Models\Image as ImageModel;
use SebastianBergmann\Environment\Console;

class EstablishmentController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('establishments.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'image_principal' => 'required|image|max:1000',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'tlf' => 'required|numeric',
            'description' => 'required|min:50',
            'opening' => 'date_format:H:i',
            'closing' => 'date_format:H:i|after:opening',
            'uuid' => 'required|uuid',
        ]);

            $route_image = $request['image_principal']->store('principals', 'public');
            $img = Image::make(public_path("storage/{$route_image}"))->fit(800,600);
            $img->save();

            $establishment = new Establishment($data);
            $establishment->image_principal = $route_image;
            $establishment->user_id = auth()->user()->id;
            $establishment->save();

        /*$establishment = Establishment::create([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'image_principal' => $route_image,
            'address' => $request->input('address'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng'),
            'tlf' => $request->input('tlf'),
            'description' => $request->input('description'),
            'opening' => $request->input('opening'),
            'closing' => $request->input('closing'),
            'uuid' => $request->input('uuid'),
        ]);*/



        return back()->with('estado', 'Tu información se almacenó correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Establishment $establishment)
    {

        $categories = Category::all();

        $establishment = auth()->user()->establishment;
        $establishment->opening = date('H:i', strtotime($establishment->opening));
        $establishment->closing = date('H:i', strtotime($establishment->closing));

        $images = ImageModel::where('id_establishment', $establishment->uuid)->get();

        return view('establishments.edit', compact('categories', 'establishment', 'images'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $establishment)
    {
        $this->authorize('update', $establishment);

        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'image_principal' => 'image|max:1000',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'tlf' => 'required|numeric',
            'description' => 'required|min:50',
            'opening' => 'date_format:H:i',
            'closing' => 'date_format:H:i|after:opening',
            'uuid' => 'required|uuid',
        ]);

        $establishment->name = $data['name'];
        $establishment->category_id = $data['category_id'];
        $establishment->address = $data['address'];
        $establishment->lat = $data['lat'];
        $establishment->lng = $data['lng'];
        $establishment->tlf = $data['tlf'];
        $establishment->description = $data['description'];
        $establishment->opening = $data['opening'];
        $establishment->closing = $data['closing'];
        $establishment->uuid = $data['uuid'];

        if(request('image_principal')){

            $route_image = $request['image_principal']->store('principals', 'public');
            $img = Image::make(public_path("storage/{$route_image}"))->fit(800,600);
            $img->save();

            $establishment->image_principal = $route_image;

        }
        $establishment->save();

        return back()->with('estado', 'Tu información se almacenó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Establishment $establishment)
    {
        //
    }
}
