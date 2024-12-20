@extends('layouts.app')

@section('content')
    <div class="container card p-5 rounded-5 shadow-lg">
        <h1>Добавить животное</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('animals.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="species" class="form-label">Вид животного</label>
                <input type="text" name="species" id="species" class="form-control" value="{{ old('species') }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Имя животного</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Возраст</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ old('age') }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="cell_id" class="form-label">Клетка</label>
                <select name="cell_id" id="cell_id" class="form-control" required>
                    @foreach($cells as $cell)
                        <option value="{{ $cell->id }}" {{ old('cell_id') == $cell->id ? 'selected' : '' }}>{{ $cell->name }} (вместимость: {{ $cell->capacity }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-outline-success" style="border-radius:2em">Добавить</button>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary" style="border-radius:2em">На главную</a>
        </form>
    </div>
@endsection
