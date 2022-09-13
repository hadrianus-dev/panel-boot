<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Shared\Models\User;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'David',
            'last_name' => 'Hadrianus',
            'email' => 'admin@panel.com',
        ]);
    }
}
