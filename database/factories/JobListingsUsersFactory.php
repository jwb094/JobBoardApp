<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobListingsUsers;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListingsUsers>
 */
class JobListingsUsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JobListingsUsers::class;
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'email'      => $this->faker->unique()->safeEmail(),
            'password'   => Hash::make('password'),
            'role'       => 'applicant', // default
        ];
    }

    /*
    * Admin user
     */
    public function admin()
    {
        return $this->state(fn() => [
            'role' => 'admin',
        ]);
    }

    /**
     * Employer user
     */
    public function employer()
    {
        return $this->state(fn() => [
            'role' => 'employer',
        ]);
    }

    /**
     * Applicant user
     */
    public function applicant()
    {
        return $this->state(fn() => [
            'role' => 'applicant',
        ]);
    }
}
