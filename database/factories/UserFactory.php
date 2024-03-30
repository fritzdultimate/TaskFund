<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->userName(),
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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

    public function level1(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%1%')->first('id')->id,
        ]);
    }
    public function level2(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%2%')->first('id')->id,
        ]);
    }
    public function level3(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%3%')->first('id')->id,
        ]);
    }
    public function level4(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%4%')->first('id')->id,
        ]);
    }
    public function level5(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%5%')->first('id')->id,
        ]);
    }
    public function level6(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%6%')->first('id')->id,
        ]);
    }
    public function level7(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%7%')->first('id')->id,
        ]);
    }
    public function level8(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%8%')->first('id')->id,
        ]);
    }

    public function level9(): static
    {
        return $this->state(fn (array $attributes) => [
            'level_id' => Level::where('name', 'like', '%9%')->first('id')->id,
        ]);
    }
}
