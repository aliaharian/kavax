<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('uid');
            $table->string('title');
            $table->string('slug');
            $table->string('status')->default('published');
            $table->string('location')->nullable();
            $table->string('salary')->nullable();
            $table->string('term')->nullable();
            $table->text('content_text');
            $table->bigInteger('thumbnail')->nullable();
            $table->json('career_meta')->nullable();
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
        Schema::dropIfExists('career');
    }
}
