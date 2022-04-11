<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('email', 20)->after('nama');
            $table->string('alamat', 30)->after('email');
            $table->date('tgl_lahir')->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('email', 20)->after('nama');
            $table->dropColumn('alamat', 30)->after('email');
            $table->dropColumn('tgl_lahir')->after('alamat');
        });
    }
}
