<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cell;
use App\Models\Animal;

    class AnimalController extends Controller
    {

        //Отображает форму для создания нового животного.
        public function create()
        {
            // Получаем список всех клеток, чтобы пользователь мог выбрать, в какую клетку добавить животное.
            $cells = Cell::all();
            // Отображаем представление animals.create.
            return view('animals.create', compact('cells'));
        }


        //Сохраняет новое животное в базе данных.
        public function store(Request $request)
        {
            $request->validate([
                'species' => 'required|string',
                'name' => 'required|string',
                'age' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'cell_id' => 'required|exists:cells,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $cell = Cell::find($request->input('cell_id'));
            // Проверяем, не заполнена ли клетка.
            if ($cell && $cell->animals()->count() >= $cell->capacity) {
                return redirect()->back()->withErrors(['cell_id' => 'Клетка заполнена. Выберите другую клетку.'])->withInput();
            }


            $data = $request->all();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('animal_images', 'public');
                $data['image'] = $imagePath;
            }

            Animal::create($data);

            return redirect()->route('home')->with('success', 'Животное успешно добавлено.');
        }

        //Отображает информацию о конкретном животном.
        public function show(Animal $animal)
        {
            // Передаем данные в представление animals.show.
            return view('animals.show', compact('animal'));
        }

        //Отображает форму для редактирования животного.
        public function edit(Animal $animal)
        {
            // Получаем список всех клеток, чтобы пользователь мог выбрать другую клетку для животного.
            $cells = Cell::all();
            // Передаем данные в представление animals.edit.
            return view('animals.edit', compact('animal','cells'));
        }

        //Обновляет информацию о животном в базе данных.
        public function update(Request $request, Animal $animal)
        {
            // Валидируем входящие данные из запроса.
            $request->validate([
                'species' => 'required|string',
                'name' => 'required|string',
                'age' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'cell_id' => 'required|exists:cells,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Получаем все данные из запроса.
            $data = $request->all();

            // Обрабатываем загрузку нового изображения.
            if($request->hasFile('image')){
                // Если у животного уже было изображение, удаляем его из хранилища.
                if($animal->image){
                    \Storage::disk('public')->delete($animal->image);
                }
                // Сохраняем новое изображение в хранилище.
                $imagePath = $request->file('image')->store('animal_images', 'public');
                // Сохраняем путь к новому изображению в массиве данных.
                $data['image'] = $imagePath;
            }

            // Обновляем данные животного.
            $animal->update($data);

            // Перенаправляем пользователя на главную страницу с сообщением об успехе.
            return redirect()->route('home')->with('success', 'Информация о животном успешно обновлена.');
        }

    //Удаляет животное из базы данных.
    public function destroy(Request $request, Animal $animal)
    {
        // Если у животного было изображение, удаляем его из хранилища.
        if($animal->image){
            \Storage::disk('public')->delete($animal->image);
        }
        // Удаляем животное.
        $animal->delete();

        // Перенаправляем пользователя на главную страницу с сообщением об успехе.
        return redirect()->route('home')->with('success', 'Животное успешно удалено.');
    }
}
