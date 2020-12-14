<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name'=>'Positive']);
        Tag::create(['name'=>'Negative']);
        Tag::create(['name'=>'Quarantined']);
        Tag::create(['name'=>'Survivor']);
        Tag::create(['name'=>'Vaccinated']);
        Tag::create(['name'=>'Doctor']);
    }
}