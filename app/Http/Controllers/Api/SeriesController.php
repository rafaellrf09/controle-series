<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    public function __construct(
        private SeriesRepository $seriesRepository
    ) {
    }
    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        return response()->json($this->seriesRepository->add($request), 201);
    }

    public function show(Series $series)
    {
        return $series;
    }

    public function update(SeriesFormRequest $request, int $series)
    {
        return response()->json($this->seriesRepository->update($request, $series), 200);
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}