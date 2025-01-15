<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTenantIdToAllTables extends Migration
{
    private $tables = [
        'users',
        'companies',
        'clients',
        'projects',
        'project_comments',
        'project_files',
        'project_members',
        'kanban_boards',
        'kanban_board_columns',
        'leads',
        'lead_participants',
        'lead_status_history',
        'lead_notes',
        'media'
    ];

    public function up()
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (!Schema::hasColumn($tableName, 'tenant_id')) {
                    $table->foreignId('tenant_id')->after('id')->constrained('tenants')->onDelete('cascade');
                }
            });
        }
    }

    public function down()
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if (Schema::hasColumn($tableName, 'tenant_id')) {
                    $table->dropForeign(['tenant_id']);
                    $table->dropColumn('tenant_id');
                }
            });
        }
    }
}
