<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Page;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

class PageTest extends TestCase
{
    use RefreshDatabase;

    public function test_pages_list_response(): void
    { 
        $user = User::factory()->create();

        

        $response = $this->actingAs($user)->get('adminzone/pages');

        // dd($response);

        $response->assertStatus(200);

        $response->assertInertia(fn (AssertableInertia $page) =>  $page
            ->component('Pages/Index')
            ->has('pages', 3) // Ожидаем 3 записи
        );
    }

    public function test_page_create_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        

        $response = $this->actingAs($user)->get(route('pages.create'));

        $response->assertStatus(200);
    }

    public function test_page_edit_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $page = Page::factory()->create();
        
        $response = $this->actingAs($user)->get(route('pages.edit', ['page' => $page]));

        $response->assertStatus(200);
    }

    public function test_pages_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        
        
        $response = $this->actingAs($user)->get(route('pages.index'));

        $response->assertStatus(200);
    }

    public function test_store_page_success(): void
    {
        $user = User::factory()->create();

        

        $response = $this->actingAs($user)->post(route('pages.store'), [
            'languages' => [
                [
                    'language' => 'ru',
                    'title' => 'test page was created'
                ],
                [
                    'language' => 'ua',
                    'title' => 'test page fghwas created'
                ],
            ],
            'type' => 'pages',
            'alt_title' => 'test-page-was-created',
        ]);

        $response->assertRedirect(route('pages.index'));
    }

    public function test_update_page_success(): void
    {
        $user = User::factory()->create();

        

        $page = Page::factory()->create();

        $response = $this->actingAs($user)->put(route('pages.update', ['page' => $page]), [
            'languages' => [
                [
                    'language' => 'ru',
                    'title' => 'test page was updated'
                ],
                [
                    'language' => 'ua',
                    'title' => 'test page fghwas updated'
                ],
            ],
            'type' => 'pages',
            'alt_title' => 'test-page-was-updated',
        ]);

        $response->assertRedirect(route('pages.edit', ['page' => $page]));
    }
}
