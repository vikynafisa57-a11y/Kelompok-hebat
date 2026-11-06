<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoadmapController extends Controller
{
    public function index(Request $request)
    {
        $career = $request->user()->careerTarget;
        $resources = $career
            ? $career->learningResources()
                ->with(['userProgress' => fn ($query) => $query->where('user_id', $request->user()->id)])
                ->orderBy('sequence')->get()
            : collect();

        return view('roadmap.index', compact('career', 'resources'));
    }
}
