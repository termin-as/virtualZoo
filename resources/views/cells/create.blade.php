@extends('layouts.app')

@section('content')
    <div class="container card p-5 rounded-5 shadow-lg">
        <h1>Создать клетку</h1>
        <form method="POST" action="{{ route('cells.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Табличка клетки</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="capacity" class="form-label">Вместимость</label>
                <input type="number" name="capacity" id="capacity" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-outline-success" style="border-radius:2em">Создать</button>
            <a href="{{ route('cells.index') }}" class="btn btn-outline-secondary" style="border-radius:2em">Все клетки</a>
        </form>
    </div>
@endsection
