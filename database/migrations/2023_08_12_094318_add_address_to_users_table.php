<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('street')->nullable();
            $table->string('barangay_id', 9)->nullable()->index();
            $table->string('city_id', 6)->nullable()->index();
            $table->string('province_id', 4)->nullable()->index();
            $table->string('region_id', 2)->nullable()->index();
            $table->string('zip_code')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'street',
                'barangay_id',
                'city_id',
                'province_id',
                'region_id',
                'zip_code',
            ]);
        });
    }
};
