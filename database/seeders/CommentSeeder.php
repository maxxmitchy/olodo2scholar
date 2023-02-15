<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Topic::all() as $topic) {
            Comment::factory(4)->existing()->create();
        }
    }
}
