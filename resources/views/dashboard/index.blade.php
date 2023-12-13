@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <a href="{{ route('dashboard.create') }}" class="btn btn-primary mb-3">Create Post</a>

                        @if ($posts->isEmpty())
                            <p>No posts yet.</p>
                        @else
                            @foreach ($posts as $post)
                                <div class="mb-4">
                                    <h5>{{ $post->title }}</h5>
                                    <p>{{ $post->text }}</p>

                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                                    @endif

                                    <p>Posted on: {{ $post->created_at->format('Y-m-d H:i:s') }}</p>

                                    <div class="btn-group" role="group">
                                        <a href="{{ route('dashboard.edit', $post) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('dashboard.destroy', $post) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
