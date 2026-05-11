<?php

namespace App\Actions;

use App\Models\BodyweightLog;
use DB;
use Throwable;

class CreateBodyweightLogAction
{
    public function __construct() {}

    /**
     * @throws Throwable
     */
    public function __invoke(array $attributes): void
    {
        $attributes['user'] = auth()->id();

        DB::transaction(function () use ($attributes): void {
            BodyweightLog::create($attributes);
        });
    }
}
