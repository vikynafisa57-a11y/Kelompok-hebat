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
        $questions = AssessmentQuestion::orderBy('id')->get();

        if ($questions->isEmpty()) {
            return back()->with('error', 'Belum ada pertanyaan assessment. Jalankan php artisan db:seed terlebih dahulu.');
        }

        if (! $request->user()->career_target_id) {
            return redirect()->route('careers.index')
                ->with('error', 'Pilih target karier terlebih dahulu.');
        }

        $validated = $request->validate([
            'answers' => ['required', 'array', 'size:'.$questions->count()],
            'answers.*' => ['required', 'integer', 'between:1,5'],
        ]);

        foreach ($questions as $question) {
            if (! array_key_exists($question->id, $validated['answers'])) {
                return back()->withErrors(['answers' => 'Jawab semua pertanyaan terlebih dahulu.'])->withInput();
            }
        }

        $score = (int) round(collect($validated['answers'])->avg() * 20);

        DB::transaction(function () use ($request, $validated, $score, $questions, &$assessment) {
            $assessment = Assessment::create([
                'user_id' => $request->user()->id,
                'career_target_id' => $request->user()->career_target_id,
                'score' => $score,
            ]);

            foreach ($questions as $question) {
                AssessmentAnswer::create([
                    'assessment_id' => $assessment->id,
                    'assessment_question_id' => $question->id,
                    'score' => (int) $validated['answers'][$question->id],
                ]);
            }
        });

        return redirect()->route('skill-gap')
            ->with('success', "Assessment tersimpan. Skor umum kamu: {$score}/100.");
    }
}
