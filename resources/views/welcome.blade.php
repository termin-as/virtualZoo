@extends('layouts.app')

@section('content')
    <div class="container card p-5 rounded-5 shadow-lg">
        <h1>Виртуальный зоопарк</h1>
        <p>В зоопарке на данный момент проживают: {{ $totalAnimals }} животных</p>

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


        <div class="row">
            <div class="col-md-6">

                @auth()
                    <h2>Управление клетками</h2>
                    <a href="{{ route('cells.create') }}" class="btn btn-outline-success mb-3" style="border-radius:2em">Добавить клетку</a>
                @endauth

                <ul class="list-group" style="border-radius:2em">
                    @forelse($cells as $cell)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a class="btn bg-dark text-white" style="border-radius:2em" href="{{ route('cells.show', $cell) }}">{{ $cell->name }}</a>
                            <span class="badge bg-secondary">{{ $cell->animals->count() }} / {{ $cell->capacity }}</span>
                        </li>
                    @empty
                        <li class="list-group-item">Нет ни одной клетки</li>
                    @endforelse
                </ul>
            </div>


                @auth() <div class="col-md-6">
                    <h2>Управление животными</h2>
                    <a href="{{ route('animals.create') }}" class="btn btn-outline-success mb-3" style="border-radius:2em">Добавить животное</a>
            </div>
                @endauth


        </div>
    </div>
@endsection
