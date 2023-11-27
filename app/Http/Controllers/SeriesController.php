<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Jobs\DeleteSeriesCover;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        $this->middleware('auth')->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $coverPath = $request->hasFile("cover") ?
            $request->file('cover')->store("series_cover", "public")
            : null;
        $request->coverPath = $coverPath;
        $serie = $this->repository->add($request);

        $seriesCreatedEvent = new \App\Events\SeriesCreated(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );

        event($seriesCreatedEvent);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        $series->delete();
        DeleteSeriesCover::dispatch($series->cover_path);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $this->repository->update($request, $series->id);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}
