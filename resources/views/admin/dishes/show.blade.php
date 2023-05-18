@extends('layouts.app')
@section('content')
	<div class="card col-10 my-5">
		{{-- <img src="{{ $dish->picture }}" class="card-img-top" alt="{{ $dish->name }}"> --}}
		{{-- PLACEHOLDER --}}
		<div class=" d-flex justify-content-between align-items-center">
			<img class="w-25" src="{{ $dish->getPictureUri() }}" alt="">
			<div class="">
				<h4 class="card-title text-center fw-bold fs-3">{{ $dish->name }}</h4>
				<h6 class="card-title text-center fw-bold">Descrizione</h6>
				<p class="card-text text-center">{{ $dish->description }}</p>
				<p class="card-text text-center"><span class="fw-bold">Prezzo:</span> {{ $dish->price }}€</p>
				<a class="btn btn-primary mx-1 py-1 px-2" href="{{ route('dishes.index', [$dish]) }}"><i
						class="bi bi-arrow-left"></i></a>
			</div>

		</div>
	</div>
@endsection