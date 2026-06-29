<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table->string('external_id')->nullable()->after('id');
            $table->string('category')->nullable()->after('division');
            $table->unsignedInteger('wins')->nullable()->after('record');
            $table->unsignedInteger('losses')->nullable()->after('wins');
            $table->unsignedInteger('draws')->nullable()->after('losses');
            $table->string('status')->nullable()->after('draws');
            $table->string('img_url')->nullable()->after('status');
            $table->timestamp('api_synced_at')->nullable()->after('img_url');

            $table->unique('external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fighters', function (Blueprint $table) {
            $table->dropUnique(['external_id']);

            $table->dropColumn([
                'external_id',
                'category',
                'wins',
                'losses',
                'draws',
                'status',
                'img_url',
                'api_synced_at',
            ]);
        });
    }
};
