<?php

namespace App\Http\Controllers;

use App\Models\CareerTarget;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index()
    {
        $careers = CareerTarget::with('skills')->orderBy('title')->get();
        return view('careers.index', compact('careers'));
    }

    public function select(Request $request)
    {
        $data = $request->validate([
            'career_target_id' => ['required', 'integer', 'exists:career_targets,id'],
        ]);

        $request->user()->career_target_id = $data['career_target_id'];
        $request->user()->save();

        return redirect()->route('skill-gap')->with('success', 'Target karier berhasil disimpan.');
    }

    public function skillGap(Request $request)
    {
        $career = $request->user()->careerTarget;
        $assessment = $request->user()->assessments()
            ->where('career_target_id', $request->user()->career_target_id)
            ->latest()->first();

        $skills = $career ? $career->skills : collect();

        return view('careers.skill-gap', compact('career', 'assessment', 'skills'));
    }
}
