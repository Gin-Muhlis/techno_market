<?php

namespace Database\Factories;

use App\Models\Kontak;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class KontakFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kontak::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->text(255),
            'pesan' => $this->faker->text(),
            'tanggal' => $this->faker->date(),
        ];
    }
}
