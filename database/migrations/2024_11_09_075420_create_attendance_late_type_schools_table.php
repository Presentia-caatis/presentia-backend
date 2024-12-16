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
        Schema::create('attendance_late_type_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId("school_id")->constrained("schools")->cascadeOnDelete();
            $table->foreignId("attendance_late_type_id")->constrained("attendance_late_types")->cascadeOnDelete();
            $table->unique(['school_id', 'attendance_late_type_id'], 'alt_school_attendance_type_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_late_type_schools');
    }
};
