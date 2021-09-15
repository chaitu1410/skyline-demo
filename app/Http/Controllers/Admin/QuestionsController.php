<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    public function index()
    {
        $data['questions'] = Question::where('answered', 0)->paginate(10);
        return view('admin.questions.index', $data);
    }

    public function update(Request $request, Question $question)
    {
        try {
            if (($request->has('answer')) && ($request->answer !== "")) {
                $question->update([
                    'answer' => $request->get('answer'),
                    'answered' => true
                ]);
                $request->session()->flash('success', 'Question answered successfully!');
            } else {
                $request->session()->flash('error', 'Please enter answer in textbox');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            $request->session()->flash('error', 'Failed to post answer');
        }
        return back();
    }
}
