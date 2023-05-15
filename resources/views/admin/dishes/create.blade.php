@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Aggiungi piatto') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('dishes.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-3">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="description"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-9">
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="3">{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="price"
                                    class="col-md-3 col-form-label text-md-right">{{ __('Price') }}</label>

                                <div class="col-md-3">
                                    <input id="price" type="price"
                                        class="form-control @error('price') is-invalid @enderror" name="price" required
                                        autocomplete="new-price">

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="my-3 row">
                                    <label for="picture"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Picture') }}</label>

                                    <div class="mb-3">
                                        <input class="form-control" type="file" id="picture" name="picture">
                                    </div>
                                </div>

                                <div class="mb-4 row mb-0">
                                    <label for="visible"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Visibilita\'') }}</label>
                                    <select id="visible" name="visible" class="form-select"
                                        aria-label="Default select example">
                                        <option value="1">si</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>

                                <div class="mb-4 row mb-0">
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Add dish') }}
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
