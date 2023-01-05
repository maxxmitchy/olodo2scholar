<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Department;
use App\Models\Difficulty;
use App\Models\Faculty;
use App\Models\Idea;
use App\Models\Level;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Status;
use App\Models\Topic;
use App\Models\University;
use App\Models\User;
use App\Models\Vote;
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
        University::factory(3)->create();

        Level::factory(5)->create();

        Faculty::factory(3)->create();

        Department::factory(3)->create();

        User::factory(5)->create();

        foreach (['Easy', 'Intermediate', 'Hard'] as $difficulty) {
            Difficulty::create([
                'name' => $difficulty,
            ]);
        }

        Course::factory(10)->create();

        Topic::factory(5)->hasSummaries(2)->hasQuizzes(2)->create();

        Question::factory(10)->create();

        foreach (Question::all() as $question) {
            Option::factory(4)->existing()->create(['question_id' => $question->id]);
        }

        $universities = University::all();

        $faculties = Faculty::all();

        $universities->each(function ($university) use ($faculties) {
            $university->faculties()->attach(
                $faculties->random(3)->pluck('id')
            );
        });

        // foreach (['mcq'] as $questionType) {
        //     QuestionType::create([
        //         'name' => $questionType,
        //     ]);
        // }

        Category::factory()->create(['name' => 'Update Course']);
        Category::factory()->create(['name' => 'Correct Errors']);

        Status::factory()->create(['name' => 'Open']);
        Status::factory()->create(['name' => 'Considering']);
        Status::factory()->create(['name' => 'In Progress']);
        Status::factory()->create(['name' => 'Implemented']);
        Status::factory()->create(['name' => 'Closed']);

        Idea::factory(20)->existing()->create();

        // Generate unique votes. Ensure idea_id and user_id are unique for each row
        foreach (range(1, 5) as $user_id) {
            foreach (range(1, 20) as $idea_id) {
                if ($idea_id % 2 === 0) {
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'idea_id' => $idea_id,
                    ]);
                }
            }
        }

        // Generate comments for ideas
        foreach (Idea::all() as $idea) {
            Comment::factory(2)->existing()->create();
        }
    }
}
