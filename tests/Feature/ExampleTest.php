<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'html' => '<h1>ISCME</h1>',
            'css' => '',
            'components' => [],
            'styles' => [],
            'is_published' => true,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_guests_are_redirected_to_the_admin_login(): void
    {
        $this->get('/admin')->assertRedirect(route('admin.login'));
    }

    public function test_an_administrator_can_access_the_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Admin/Dashboard')
                ->where('auth.user.email', $admin->email)
            );
    }

    public function test_an_administrator_can_access_speaker_management(): void
    {
        $admin = User::factory()->create(['role' => 'editor']);

        $this->actingAs($admin)
            ->get(route('admin.speakers.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Admin/Speakers/Index'));
    }

    public function test_an_administrator_can_manage_header_menus(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get(route('admin.menus.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Admin/Menus/Index')
                ->has('items', 0)
            );

        $this->post(route('admin.menus.store'), [
            'label' => 'Call for Papers',
            'url' => '/call-for-papers',
            'target' => '_self',
            'sort_order' => 1,
            'is_published' => true,
        ])->assertSessionHasNoErrors();

        $this->assertDatabaseHas('menu_items', [
            'label' => 'Call for Papers',
            'location' => 'header',
            'is_published' => true,
        ]);
    }

    public function test_global_settings_are_shared_with_the_public_website(): void
    {
        Page::create([
            'title' => 'Home', 'slug' => 'home', 'html' => '<h1>ISCME</h1>', 'css' => '',
            'components' => [], 'styles' => [], 'is_published' => true,
        ]);
        SiteSetting::create(['group' => 'general', 'key' => 'site_name', 'value' => ['value' => 'ISCME Conference']]);
        SiteSetting::create(['group' => 'general', 'key' => 'contact_email', 'value' => ['value' => 'team@example.test']]);

        $this->get('/')
            ->assertInertia(fn (Assert $page) => $page
                ->component('Page')
                ->where('site.site_name', 'ISCME Conference')
                ->where('site.contact_email', 'team@example.test')
            );
    }
}
