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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
			$table->dateTime('start_time');
			$table->dateTime('end_time');
            $table->timestamps();

			$table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
			$table->foreignId('resource_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
			$table->unique('resource_id');
			$table->index(['start_time', 'end_time', 'resource_id', 'user_id',]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
