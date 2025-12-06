<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('size_chart_dewasa')->nullable()->after('size_chart');
            $table->text('size_chart_anak')->nullable()->after('size_chart_dewasa');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['size_chart_dewasa', 'size_chart_anak']);
        });
    }
};
