<?php

use App\Models\ProviderApplication;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provider_application_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProviderApplication::class);
            $table->string('name');
            $table->string('file_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provider_application_attachments');
    }
};
