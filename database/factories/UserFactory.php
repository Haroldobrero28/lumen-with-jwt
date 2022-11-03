<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $password = 'password';
        $uuid = Str::uuid();

        return [
            'id' => $uuid,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($password),
            'created_by' => $uuid,
            'updated_by' => $uuid,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
