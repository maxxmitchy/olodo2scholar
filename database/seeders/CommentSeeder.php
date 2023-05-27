<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Database\Seeder;

final class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (Topic::all() as $topic) {
            Comment::factory(4)->existing()->create();
        }
    }
}
