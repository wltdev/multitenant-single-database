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
        Schema::create('kanban_board_columns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kanban_board_id')->constrained('kanban_boards')->onDelete('cascade');
            $table->string('name'); // e.g., "New Lead", "Contacted"
            $table->integer('order'); // Position/order of column within board
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kanban_board_columns');
    }
};
