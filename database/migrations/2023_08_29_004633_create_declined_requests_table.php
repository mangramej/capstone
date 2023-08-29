<?php

use App\Models\Requester\MilkRequest;
use App\Models\User;
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
        Schema::create('declined_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MilkRequest::class);
            $table->foreignIdFor(User::class, 'declined_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declined_requests');
    }
};
