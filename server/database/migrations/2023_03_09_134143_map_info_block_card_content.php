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
        Schema::create('map_info_block_card_contents', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->unsignedBigInteger('mapInfoBlock_id')->default(1);
            $table->foreign('mapInfoBlock_id')->references('id')->on('map_info_blocks')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
