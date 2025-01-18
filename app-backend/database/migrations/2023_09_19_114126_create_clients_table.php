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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->uuid('tenant_id');
            $table->foreignId('address_id')->nullable()->constrained('addresses');

            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            // person
            $table->string('person_number')->comment('rg')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->string('profession')->nullable();

            // company
            $table->string('trading_name')->nullable();
            $table->string('business_number')->comment('cnpj')->nullable();
            $table->string('state_registration')->nullable();
            $table->string('city_registration')->nullable();
            $table->string('suframa')->nullable();
            $table->boolean('icms_contributor')->default(0);

            $table->enum('type', ['individual', 'legal_entity'])->default('individual');
            $table->boolean('active')->default(1);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
