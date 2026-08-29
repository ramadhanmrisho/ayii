<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('featured')->default(false)->index();
            $table->boolean('active')->default(true)->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['active', 'featured', 'sort_order']);
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('featured')->default(false)->index();
            $table->boolean('active')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();
            $table->string('model')->nullable()->index();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->json('key_features')->nullable();
            $table->string('warranty')->nullable();
            $table->string('availability')->default('Available')->index();
            $table->decimal('price', 12, 2)->nullable();
            $table->boolean('show_price')->default(false);
            $table->boolean('quote_only')->default(true);
            $table->boolean('featured')->default(false)->index();
            $table->boolean('is_new')->default(false)->index();
            $table->boolean('active')->default(true)->index();
            $table->string('publication_status')->default('draft')->index();
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['active', 'publication_status', 'featured']);
            $table->index(['name', 'sku', 'model']);
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('thumbnail_path')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_primary')->default(false)->index();
            $table->timestamps();
        });

        Schema::create('product_specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('value');
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_specifications');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
    }
};
