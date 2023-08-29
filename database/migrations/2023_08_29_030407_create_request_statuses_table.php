<?php

use App\Models\Requester\MilkRequest;
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
        Schema::create('request_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MilkRequest::class);
            $table->dateTime('pending_at');
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('assigned_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('confirmed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_statuses');
    }
};
