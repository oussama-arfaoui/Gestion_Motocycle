<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chassis_orders', function (Blueprint $table) {
            $table->longText('signature')->nullable()->after('comment');
            $table->timestamp('signed_at')->nullable()->after('signature');
            $table->unsignedBigInteger('signed_by')->nullable()->after('signed_at');
        });
    }

    public function down(): void
    {
        Schema::table('chassis_orders', function (Blueprint $table) {
            $table->dropColumn(['signature', 'signed_at', 'signed_by']);
        });
    }
};
