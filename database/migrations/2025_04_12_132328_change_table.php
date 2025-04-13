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
        Schema::table('menu', function (Blueprint $table) {
            $table->dropColumn('telepon');
            $table->text('deskripsi')->nullable()->change();
        });
        Schema::table('foto', function (Blueprint $table) {
            $table->dropColumn('id_produk');
            $table->integer('id_menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->string('telepon', 15)->nullable();
            $table->text('deskripsi')->change();
        });
        Schema::table('foto', function (Blueprint $table) {
            $table->dropColumn('id_menu');
            $table->integer('id_produk');
        });
    }
};
