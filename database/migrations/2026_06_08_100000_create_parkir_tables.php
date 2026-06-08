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
        Schema::create('parkir_locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name', 100);
            $table->integer('max_motorcycle');
            $table->integer('max_car');
            $table->integer('max_other');
            $table->integer('available_motorcycle');
            $table->integer('available_car');
            $table->integer('available_other');
            $table->timestamps();
        });

        Schema::create('parkir_vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis', ['motorcycle', 'car', 'other'])->unique();
            $table->integer('perjam_pertama');
            $table->integer('perjam_berikutnya');
            $table->integer('max_perhari');
            $table->timestamps();
        });

        Schema::create('parkir_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lokasi')->constrained('parkir_locations')->onDelete('cascade');
            $table->string('no_tiket')->unique();
            $table->string('no_polisi');
            $table->foreignId('id_jenis')->constrained('parkir_vehicle_types')->onDelete('cascade');
            $table->dateTime('masuk');
            $table->dateTime('keluar')->nullable();
            $table->integer('perjam_pertama');
            $table->integer('perjam_berikutnya');
            $table->integer('max_perhari');
            $table->integer('total_jam')->nullable();
            $table->integer('total_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkir_transactions');
        Schema::dropIfExists('parkir_vehicle_types');
        Schema::dropIfExists('parkir_locations');
    }
};
