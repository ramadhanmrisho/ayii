<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AyiiFoundationTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_public_product_catalogue_displays_published_products(): void
    {
        $category = Category::first();
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Business Laptop',
            'slug' => 'business-laptop',
            'short_description' => 'Reliable ICT equipment.',
            'availability' => 'Available',
            'publication_status' => 'published',
            'active' => true,
            'quote_only' => true,
        ]);

        $this->get(route('products.index'))
            ->assertOk()
            ->assertSee($product->name);
    }

    public function test_contact_enquiry_is_stored(): void
    {
        $this->withoutMiddleware(PreventRequestForgery::class);

        $this->post(route('contact.store'), [
            'full_name' => 'Jane Customer',
            'email' => 'jane@example.com',
            'subject' => 'Supply enquiry',
            'message' => 'Please contact me about ICT supply.',
        ])->assertRedirect();

        $this->assertDatabaseHas(Enquiry::class, ['email' => 'jane@example.com']);
    }

    public function test_admin_dashboard_requires_authentication(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
    }

    public function test_super_admin_can_access_dashboard(): void
    {
        $user = User::where('email', 'admin@ayii.test')->firstOrFail();

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Dashboard');
    }

    public function test_super_admin_can_login_with_configured_credentials(): void
    {
        $this->withoutMiddleware(PreventRequestForgery::class);

        $this->post(route('login.store'), [
            'email' => 'admin@ayii.test',
            'password' => 'wcf',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();
    }
}
