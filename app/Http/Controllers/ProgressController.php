<?php

namespace App\Http\Controllers;

use App\Models\LearningResource;
use App\Models\UserLearningProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $career = $user->careerTarget;
        $resources = $career
            ? $career->learningResources()
                ->with(['userProgress' => fn ($query) => $query->where('user_id', $user->id)])
                ->orderBy('sequence')->get()
            : collect();

        $total = $resources->count();
        $completed = $resources->filter(
            fn ($resource) => (bool) optional($resource->userProgress->first())->completed
        )->count();
        $percent = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

        return view('progress.index', compact(
            'career', 'resources', 'total', 'completed', 'percent'
        ));
    }

    public function toggle(Request $request, LearningResource $resource)
    {
        $user = $request->user();

        if (! $user->career_target_id || $resource->career_target_id !== $user->career_target_id) {
            abort(403, 'Materi ini bukan bagian dari target karier yang kamu pilih.');
        }

        $progress = UserLearningProgress::firstOrCreate(
            [
                'user_id' => $user->id,
                'learning_resource_id' => $resource->id,
            ],
            ['completed' => false]
        );

        $progress->completed = ! $progress->completed;
        $progress->completed_at = $progress->completed ? now() : null;
        $progress->save();

        return back()->with('success', 'Progress belajar berhasil diperbarui.');
    }
}
