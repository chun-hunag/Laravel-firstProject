<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Post;
use App\User;

class PostControllerTest extends TestCase
{
   use DatabaseMigrations; // 有使用資料庫的測試，不use 此 Trait會導致錯誤
    /**
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('posts.index'));
        $response->assertViewIs('posts.index');
    }
    /**
     * @return void
     */
    public function testCreateWithoutUserShouldRedirectToLogin()
    {
        $response = $this->get(route('posts.create'));
        $response->assertRedirect(route('login'));
    }
    /**
     * @return void
     */
    public function testCreateWithUserShouldShowCreatePage()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('posts.create'));
        $response->assertViewIs('posts.create');
    }
    /**
     * @return void
     */
    public function testEditWithoutUserShouldRedirectToIndex()
    {
        $post = new Post;
        $post->content = '';
        $post->subject_id = 0;
        $post->user_id = 0;
        $post->save();
        $response = $this->get(route('posts.edit', ['post' => $post]));
        $response->assertRedirect(route('posts.index'));
    }
    /**
     * @return void
     */
    public function testEditWithCorrectUserShouldShowPostIndex()
    {
        $user = factory(User::class)->create();
        $post = new Post();
        $post->content = '';
        $post->subject_id = 0;
        $post->user_id = $user->id;
        $post->save();
        $response = $this->get(route('posts.edit', ['post' => $post]));
        $response->assertRedirect(route('posts.index'));
    }
    /**
     * @return void
     */
    public function testEditWithIncorrectUserShouldRedirectToIndex()
    {
        $users = factory(User::class, 2)->create();
        $post = new Post;
        $post->content = '';
        $post->subject_id = 0;
        $post->user_id = $users[0]->id;
        $post->save();
        $response = $this->actingAs($users[1])
            ->get(route('posts.edit', ['post' => $post]));
        $response->assertRedirect(route('posts.index'));
    }
    /**
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        $this->post(route('posts.store'), [
            'content' => 'Laravel 6.0 tutorial day 21',
        ]);
        
        $this->assertDatabaseHas('posts', [
            'content' => 'Laravel 6.0 tutorial day 21',
        ]);
    }

    public function testUpdate()
    {
        $post = new Post;
        $post->content = '';
        $post->subject_id = 0;
        $post->save();

        $this->put(route('posts.update', ['post' => $post]), [
            'content' => 'Laravel 6.0 tutorial day 21-2'
        ]);

        $this->assertDatabaseHas('posts', [
            'content' => 'Laravel 6.0 tutorial day 21-2',
        ]);
    }

    public function testDestroy()
    {
        $post = new Post;
        $post->content = 'Laravel 6.0 tutorial day 21-4';
        $post->subject_id = 0;
        $post->save();

        $this->delete(route('posts.destroy', ['post' => $post]));

        // 使用assertSoftDeleted測試softDelete，而非assertDatabaseMissing
        $this->assertSoftDeleted('posts', [
            'content' => 'Laravel 6.0 tutorial day 21-4',
        ]);
    }
}
