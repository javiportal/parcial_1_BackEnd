<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\Loan;
use App\Models\Book;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('book')->get()->map(fn($loan) => [
            'id'=> $loan->id,
            'libro'=> $loan->book->titulo,
            'nombre_solicitante'=> $loan->nombre_solicitante,
            'fecha_prestamo'=> $loan->fecha_prestamo,
            'fecha_devolucion'=> $loan->fecha_devolucion,
            'estado_prestamo'=> $loan->fecha_devolucion ? 'Devuelto' : 'Activo',
        ]);
        return response()->json($loans);
    }
    public function store(LoanRequest $request)
    {
        $book = Book::findOrFail($request->id_libro);
        if ($book->copias_disponibles <= 0) {
            return response()->json([
                'message' => 'Ya no hay libros disponibles'
            ], 422);
        }
        $loan = Loan::create([
            'book_id'=> $book->id,
            'nombre_solicitante'=> $request->nombre_solicitante,
            'fecha_prestamo'=> now(),
        ]);
        $book->decrement('copias_disponibles');
        if ($book->fresh()->copias_disponibles == 0) {
            $book->update(['estado' => false]);
        }
        return response()->json($loan, 201);
    }
    public function returnBook(Loan $loan)
    {
        if ($loan->fecha_devolucion !== null) {
            return response()->json([
                'message' => 'Este préstamo ya fue devuelto anteriormente'
            ], 422);
        }
        $loan->update(['fecha_devolucion' => now()]);
        $book = $loan->book;
        $book->increment('copias_disponibles');

        if (!$book->fresh()->estado) {
            $book->update(['estado' => true]);
        }
        return response()->json([
            'message' => 'Devolución registrada correctamente'
        ], 200);
    }
}