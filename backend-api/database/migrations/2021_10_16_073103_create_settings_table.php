<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('faviconImage')->default('https://vuejs.org/images/logo.svg');
            $table->string('title');
            $table->string('logo')->default('https://vuejs.org/images/logo.svg');
            $table->longText('aboutUs')->nullable();
            $table->longText('contactUs')->nullable();
            $table->longText('privacyPolicy')->nullable();
            $table->longText('copyrightText')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
