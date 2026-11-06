<?php

namespace App\Http\Controllers;

use App\Models\LearningResource;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $career = $user->careerTarget;
        $totalResources = $career
            ? LearningResource::where('career_target_id', $career->id)->count()
            : 0;
        $completedResources = $career
            ? $user->learningProgress()
                ->whereHas('resource', fn ($query) => $query->where('career_target_id', $career->id))
                ->where('completed', true)->count()
            : 0;

        return view('dashboard.index', compact(
            'user', 'career', 'totalResources', 'completedResources'
        ));
    }
}
