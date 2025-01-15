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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid('tenant_id');
            $table->string('name')->comment('razão social');
            $table->string('trading_name')->nullable()->comment('nome fantasia');

            $table->string('identification_name')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();

            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('email')->nullable();
            $table->string('site')->nullable();

            $table->string('cnae')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('state_registration')->nullable();
            $table->string('state_registration_tax_replacement')->nullable();
            $table->string('city_registration')->nullable();
            $table->string('suframa')->nullable();

            $table->boolean('headquarter')->comment('matriz')->default(false);
            $table->string('status')->default('active');
            $table->string('plan_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
