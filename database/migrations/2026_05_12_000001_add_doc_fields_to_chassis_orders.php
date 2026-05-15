<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chassis_orders', function (Blueprint $table) {
            $table->string('doc_type', 10)->nullable()->after('customer_phone');
            $table->string('doc_number', 100)->nullable()->after('doc_type');
        });
    }

    public function down(): void
    {
        Schema::table('chassis_orders', function (Blueprint $table) {
            $table->dropColumn(['doc_type', 'doc_number']);
        });
    }
};
