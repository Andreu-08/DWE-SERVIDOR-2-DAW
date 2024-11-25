<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRoleToRoleIdInUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina la columna actual 'role' si existe
            $table->dropColumn('role');

            // Agrega la nueva columna 'role_id' y establece la relación
            $table->unsignedBigInteger('role_id')->after('email')->default(2); // Por defecto, rol de usuario normal
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina la clave foránea y la columna 'role_id'
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');

            // Restaura la columna 'role' como estaba antes
            $table->integer('role')->default(2);
        });
    }
}

