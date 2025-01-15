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
        Schema::create('attendance_late_types', function (Blueprint $table) {
            $table->id();
            $table->string("type_name");
            $table->string("description");
            $table->integer("late_duration");
            $table->boolean("is_active")->default(true);
            $table->foreignId("school_id")->constrained("schools")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_late_types');
    }
};
