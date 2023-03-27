<?php

namespace Tests\Feature\Http\Controllers\GenreController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Genre;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IndexTest extends TestCase
{
  use RefreshDatabase;
  use WithoutMiddleware;
  public function test_display_genre(): void
  {
    $genre = Genre::factory()->create();
    $response = $this->get(route('generos.index'));
    $response->assertStatus(200);
    $response->assertViewIs('genres.index');
    $response->assertSee($genre->name);
  }
  public function test_no_genres(): void
  {
    $response = $this->get(route('generos.index'));
    $response->assertStatus(200);
    $response->assertViewIs('genres.index');
    $response->assertSee('No hay géneros disponibles');
  }
  public function test_display_genres(): void
  {
    $genres = Genre::factory()->count(5)->create();
    $response = $this->get(route('generos.index'));
    $response->assertStatus(200);
    $response->assertViewIs('genres.index');
    foreach ($genres as $genre) {
      $response->assertSee($genre->name);
    }
  }
}
