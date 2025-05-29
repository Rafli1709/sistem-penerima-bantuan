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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masyarakat_id');
            $table->foreign('masyarakat_id')->references('id')->on('masyarakat')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kriteria_id');
            $table->foreign('kriteria_id')->references('id')->on('kriteria')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('sub_kriteria_id');
            $table->foreign('sub_kriteria_id')->references('id')->on('sub_kriteria')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
