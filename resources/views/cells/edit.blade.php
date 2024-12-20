@extends('layouts.app')

@section('content')
    <div class="container card p-5 rounded-5 shadow-lg">
        <h1>Редактировать клетку</h1>
        <form method="POST" action="{{ route('cells.update', $cell) }}">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Название клетки</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $cell->name }}" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Вместимость</label>
                <input type="number" name="capacity" id="capacity" class="form-control" value="{{ $cell->capacity }}" required>
            </div>
            <button type="submit" class="btn btn-outline-success mb-1" style="border-radius:2em">Обновить</button>
            <a href="{{ route('cells.index') }}" class="btn btn-outline-secondary" style="border-radius:2em">Все клетки</a>
        </form>
    </div>
@endsection
