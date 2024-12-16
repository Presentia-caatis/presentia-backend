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
        Schema::create('absence_permit_type_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId("school_id")->constrained("schools")->cascadeOnDelete();
            $table->foreignId("absence_permit_type_id")->constrained("absence_permit_types")->cascadeOnDelete();
            $table->unique(['school_id', 'absence_permit_type_id'], 'alt_school_absence_type_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absence_permit_type_schools');
    }
};
