@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1>Books</h1>
            <a href="{{ route('book.create') }}" class="btn btn-primary">Add Book</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Writer</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Tags</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($books as $book)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->writer }}</td>
                        <td>
                            @if($book->image)
                                <img src="{{  asset('storage/' . $book->image) }}" alt="{{ $book->title }}" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $book->price }}</td>
                        <td>
                            @php
                                $tags = explode(',',$book->tags);
                            @endphp
                            @foreach($tags as $tag)
                                <span class="badge bg-primary">{{ $tag }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('book.edit', $book->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('book.destroy', $book->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Books') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
