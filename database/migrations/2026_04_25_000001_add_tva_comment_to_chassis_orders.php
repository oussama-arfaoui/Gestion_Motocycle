<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('chassis_orders', function (Blueprint $table) {
            $table->decimal('tva', 5, 2)->default(0)->after('discount');
            $table->text('comment')->nullable()->after('notes');
        });
    }

    public function down(): void
    {
        Schema::table('chassis_orders', function (Blueprint $table) {
            $table->dropColumn(['tva', 'comment']);
        });
    }
};
