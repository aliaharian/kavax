<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('service_level')->default('parent');
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('portfolio_id')->nullable();
            $table->bigInteger('uid');
            $table->string('status')->default('publish');
            $table->text('content_text')->nullable();
            $table->text('excerpt')->nullable();
            $table->json('service_includes')->nullable();
            $table->json('technology_list')->nullable();
            $table->bigInteger('thumbnail')->nullable();
            $table->json('service_meta')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
