<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requester_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->boolean('status')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->string('selfie_path')->nullable();
            $table->string('birth_cert_path')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_path')->nullable();
            $table->string('medical_record_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requester_verifications');
    }
};
