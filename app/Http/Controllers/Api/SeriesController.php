<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(
        private SeriesRepository $seriesRepository
    ) {
    }
    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has("nome")) {
            $query->where("nome","like","%". $request->get("nome") ."%");
        }

        return $query->paginate(5);
    }

    public function store(SeriesFormRequest $request)
    {
        return response()->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $series)
    {
        $seriesModel = Series::with("seasons.episodes")->find($series);
        if (!$seriesModel) {
            return response()->json(["message" => "series not found"], 404);
        }
        return $seriesModel;
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