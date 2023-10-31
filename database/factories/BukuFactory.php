<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'id' => $this->faker->randomNumber(),
                'judul' =>$this->faker->sentence(),
                'penulis' =>$this->faker->name(),
                'harga'=>$this->faker->numberBetween(10000, 100000),
                'tgl_terbit'=>$this->faker->date($format='Y-m-d', $max='now'),
                'created_at'=>$this->faker->date($format='Y-m-d', $max='now'),
                'updated_at'=>$this->faker->date($format='Y-m-d', $max='now')
        ];
    }
}
