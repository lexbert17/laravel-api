@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Crea un nuovo progetto</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            
        <form class="mt-5" action="{{ route('admin.projects.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control" id="content" rows="3" name="content">{{ old('content') }}</textarea>
            </div>    
            
            <div class="mb-3">
            <select id="type" name="type_id" class="form-select" aria-label="Default select example">
            <label for="type"></label>
                <option selected>Seleziona il tipo di progetto</option>
                @foreach ($types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>  
                @endforeach
              </select>
            </div> 

            <div class="mb-3">
                <h5>seleziona la tecnologia utilizzata</h5>
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input @checked(in_array($technology->id, old('technologies', []))) type="checkbox" id="technology-{{$technology->id}}" value="{{$technology->id}}" name="technologies[]" >
                        <label for="{{$technology->id}}">{{$technology->name}}</label>
                    </div>
                @endforeach
            </div>
            
            
            <button class="btn btn-success" type="submit">Salva</button>

        </form>
    </div>
@endsection