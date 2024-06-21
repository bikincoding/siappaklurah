<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banjar>
 */
class BanjarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      
            $factory->define(NamaModel::class, function (Faker $faker) {
                return [
                    'nama_banjar' => $faker->data1
                    // dan seterusnya
                ];
            });
       
    }
}
