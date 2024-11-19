<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Libro>
 */
class LibroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->sentence(3),
            'autor' => fake()->name(),
            'descripcion' => fake()->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
            'cantidad' => fake()->numberBetween(1, 100),
            'disponibles' => fake()->numberBetween(1, 100),
            'numero_paginas' => fake()->numberBetween(100, 700),
            'fecha_publicacion' => fake()->dateTimeBetween('-100 year', 'now'),
            'editorial' => fake()->name(),
            'codigo' => fake()->unique()->uuid(),
            'calificacion' => fake()->numberBetween(1, 5),
            'idioma' => fake()->randomElement(['español', 'inglés', 'francés']),
            'categoria_id' => Categoria::inRandomOrder()->value('id') ?? Categoria::factory(),
        ];
    }
}
