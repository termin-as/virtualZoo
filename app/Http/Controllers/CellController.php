<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cell;
use App\Models\Animal;

class CellController extends Controller
{
    //Отображает список всех клеток.
    public function index()
    {
        // Получаем все клетки из базы данных.
        $cells = Cell::all();
        // Передаем данные в представление cells.index.
        return view('cells.index', compact('cells'));
    }

    //Отображает форму для создания новой клетки.
    public function create()
    {
        // Отображаем представление cells.create.
        return view('cells.create');
    }

    //Сохраняет новую клетку в базе данных.

    public function store(Request $request)
    {
        // Валидируем входящие данные из запроса.
        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|integer|min:1',
        ]);

        // Создаем новую клетку, используя данные из запроса.
        Cell::create($request->all());

        // Перенаправляем пользователя на страницу списка клеток с сообщением об успехе.
        return redirect()->route('cells.index')->with('success', 'Клетка успешно создана.');
    }

    //Отображает информацию о конкретной клетке.
    public function show(Cell $cell)
    {
        // Загружаем все связанные с этой клеткой животные.
        $cell->load('animals');
        // Передаем данные в представление cells.show.
        return view('cells.show', compact('cell'));
    }


    //Отображает форму для редактирования клетки.
    public function edit(Cell $cell)
    {
        // Передаем данные в представление cells.edit.
        return view('cells.edit', compact('cell'));
    }

    //Обновляет информацию о клетке в базе данных.

    public function update(Request $request, Cell $cell)
    {
        // Валидируем входящие данные из запроса.
        $request->validate([
            'name' => 'required|string',
            'capacity' => 'required|integer|min:' . $cell->animals()->count(),
        ]);

        // Обновляем данные клетки.
        $cell->update($request->all());

        // Перенаправляем пользователя на страницу списка клеток с сообщением об успехе.
        return redirect()->route('cells.index')->with('success', 'Клетка успешно обновлена.');
    }

    //Удаляет клетку из базы данных.

    public function destroy(Request $request, Cell $cell)
    {
        // Проверяем, есть ли в клетке животные.
        if ($cell->animals()->count() > 0) {
            // Если животные есть, возвращаем ошибку и не даём удалить.
            return redirect()->route('cells.index')->with('error', 'Нельзя удалить клетку, пока в ней есть животные.');
        }
        // Удаляем клетку.
        $cell->delete();

        // Перенаправляем пользователя на страницу списка клеток с сообщением об успехе.
        return redirect()->route('cells.index')->with('success', 'Клетка успешно удалена.');
    }
}
