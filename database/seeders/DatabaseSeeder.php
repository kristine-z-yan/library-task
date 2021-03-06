<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

       Book::factory()
            ->count(10)
            ->hasAttached(Author::factory()->count(2))
            ->create();
    }
}
