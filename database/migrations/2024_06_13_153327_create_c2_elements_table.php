<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('c2_elements', function (Blueprint $table) {
            $table->id();
            //$table->bigInteger('c2_item_id');
            $table->foreignId('c2_item_id')->constrained()->noActionOnUpdate()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('default_text')->nullable();
            $table->boolean('is_text')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c2_elements');
    }
};
