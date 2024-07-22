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
        Schema::create('notification_history', function (Blueprint $table) {
            $table->uuid();
            $table->foreignUlid('contact_id');
            $table->string('notification');
            $table->string('channel');
            $table->timestamps();
        });

        Schema::table('notification_history', function (Blueprint $table) {
            $table->index(['notification', 'channel']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_history');
    }
};
