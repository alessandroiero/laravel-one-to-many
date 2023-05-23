@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifica post: {{ $project->title }}</h2> 
    
    {{-- validazione errori --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- validazione errori --}}
    
    
    {{-- per inserire immagini mettiamo l'enctype enctype="multipart/form-data" --}}
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="form-input-image">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" id="content" name="content">{{ old('content', $project->content) }}</textarea>
        </div>
        
        {{-- immagini --}}
        <div class="mb-3 @if(!$project->image) d-none @endif"  id="image-input-container">
          {{-- preview immagine --}}
          <div class="preview">
              <img id="file-image-preview" @if($project->image) src="{{ asset('storage/' . $project->image) }}" @endif>
          </div>
          <label for="image" class="form-label py-4">IMG</label>
          <input class="form-control" type="file" id="image" name="image">
        </div>
        {{-- /immagini --}}

        <button type="submit" class="btn btn-primary">Edit</button>
      </form>

</div>
@endsection