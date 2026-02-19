<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'descripcion',
        'ISBN',
        'copias_totales',
        'copias_disponibles',
        'estado',
    ];
}