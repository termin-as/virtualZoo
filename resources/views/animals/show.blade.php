@extends('layouts.app')

@section('content')
    <div class="container text-center card p-5 rounded-5 shadow-lg">
        <h1>{{ $animal->name }}</h1>
        @if($animal->image)
            <div class="mt-3">
                <img src="{{ asset('../storage/app/public/' . $animal->image) }}" alt="Изображение {{ $animal->name }}"
                     style="max-width: 60%; border-radius:2em">
            </div>
        @endif
        <p><strong>Вид:</strong> {{ $animal->species }}</p>
        <p><strong>Возраст:</strong> {{ $animal->age }}</p>
        @if($animal->description)
            <p><strong>Описание:</strong> {{ $animal->description }}</p>
        @endif
        <p><strong>Клетка:</strong> <a class="btn btn-outline-secondary"
                                       href="{{ route('cells.show', $animal->cell) }}" style="border-radius:2em">{{ $animal->cell->name }}</a></p>

        @auth()
            <div class="mt-3">
                <a href="{{ route('animals.edit', $animal) }}" class="btn btn-success me-2 text-white mb-1"
                   style="background-color: #88b8a8; border-radius:2em">Редактировать</a>

                <form method="POST" action="{{ route('animals.destroy', $animal) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="_method" value="POST">
                    <button type="submit" class="btn btn-danger text-white"
                            onclick="return confirm('Вы уверены, что хотите удалить это животное?')"
                            style="background-color: #baa5ac; border-radius:2em">Удалить
                    </button>
                </form>
            </div>
        @endauth
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3" style="border-radius:2em">На главную</a>
    </div>
@endsection
