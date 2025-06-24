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
        Schema::create('packets', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('owner');
            $table->string('comments')->nullable();
            $table->string('received_at');
            $table->string('received_by');
            $table->string('day');
            $table->string('month');
            $table->string('status');
            $table->string('image');
            $table->string('withdrawn_at')->nullable();
            $table->string('withdrawn_by')->nullable();
            $table->string('signature')->nullable();
            $table->timestamps();

            //$table->foreign('unit')->references('id')->on('units')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packets');
    }
};
