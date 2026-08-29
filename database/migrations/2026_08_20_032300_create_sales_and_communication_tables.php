<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rfqs', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('location')->nullable();
            $table->date('required_delivery_date')->nullable();
            $table->text('message')->nullable();
            $table->string('attachment')->nullable();
            $table->string('quotation_file')->nullable();
            $table->string('status')->default('new')->index();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->text('internal_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'created_at']);
        });

        Schema::create('rfq_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rfq_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->unsignedInteger('quantity')->default(1);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('organization')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('subject');
            $table->text('message');
            $table->string('status')->default('new')->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->boolean('active')->default(true)->index();
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribers');
        Schema::dropIfExists('enquiries');
        Schema::dropIfExists('rfq_items');
        Schema::dropIfExists('rfqs');
    }
};
