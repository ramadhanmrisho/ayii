<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index();
            $table->string('key')->index();
            $table->json('value')->nullable();
            $table->string('type')->default('string');
            $table->timestamps();
            $table->unique(['group', 'key']);
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('disk')->default('public');
            $table->string('path');
            $table->string('thumbnail_path')->nullable();
            $table->string('name');
            $table->string('original_name');
            $table->string('mime_type', 100);
            $table->string('extension', 20);
            $table->unsignedBigInteger('size');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['mime_type', 'extension']);
        });

        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('display_order')->default(0)->index();
            $table->boolean('featured')->default(false)->index();
            $table->boolean('active')->default(true)->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('client')->nullable();
            $table->string('industry')->nullable();
            $table->string('location')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->longText('description')->nullable();
            $table->text('products_supplied')->nullable();
            $table->text('services_provided')->nullable();
            $table->string('status')->default('completed')->index();
            $table->string('cover_image')->nullable();
            $table->boolean('featured')->default(false)->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position');
            $table->string('photo')->nullable();
            $table->text('bio')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('linkedin')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('organization')->nullable();
            $table->string('position')->nullable();
            $table->string('photo')->nullable();
            $table->string('organization_logo')->nullable();
            $table->text('testimonial');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->boolean('approved')->default(false)->index();
            $table->boolean('featured')->default(false)->index();
            $table->boolean('active')->default(true)->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('value');
            $table->string('suffix')->nullable();
            $table->string('label');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('desktop_image')->nullable();
            $table->string('mobile_image')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_url')->nullable();
            $table->timestamp('start_at')->nullable()->index();
            $table->timestamp('end_at')->nullable()->index();
            $table->string('position')->default('homepage')->index();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->nullable()->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('post_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('post_categories')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('publication_status')->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('module')->index();
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->text('description')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->index(['subject_type', 'subject_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('post_categories');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('statistics');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('team_members');
        Schema::dropIfExists('project_images');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('solutions');
        Schema::dropIfExists('media');
        Schema::dropIfExists('settings');
    }
};
