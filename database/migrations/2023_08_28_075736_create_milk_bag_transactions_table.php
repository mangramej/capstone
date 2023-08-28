<?php

use App\Models\Champion\ChampionProvider;
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
        Schema::create('milk_bag_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ChampionProvider::class, 'owner_id');
            $table->string('type');
            $table->integer('quantity');
            $table->string('milk_request_ref_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_bag_transactions');
    }
};
