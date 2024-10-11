<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_author()
    {
        $authorData = [
            'name' => 'John Doe',
            'bio' => 'An author.',
            'birth_date' => '1990-01-01',
        ];

        $response = $this->postJson('/authors', $authorData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('authors', $authorData);
    }

    /** @test */
    public function it_can_retrieve_an_author()
    {
        $author = Author::factory()->create();

        $response = $this->getJson("/authors/{$author->id}");

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $author->id,
            'name' => $author->name,
        ]);
    }

    /** @test */
    public function it_can_update_an_author()
    {
        $author = Author::factory()->create();
        $updatedData = ['name' => 'Jane Doe'];

        $response = $this->putJson("/authors/{$author->id}", $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('authors', $updatedData);
    }

    /** @test */
    public function it_can_delete_an_author()
    {
        $author = Author::factory()->create();

        $response = $this->deleteJson("/authors/{$author->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}
