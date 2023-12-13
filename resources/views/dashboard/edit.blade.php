@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post</div>

                    <div class="card-body">
                        <form action="{{ route('dashboard.update', $post) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="text">Text:</label>
                                <textarea name="text" class="form-control" required>{{ old('text', $post->text) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image (optional):</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mb-2">
                            @endif
                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
