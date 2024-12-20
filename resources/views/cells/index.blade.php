@extends('layouts.app')

@section('content')
    <div class="container card p-5 rounded-5 shadow-lg">
        <h1>Список клеток</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @auth()
            <a href="{{ route('cells.create') }}" class="btn btn-outline-success mb-3" style="border-radius:2em">Добавить
                клетку</a>
        @endauth

        <ul class="list-group" style="border-radius:2em; min-width: 15em">
            @forelse($cells as $cell)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a class="btn bg-dark text-white" style="border-radius:2em"
                       href="{{ route('cells.show', $cell) }}">{{ $cell->name }}</a>
                    <span class="badge bg-secondary mx-1">{{ $cell->animals->count() }} / {{ $cell->capacity }}</span>
                    @auth()
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('cells.edit', $cell) }}" class="btn btn-sm btn-success mb-1"
                               style="background-color: #88b8a8; border-radius:2em">Изменить</a>
                            <form method="POST" action="{{ route('cells.destroy', $cell) }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="_method" value="POST">
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Вы уверены, что хотите удалить эту клетку?')"
                                        style="background-color: #baa5ac; border-radius:2em; margin-left: 0.2em">Удалить
                                </button>
                            </form>
                        </div>
                    @endauth
                </li>
            @empty
                <li class="list-group-item">Нет ни одной клетки</li>
            @endforelse
        </ul>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3" style="border-radius:2em">На главную</a>
    </div>
@endsection
