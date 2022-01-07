<?php

namespace Database\Factories;

use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
// use Faker\Generator as Faker;

class WarehouseFactory extends Factory
{
    // use Faker;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Warehouse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $codeList = ['JNT', 'TIKI', 'SEC', 'SVL'];
        $code = $codeList[array_rand($codeList)] .' '. str_pad(random_int(1, 9), 2, 0, STR_PAD_LEFT);
        return [
            'code' => str_replace(' ', '', $code),
            'name' => 'Kho ' . $code,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
