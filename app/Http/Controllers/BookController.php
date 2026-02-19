<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::query()
            ->when($request->titulo, fn($q) => $q->where('titulo', 'like', "%{$request->titulo}%"))
            ->when($request->isbn, fn($q) => $q->where('isbn', $request->isbn))
            ->when($request->has('status'), fn($q) => $q->where('estado', filter_var($request->status, FILTER_VALIDATE_BOOLEAN)))
            ->get();
        return BookResource::collection($books);
    }
}