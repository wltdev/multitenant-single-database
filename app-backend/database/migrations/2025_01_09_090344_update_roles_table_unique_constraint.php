<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Remove a restrição única existente do campo name e guard_name
            $table->dropUnique(['name', 'guard_name']);

            // Adiciona uma nova restrição única composta por name, guard_name e tenant_id
            $table->unique(['name', 'guard_name', 'tenant_id']);
        });
    }

    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            // Remove a restrição única composta
            $table->dropUnique(['name', 'guard_name', 'tenant_id']);

            // Restaura a restrição única original
            $table->unique(['name', 'guard_name']);
        });
    }
};
