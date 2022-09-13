<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domain\Category\Models\Category;
use Domain\Shared\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        /* if(app()->environment('local')){
            $this->call(
                DefaultUserSeeder::class,
            );
        } */

        Category::factory(15)->for(
            User::factory()->create([
                'first_name' => 'David',
                'last_name' => 'Hadrianus',
                'email' => 'admin@tronnus.com',
            ])
        )->create();
        
    }
}
