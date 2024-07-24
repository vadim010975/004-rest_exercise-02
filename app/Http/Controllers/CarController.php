<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Car::query()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest $request)
    {
        return Car::query()->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Car::query()->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarRequest $request, int $id): bool
    {
        $todo = Car::query()->findOrFail($id);
        $todo->fill($request->validated());
        return $todo->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory|null
    {
        $todo = Car::query()->findOrFail($id);
        if ($todo->delete()) {
            return response(null, 204);
        }
        return null;
    }
}
