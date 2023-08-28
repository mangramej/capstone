<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'type' => fake()->randomElement(['champion', 'requester', 'provider']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function registered(): static
    {
        return $this->withPersonalInfo()
            ->withAddress();
    }

    public function withAddress(): static
    {
        return $this->state(fn (array $attributes) => [
            'street' => fake()->streetAddress(),
            'region_id' => '01',
            'province_id' => '02',
            'city_id' => '03',
            'barangay_id' => '04',
            'zip_code' => '1234'
        ]);
    }

    public function withPersonalInfo(): static
    {

        return $this->state(fn (array $attributes) => [
            'first_name' => fake()->firstName(),
            'middle_name' => '',
            'last_name' => fake()->lastName(),
            'date_of_birth' => fake()->date(),
            'phone_number' => fake()->phoneNumber(),
        ]);
    }
}
