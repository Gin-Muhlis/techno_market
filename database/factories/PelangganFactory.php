<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelangganFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pelanggan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pelanggan' => $this->faker->text(255),
            'kode_pelanggan' => $this->faker->text(255),
            'alamat' => $this->faker->text(),
            'no_telp' => $this->faker->text(255),
        ];
    }
}
