<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function index()
    {
        // Récupère les quiz avec leurs catégories associées
        $quiz = Quiz::with('category')->get();

        return response()->json($quiz);
    }

    //submitQuiz : soumettre les réponses du quiz et calculer le score
    public function submitQuiz(Request $request, ApiService $service)
    {
        Log::debug(auth()->id());
        $data = $request->all();
        Log::info("question_id = ". $data['answers'][0]['question_id']);
        Log::info("answers 0 ". $data['answers'][0]['answers'][0]);



        return response()->json(['score' => ""], 201);
    }

    //getScore : récupérer le score d'un utilisateur pour un quiz donné
    public function getScore($id, $userId)
{
    $userScore = Score::where('quiz_id', $id)->where('user_id', $userId)->first();

    if (!$userScore) {
        return response()->json(['message' => 'Score not found'], 404);
    }

    return response()->json(['score' => $userScore->score]);
}

}
