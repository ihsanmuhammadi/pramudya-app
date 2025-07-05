<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goods>
 */
class GoodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => fake()->words(2, true),
            'jumlah_barang' => fake()->numberBetween(1, 100),
            'satuan_barang' => fake()->words(1, true),
            'harga_barang' => fake()->randomFloat(2, 1000, 100000),
            'kode_barang' => fake()->unique()->numerify('KB###'),
            'spesifikasi' => fake()->sentence(),
        ];
    }
}
