<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankDetail>
 */
class BankDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_name' => fake()->creditCardType(),
            'bank_code' => fake()->creditCardNumber(),
            'currency' => fake()->currencyCode(),
            'account_number' => fake()->creditCardNumber(),
            'recipient_code' => fake()->creditCardNumber(),
            'recipient_id' => fake()->creditCardNumber(),
        ];
    }
}
