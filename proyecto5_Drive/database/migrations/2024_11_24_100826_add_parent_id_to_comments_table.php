<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable(); // Campo opcional para comentarios padre
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade'); // Llave foránea recursiva
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['parent_id']); // Eliminar la relación
            $table->dropColumn('parent_id');    // Eliminar la columna
        });
    }
}
