<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function when_a_series_is_created_its_seasons_an_episodes_must_also_be_created()
    {
        /** @var SeriesRepository $repository */
        $repository = $this->app->make(SeriesRepository::class);
        $request = new SeriesFormRequest();
        $request->nome = "Nome fake";
        $request->seasonsQty = 1;
        $request->episodesPerSeason = 1;

        $repository->add($request);

        $this->assertDatabaseHas("series", ["nome"=> "Nome fake"]);
        $this->assertDatabaseHas("seasons", ["number"=> 1]);
        $this->assertDatabaseHas("episodes", ["number"=> 1]);
    }
}
