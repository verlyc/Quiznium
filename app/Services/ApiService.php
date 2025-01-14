<?php

namespace App\Services;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizCategory;
use App\Models\Score;
use App\Models\UserAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiService
{

    public function getQuizCategories()
    {
        return QuizCategory::all();
    }

    public function getQuiz($quizId)
    {
        return Quiz::query()
            ->with([
                'questions' => fn($q) => $q->with(['answers' => fn($q2) => $q2->orderBy('created_at', 'asc')])->orderBy('created_at', 'asc'),
                'category'
            ])
            ->withCount('questions')->findOrFail($quizId);
    }

    public function getQuizQuestions()
    {

    }

    public function getQuizzes()
    {
        return Quiz::query()->with(['category'])->withCount(['questions'])->get();
    }

    public function getQuizAnswers()
    {

    }

    public function submitQuiz(array $data) : Model
    {

        DB::beginTransaction();
        try {
            $quiz = Quiz::query()->find($data['quiz_id']);
            $score = 0;

            foreach ($data['answers'] as $answer) {
                $question = Question::query()->find($answer['question_id']);
                //les bonnes réponse de la question
                $correctAnswers = $question->answers()->where('is_correct', 1)->pluck('id')->toArray();
                //les réponse de l'utilisateur
                $answers = $answer['answers'];
                sort($correctAnswers);
                sort($answers);
                if ($answers == $correctAnswers) {
                    $score +=1;
                }
                foreach ($answers as $answerId) {
                    UserAnswer::query()->create([
                        'question_id' => $question->id,
                        'answer_id' => $answerId,
                        'user_id' => auth()->id(),
                    ]);
                }
            }

            DB::commit();
            return Score::query()->create([
                'quiz_id' => $quiz->id,
                'score' => $score,
                'user_id' => auth()->id(),
                'completed_at' => now(),
            ]);
        }catch (\Exception $exception){
            Log::debug($exception);
            DB::rollBack();
            abort(500, 'Something went wrong');
        }
    }
}
