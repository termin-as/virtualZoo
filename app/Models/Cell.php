<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'capacity'];

    //Отношение "один-ко-многим" с моделью Animal. Одна клетка может иметь много животных.

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
