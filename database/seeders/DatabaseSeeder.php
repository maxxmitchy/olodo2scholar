<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Level;
use App\Models\Topic;
use App\Models\Option;
use App\Models\Faculty;
use App\Models\Question;
use App\Models\Department;
use App\Models\Difficulty;
use App\Models\University;
use App\Models\QuestionType;
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
        University::factory(10)->create();

        Level::factory(5)->create();

        Department::factory(10)->forFaculty()->hasCourses(5)->create();

        User::factory(10)->create();

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            University::factory()->for($user)->create();

            Department::factory()->for($user)->create();

            Level::factory()->for($user)->create();
        }

        foreach (['Easy', 'Intermediate', 'Hard'] as $difficulty) {
            Difficulty::create([
                'name' => $difficulty,
            ]);
        }

        Topic::factory(5)->hasSummaries(1)->hasQuizzes(3)->create();

        Question::factory(30)->create();

        $universities = University::all();

        $faculties = Faculty::all();

        $universities->each(function ($university) use ($faculties) {
            $university->faculties()->attach(
                $faculties->random(4)->pluck('id')
            );
        });

        foreach (['mcq'] as $questionType) {
            QuestionType::create([
                'name' => $questionType,
            ]);
        }

        Option::factory(40)->create();
    }
}
