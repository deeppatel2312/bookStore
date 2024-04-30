@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Settings') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('setting.store') }}" enctype="multipart/form-data">
                        @csrf
                        @foreach ($settings as $item)
                            <div class="form-group row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __($item->title) }}</label>

                                <div class="col-md-6">
                                    <input id="{{$item->key}}" type="text" class="form-control @error($item->key) is-invalid @enderror" name="{{ __($item->key) }}" value="{{ old($item->key,$item->value) }}" required autocomplete="{{$item->key}}" autofocus>

                                    @error($item->key)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group row mb-3 mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
