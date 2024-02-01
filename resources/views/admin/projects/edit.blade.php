@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center">Modifica il progetto</h2>
            
        <form class="mt-5" action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3 has-validation">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') ? : $project->title }}">
                @error('title')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Contenuto</label>
                <textarea class="form-control" id="content" rows="3" name="content">{{ old('content', $project->content) }}</textarea>
            </div>  
            
            <div class="mb-3">
                <select id="type" name="type_id" class="form-select" aria-label="Default select example">
                <label for="type"></label>
                <option @selected(!old('type_id', $project->type_id)) value="">Nessuna tipo</option>
                    @foreach ($types as $type)                 
                    <option @selected(old ('type_id', $project->type_id) == $type->id) value="{{$type->id}}">{{$type->name}}</option>  
                    
                    @endforeach
                  </select>
                </div> 

                <div class="mb-3">
                  @foreach ($technologies as $technology)
                      <div class="form_check">
                        <input @checked($errors->any() ? in_array($technology->id,old('technology',[])) : $project->technologies->contains($technology)) type="checkbox" id="technology-{{$technology->id}}" value="{{$technology->id}}" name="technologies[]"> 
                        <label for="technology-{{$technology->id}}">{{$technology->name}}</label>
                      </div>
                  @endforeach
                  @error('technologies')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                </div>  
            
            <button class="btn btn-success" type="submit">Salva</button>

        </form>
    </div>
@endsection