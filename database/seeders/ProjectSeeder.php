<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// importiamo Faker
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // inseriamo faker con la dependency injection
    public function run( Faker $faker)
    {
        for($i=0; $i<10; $i++){
            $project = new Project();

            $project->title= $faker->sentence(3);
            $project->content= $faker->text(500);
            $project->slug = Str::slug($project->title, '-');

            $project->save();
        }
    }
}
