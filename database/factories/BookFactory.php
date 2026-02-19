<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
   public function definition(): array
{
    $totales = fake()->numberBetween(1, 10);
    $disponibles = fake()->numberBetween(0, $totales);

    return [
        'titulo'=> fake()->sentence(3),
        'descripcion'=> fake()->paragraph(),
        'isbn'=> fake()->unique()->isbn13(),
        'copias_totales'=> $totales,
        'copias_disponibles'=> $disponibles,
        'estado'=> (bool) ($disponibles > 0),
    ];
}
}
