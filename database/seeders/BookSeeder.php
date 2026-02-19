<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('data/books_classics.csv');
        $csv  = fopen($path, 'r');
        fgetcsv($csv); 

        while ($row = fgetcsv($csv)) {
            Book::create([
                'titulo'=> $row[0],
                'descripcion'=> $row[1],
                'ISBN'=> $row[2],
                'copias_totales'=> (int) $row[3],
                'copias_disponibles'=> (int) $row[4],
                'estado'=> $row[5] === 'disponible',
            ]);
        }
        fclose($csv);
        Book::factory()->count(90)->create();
    }
}