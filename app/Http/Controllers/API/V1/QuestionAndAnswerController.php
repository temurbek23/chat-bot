<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionAndAnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answer_text' => 'nullable|string',
        ]);

        // Create and store question
        $question = new Question();
        $question->question_text = $request->input('question_text');
        $question->answer_text = $request->input('answer_text');
        $question->is_checked = false;  // Tekshirilmagan savol yoki javob
        $question->question_type = 'general';  // Savol turini saqlash
        $question->save();
        if ($request->input('question_text')) {
            $text = 'Savolingiz';
        }
        if ($request->input('answer_text')) {
           $text .= ' va javobingiz';
        }
        $text .= " saqlandi.";
        if ($request->ajax()) {
            return response()->json([
                'message' => $text,
                'status' => 'success'
            ]);
        }

        return redirect()->back()->with('success', " $text");
    }
}
