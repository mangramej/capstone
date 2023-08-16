<?php

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
        Schema::create('milk_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'requester_id');
            $table->foreignIdFor(User::class, 'accepted_by')->nullable();
            $table->foreignIdFor(User::class, 'provided_by')->nullable();
            $table->string('mother_name');
            $table->string('baby_name');
            $table->integer('quantity');
            $table->longText('address');
            $table->string('phone_number');
//            $table->string('image_id');
            $table->longText('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milk_requests');
    }
};
