<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'book_id',
        'nombre_solicitante',
        'fecha_prestamo',
        'fecha_devolucion',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}