<!-- resources/views/home.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">
                        <form method="get" action="{{ route('home') }}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="date">Date:</label>
                                    <input type="date" class="form-control" name="date" value="{{ $dateFilter }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="user">User:</label>
                                    <select class="form-control" name="user">
                                        <option value="">All Users</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->user->name }}" {{ $userFilter == $user->user->name ? 'selected' : '' }}>
                                                {{ $user->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>

                        @if ($posts->isEmpty())
                            <p>No posts found.</p>
                        @else
                            @foreach ($posts as $post)
                                <div class="mb-4">
                                    <h5>{{ $post->title }}</h5>
                                    <p>{{ $post->text }}</p>

                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid">
                                    @endif

                                    <p>Posted by: {{ $post->user->name }} on {{ $post->created_at->format('Y-m-d H:i:s') }}</p>
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
