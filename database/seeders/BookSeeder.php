<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // faker
        $faker = \Faker\Factory::create('id_ID');

        // insert 10 data
        for ($i = 0; $i < 10; $i++) {
            Book::create([
                'title' => $faker->sentence(3),
                'pengarang' => $faker->name(),
                'tanggal_terbit' => $faker->date(),
            ]);
        }
    }
}
