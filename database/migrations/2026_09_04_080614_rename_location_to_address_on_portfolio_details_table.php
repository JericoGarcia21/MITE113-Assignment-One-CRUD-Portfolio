<?php

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
        if (! Schema::hasColumn('portfolio_details', 'location')) {
            return;
        }

        Schema::table('portfolio_details', function (Blueprint $table) {
            $table->renameColumn('location', 'address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('portfolio_details', 'address')) {
            return;
        }

        Schema::table('portfolio_details', function (Blueprint $table) {
            $table->renameColumn('address', 'location');
        });
    }
};
