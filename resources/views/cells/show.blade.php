@extends('layouts.app')

@section('content')
    <div class="container card p-5 rounded-5 shadow-lg">
        <h1>Клетка: {{ $cell->name }}</h1>
        <p>Вместимость: {{ $cell->capacity }}</p>

        @if($cell->animals->count() > 0)
            <h2>Животные в клетке:</h2>
            <ul class="list-group" style="border-radius:2em">
                @foreach($cell->animals as $animal)
                    <li class="list-group-item">
                        <a class="btn bg-dark text-white" style="border-radius:2em" href="{{ route('animals.show', $animal) }}">
                            {{ $animal->name }} ({{ $animal->species }})
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>В клетке пока нет животных.</p>
        @endif
        <a href="{{ route('cells.index') }}" class="btn btn-outline-secondary mt-3" style="border-radius:2em">Все клетки</a>
    </div>
@endsection
