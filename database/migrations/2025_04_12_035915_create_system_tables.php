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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Admin', 'Customer', 'Merchant']);
            $table->string('perusahaan', 60)->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon', 15)->nullable();
            $table->string('foto')->nullable();
            $table->text('deskripsi')->nullable();
        });
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->timestamps();
        });
        Schema::create('kategori_relasi', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kategori');
            $table->integer('id_menu');
            $table->timestamps();
        });
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nama');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->string('telepon');
            $table->timestamps();
        });
        Schema::create('foto', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produk');
            $table->string('path');
            $table->timestamps();
        });
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_menu');
            $table->integer('jumlah');
            $table->string('lokasi');
            $table->date('tanggal');
            $table->string('status', 24);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('perusahaan');
            $table->dropColumn('alamat');
            $table->dropColumn('telepon');
            $table->dropColumn('foto');
            $table->dropColumn('deskripsi');
        });
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('kategori_relasi');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('foto');
        Schema::dropIfExists('pesanan');
    }
};
