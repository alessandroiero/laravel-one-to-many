@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crea post</h2>
    
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
    <form action="{{ route('admin.projects.store', $project) }}" method="POST" enctype="multipart/form-data" class="form-input-image">
        {{-- token laravel form --}}
        @csrf
        {{-- token --}}
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
        </div>
        <div class="mb-3">
          <div class="preview">
              <img id="file-image-preview">
          </div>
          <label for="image" class="form-label">IMG</label>
          <input class="form-control" type="file" id="image" name="image">
      </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

</div>
@endsection