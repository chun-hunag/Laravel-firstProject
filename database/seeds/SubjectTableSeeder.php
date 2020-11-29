<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject = new Subject;
        $subject->name = '測試主題';
        $subject->save();
    }
}