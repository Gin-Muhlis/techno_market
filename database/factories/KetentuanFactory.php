<?php

namespace Database\Factories;

use App\Models\Ketentuan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class KetentuanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ketentuan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_ketentuan' => $this->faker->text(255),
        ];
    }
}
