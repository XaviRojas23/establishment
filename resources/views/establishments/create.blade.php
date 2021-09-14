@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
crossorigin=""/>

<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Registrar Establecimiento</h1>
        <div class="mt-5 row justify-content-center">
            <form action="{{route('establishments.store')}}" method="post" enctype="multipart/form-data" class="col-md-9 col-xs-12 card card-body">
                @csrf
                <fieldset class="border p-4">
                    <legend class="text-primary">Diseña tu Establecimiento</legend>
                    <div class="form-group">
                        <label for="name">Nombre Establecimiento</label>
                        <input type="text" id="name" class="form-control @error ('name') is-invalid @enderror" placeholder="Nombre Establecimiento" name="name" value="{{old('name')}}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Nombre Categoría</label>
                        <select name="category_id" id="category_id" class="form-control @error ('category_id') is-invalid @enderror">
                            <option value="" selected disabled>-- Seleccionar --</option>
                            @foreach($categories as $category)
                                <option value=" {{$category->id}} {{old('category_id') == $category->id ? 'selected' : ''}} "> {{$category->name}} </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="image">Imagen Establecimiento</label>
                        <input type="file" id="image_principal" name="image_principal" class="form-control @error ('image_principal') is-invalid @enderror" name="image_principal" value="{{old('image_principal')}}">
                        @error('image_principal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend class="text-primary">Ubicación</legend>
                    <div class="form-group">
                        <label for="name">Ubicación de tu Establecimiento</label>
                        <input type="text" id="formsearch" class="form-control" placeholder="Indique la ubicación de su negocio">
                        <p class="text-secondary mt-5 mb-3 text-center">Ubiqué su establecimiento</p>
                    </div>
                    <div class="form-group">
                        <div id="map" style="height: 400px;"></div>
                        @error('lat')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                        @error('lng')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <p class="informacion">Indiqué la dirección escribiendo la ubicación o colocando el pin</p>

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" id="address" name="address" class="form-control @error ('address') is-invalid @enderror" placeholder="Dirección" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
                    <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}">
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input
                                type="tel"
                                class="form-control @error('tlf')  is-invalid  @enderror"
                                id="tlf"
                                placeholder="Teléfono Establecimiento"
                                name="tlf"
                                value="{{ old('tlf') }}"
                            >

                                @error('tlf')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>
                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('description')  is-invalid  @enderror"
                                name="description" id="description"
                            >{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora apertura:</label>
                            <input
                                type="time"
                                class="form-control @error('opening')  is-invalid  @enderror"
                                id="opening"
                                name="opening"
                                value="{{ old('opening') }}"
                            >
                            @error('opening')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora closing:</label>
                            <input
                                type="time"
                                class="form-control @error('closing')  is-invalid  @enderror"
                                id="closing"
                                name="closing"
                                value="{{ old('closing') }}"
                            >
                            @error('closing')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </fieldset>
                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Imagenes Establecimiento: </legend>
                    <div class="form-group">
                        <label for="image">Imagenes</label>
                        <div id="dropzone" class="dropzone form-control">

                        </div>
                    </div>
                </fieldset>

                <input type="hidden" id="uuid" name="uuid" value="{{ Str::uuid()->toString() }}">
                <input type="submit" class="btn btn-primary mt-3 d-block" value="Registrar Establecimiento">
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>

  <script src="https://unpkg.com/esri-leaflet" defer></script>
  <script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
  integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
  crossorigin=""></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js" integrity="sha512-VQQXLthlZQO00P+uEu4mJ4G4OAgqTtKG1hri56kQY1DtdLeIqhKUp9W/lllDDu3uN3SnUNawpW7lBda8+dSi7w==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endsection
