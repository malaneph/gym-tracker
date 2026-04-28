<?php

namespace App\Console\Commands;

use App\Enums\WorkoutStatus;
use App\Models\WorkoutSession;
use DB;
use Illuminate\Console\Command;

class WorkoutSessionsCleanupCommand extends Command
{
    protected $signature = 'workout-sessions:cleanup';

    protected $description = '';

    public function handle(): void
    {
        DB::transaction(function (): void {
            WorkoutSession::query()
                ->select(['workout_sessions.id', 'workout_sessions.status'])
                ->leftJoin('workout_sets', 'workout_sets.workout_session', '=', 'workout_sessions.id')
                ->addSelect(DB::raw('COUNT(workout_sets.id) as sets_count'))
                ->where('workout_sessions.status', '=', WorkoutStatus::FINISHED->value)
                ->groupBy('workout_sessions.id')
                ->having(DB::raw('COUNT(workout_sets.id)'), '<', 1)
                ->delete();

            WorkoutSession::where('status', '=', WorkoutStatus::DRAFT->value)
                ->where('started_at', '<', now()->subDay())
                ->update([
                    'status' => WorkoutStatus::FINISHED->value,
                    'finished_at' => now(),
                ]);

            $this->info('Workout sessions cleanup completed.');
        });
    }
}
