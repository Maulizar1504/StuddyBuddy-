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
        Schema::table('tasks', function (Blueprint $table) {
            // Tambahkan kolom deadline, bisa nullable jika tidak selalu ada deadline
            $table->timestamp('deadline')->nullable()->after('description');
            // Tambahkan kolom priority, dengan default 'plan'
            $table->string('priority')->default('plan')->after('deadline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('deadline');
            $table->dropColumn('priority');
        });
    }
};