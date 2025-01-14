<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __construct(public ApiService  $apiService)
    {
    }

    public function getQuizzesCategories()
    {
        return response()->json($this->apiService->getQuizCategories());
    }

    public function getQuizzes()
    {
        return response()->json($this->apiService->getQuizzes());
    }

    public function submitQuiz(Request $request)
    {
        return response()->json($this->apiService->submitQuiz($request->all()));
    }

        public function getQuiz($id)
    {
        return response()->json($this->apiService->getQuiz($id));
    }

}
