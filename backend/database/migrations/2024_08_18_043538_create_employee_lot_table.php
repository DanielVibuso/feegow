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
        Schema::create('employee_lot', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->foreignUuid('vaccine_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('lot_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_lot');
    }
};
