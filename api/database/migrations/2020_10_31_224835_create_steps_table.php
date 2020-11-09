<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('snippet_id')->index();
            $table->uuid('uuid');
            $table->string('title')->nullable();
            $table->decimal('order', 2, 2)->index();
            $table->text('body')->nullable();
            $table->timestamps();

            //$table->foreignId('snippet_id')->constrained()->onDelete('cascade');
            $table->foreign('snippet_id')->references('id')->on('snippets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
}
