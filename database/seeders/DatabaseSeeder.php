<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        collect([
            [
                'title' => 'A => Foo | B => Bar | C => Baz',
                'meta' => [
                    'a' => 'foo',
                    'b' => 'bar',
                    'c' => 'baz'
                ]
            ],
            [
                'title' => 'A => NULL | B => NULL | C => NULL',
                'meta' => [
                    'a' => NULL,
                    'b' => NULL,
                    'c' => NULL
                ]
            ],
            // [
            //     'title' => 'EMPTY ARRAY',
            //     'meta' => []
            // ],
            // [
            //     'title' => 'NULL',
            //     'meta' => NULL
            // ],
        ])->each(fn($item) => Post::create($item));
    }
}
