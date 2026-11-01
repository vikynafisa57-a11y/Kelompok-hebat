<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentAnswer;
use App\Models\AssessmentQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        $career = $request->user()->careerTarget;
        $questions = AssessmentQuestion::with('skill')->orderBy('id')->get();

        return view('assessment.index', compact('career', 'questions'));
    }

    public function submit(Request $request)
    {
        $questions = AssessmentQuestion::all();
        if ($questions->isEmpty()) {
            return back()->with('error', 'Belum ada pertanyaan assessment. Jalankan seeder SkillGap terlebih dahulu.');
        }

        $validated = $request->validate([
            'answers' => ['required', 'array'],
            'answers.*' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $score = (int) round(collect($validated['answers'])->avg() * 20);

        DB::transaction(function () use ($request, $validated, $score, $questions, &$assessment) {
            $assessment = Assessment::create([
                'user_id' => $request->user()->id,
                'career_target_id' => $request->user()->career_target_id,
                'score' => $score,
            ]);

            foreach ($questions as $question) {
                if (isset($validated['answers'][$question->id])) {
                    AssessmentAnswer::create([
                        'assessment_id' => $assessment->id,
                        'assessment_question_id' => $question->id,
                        'score' => (int) $validated['answers'][$question->id],
                    ]);
                }
            }
        });

        return redirect()->route('skill-gap')->with('success', "Assessment tersimpan. Skor umum kamu: {$score}/100.");
    }
}
