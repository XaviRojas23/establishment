@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Regsitrar Establecimiento</h1>
        <div class="mt-5 row justify-content-center">
            <form action="" class="col-md-9 col-xs-12 card card-body">
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
                        <select name="category_id" id="category" class="form-control @error ('category') is-invalid @enderror">
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
                        <input type="file" id="image" class="form-control @error ('image') is-invalid @enderror" name="image" value="{{old('image')}}">
                        @error('image')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </fieldset>
                <fieldset class="border p-4">
                    <legend class="text-primary">Ubicación</legend>
                    <div class="form-group">
                        <label for="name">Ubicación de tu Establecimiento</label>
                        <input type="text" id="formsearch" class="form-control" placeholder="Indique la ubicación de su negocio">
                            <p class="text-secondary mt-5 mb-3 text-center">Ubiqué su establecimiento</p>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection
