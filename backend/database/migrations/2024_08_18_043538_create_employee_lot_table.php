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
            $table->foreignUuid('employee_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('lot_id')->constrained()->onDelete('cascade');
            $table->date('applied_at');
            $table->unsignedSmallInteger('shot_number');
            $table->date('next_shot')->nullable()->comment('if null, then do not need');
            $table->softDeletes();
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
