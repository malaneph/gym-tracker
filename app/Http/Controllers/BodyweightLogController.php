<?php

namespace App\Http\Controllers;

use App\Actions\CreateBodyweightLogAction;
use App\Http\Requests\BodyweightLog\CreateRequest;
use App\Http\Requests\BodyweightLog\IndexRequest;
use App\Http\Resources\BodyweightLogResource;
use App\Models\BodyweightLog;
use App\Queries\BodyweightLogQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

class BodyweightLogController extends Controller
{
    public function index(BodyweightLogQuery $query, IndexRequest $request): AnonymousResourceCollection
    {
        $results = $query->index($request->validated('date_period'))->paginate(10);
        return BodyweightLogResource::collection($results);
    }

    /**
     * @throws Throwable
     */
    public function store(
        CreateBodyweightLogAction $action,
        CreateRequest $request,
        BodyweightLogQuery $query,
    ): BodyweightLogResource {
        $data = $request->validated();
        $action($data);
        $result = $query->builder()->latest('created_at')->first();

        return BodyweightLogResource::make($result);
    }

    public function show(BodyweightLog $bodyweightLog): BodyweightLogResource
    {
        return new BodyweightLogResource($bodyweightLog);
    }

    public function update(CreateRequest $request, BodyweightLog $bodyweightLog): BodyweightLogResource
    {
        $bodyweightLog->update($request->validated());

        return new BodyweightLogResource($bodyweightLog->refresh());
    }

    public function destroy(BodyweightLog $bodyweightLog): JsonResponse
    {
        $bodyweightLog->delete();

        return response()->json();
    }
}
