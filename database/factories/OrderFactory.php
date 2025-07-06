<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_po' => 'PO-' . $this->faker->unique()->numerify('####'),
            'tanggal' => $this->faker->date(),
            'company' => $this->faker->company(),
            'alamat' => $this->faker->address(),
            'no_telp' => $this->faker->phoneNumber(),
            'email' => $this->faker->companyEmail(),
            'fax' => $this->faker->phoneNumber(),
            'pic' => $this->faker->name(),
            'total_semua_barang' => 0,
            'catatan' => $this->faker->sentence(),
        ];
    }
}
