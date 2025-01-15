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
        Schema::create('attendances', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId("student_id")->constrained("students")->cascadeOnDelete();
            $table->foreignId("attendance_late_type_id")->constrained("attendance_late_types")->cascadeOnDelete();
            $table->foreignId("attendance_window_id")->constrained("attendance_windows")->cascadeOnDelete();
            $table->timestamp("check_in_time")->nullable();
            $table->timestamp("check_out_time")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
