<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = ['species', 'name', 'age', 'description', 'cell_id', 'image'];

    //Отношение "принадлежит к" с моделью Cell. Одно животное принадлежит к одной клетке.

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }
}
