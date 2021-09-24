<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            for ($i = 1; $i < 3; $i++) {
                $quiz = DB::table('quizzes')->insertGetId([
                    'type' => '1',
                    'name' => "Quiz_" . $i,
                ]);
                if ($quiz) {
                    for ($j = 1; $j < 11; $j++) {
                        DB::table('quiz_questions')->insert([
                            'quiz_id'   => $quiz,
                            'counter'   => $j,
                            'question'  => "Quiz " . $i . ' Question number ' . $j,
                            'options'   => json_encode([
                                'Question number ' . $j . ' Option 1',
                                'Question number ' . $j . ' Option 2',
                                'Question number ' . $j . ' Option 3',
                                'Question number ' . $j . ' Option 4',
                            ]),
                            'answers'   => json_encode([
                                rand(1, 4),
                                rand(1, 4),
                            ]),
                        ]);
                    }
                }
            }
        } catch (\Throwable $th) {
            $this->command->info("Something Wrong ".$th->getMessage());
        }
    }
}
