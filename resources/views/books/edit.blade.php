@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Book') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Use PUT method for update -->

                        <div class="form-group row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $book->title) }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="writer" class="col-md-4 col-form-label text-md-right">{{ __('Writer') }}</label>

                            <div class="col-md-6">
                                <input id="writer" type="text" class="form-control @error('writer') is-invalid @enderror" name="writer" value="{{ old('writer', $book->writer) }}" required autocomplete="writer">

                                @error('writer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($book->image)
                                    <img src="{{  asset('storage/' . $book->image) }}" alt="{{ $book->title }}" width="100">
                                @else
                                    No Image
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $book->price) }}" required>

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="number" step="1" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity', $book->quantity) }}" required>

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="number" step="1" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required>{{ $book->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="tags" class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>
                            <div class="col-md-6">
                                <input id="tags" type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags', $book->tags) }}" required>
                                <small id="tagsHelp" class="form-text text-muted">Enter tags separated by commas (e.g., tag1, tag2, tag3).</small>
                                @error('tags')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Repeat similar code blocks for other fields (writer, image, price, tags) -->

                        <div class="form-group row mb-3 mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('book.index') }}" class="btn btn-secondary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
