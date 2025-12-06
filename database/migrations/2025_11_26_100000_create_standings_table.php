<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('pos');
            $table->string('club');
            $table->string('logo')->nullable();
            $table->unsignedTinyInteger('main')->default(0); // main = jumlah pertandingan
            $table->unsignedTinyInteger('menang')->default(0);
            $table->unsignedTinyInteger('seri')->default(0);
            $table->unsignedTinyInteger('kalah')->default(0);
            $table->integer('goal')->default(0);
            $table->integer('selisih')->default(0);
            $table->unsignedTinyInteger('poin')->default(0);
            $table->unsignedTinyInteger('urutan')->default(0);
            $table->boolean('highlight')->default(false); // untuk baris biru Arema
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
