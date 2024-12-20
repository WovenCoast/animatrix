<?php

namespace Tests\Feature\Controllers\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ArticlesControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_articles()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $this->get('/')
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    #[Test]
    public function it_can_filter_articles()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $this->get(add_query_arg([
            'search' => $article->title,
            'date_field' => 'created_at',
            'date_from' => now()->subDay()->toDateTimeString(),
            'date_to' => now()->addDay()->toDateTimeString(),
        ], '/'))
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    #[Test]
    public function it_can_show_the_create_new_article_page()
    {
        $this->withoutExceptionHandling();

        $this->get('/articles/create')
            ->assertStatus(200)
            ->assertSee('New Post');
    }

    #[Test]
    public function it_can_create_a_new_article()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->make();

        $this->post('/articles/create', [
            'title' => $article->title,
            'slug' => $article->slug,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'featured_image' => UploadedFile::fake()->image('featured_image.jpg', 1920, 1080)->size(10),
            'published' => $article->published,
            'published_at' => $article->published_at,
        ])
            ->assertRedirect()
            ->assertSessionMissing('errors');

        $this->assertDatabaseHas('articles', [
            'title' => $article->title,
            'slug' => $article->slug,
            'excerpt' => $article->excerpt,
            'content' => $article->content,
            'published' => $article->published,
            'published_at' => $article->published_at,
        ]);
    }

    #[Test]
    public function it_can_show_the_edit_article_page()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $this->get("/articles/{$article->id}/edit")
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    #[Test]
    public function it_can_update_a_article()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create([
            'title' => 'foo',
            'slug' => 'foo',
            'excerpt' => 'Lorem ipsum',
            'content' => 'Lorem ipsum',
            'published' => true,
            'published_at' => '2024-02-12 14:54',
        ]);

        $this->post("/articles/{$article->id}/edit", [
            'title' => 'bar',
            'slug' => 'bar',
            'excerpt' => 'Itsu bitsum',
            'content' => 'Itsu bitsum',
            'published_at' => '2023-01-11 13:30',
        ])
            ->assertRedirect()
            ->assertSessionMissing('errors');

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'bar',
            'slug' => 'bar',
            'excerpt' => 'Itsu bitsum',
            'content' => 'Itsu bitsum',
            'published' => false,
            'published_at' => '2023-01-11 13:30',
        ]);
    }

    #[Test]
    public function it_can_show_a_article()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $this->get("/articles/{$article->slug}")
            ->assertStatus(200)
            ->assertSee($article->title);
    }

    #[Test]
    public function it_can_delete_a_article()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
        ]);

        $this->delete("/articles/{$article->id}")
             ->assertStatus(200);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }

    #[Test]
    public function it_can_validate_article_inputs()
    {
        $this->post('/articles/create', [
            'title' => [],
            'slug' => [],
            'excerpt' => [],
            'content' => [],
            'published' => 'foo',
            'published_at' => 'foo',
        ])
            ->assertRedirect()
            ->assertSessionHasErrors([
                'title',
                'slug',
                'excerpt',
                'content',
                'published_at',
                'featured_image',
            ]);

        // auto-generated code, gives PDOException cause published_at isn't a valid date
//        $this->assertDatabaseMissing('articles', [
//            'title' => [],
//            'slug' => [],
//            'excerpt' => [],
//            'content' => [],
//            'published' => 'foo',
//            'published_at' => 'foo',
//        ]);
    }
}
