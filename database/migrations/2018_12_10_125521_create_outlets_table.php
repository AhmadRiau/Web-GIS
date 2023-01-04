<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('address')->nullable();
            $table->string('pemilik')->nullable();
            $table->string('kontak_pemilik')->nullable();

            $table->string('tipe_kos')->nullable();
            $table->string('harga_sewa')->nullable();
            $table->string('fasilitas')->nullable();
            $table->string('sisa_kamar')->nullable();

            $table->string('latitude', 15)->nullable();
            $table->string('longitude', 15)->nullable();

            $table->string('name_foto_kos')->nullable()->default(null);
            $table->string('mime_foto_kos')->nullable()->default(null);

            $table->unsignedInteger('creator_id');
            $table->timestamps();

            $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
        });
        DB::statement("ALTER TABLE outlets ADD file_foto_kos BLOB");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlets');
    }
}
