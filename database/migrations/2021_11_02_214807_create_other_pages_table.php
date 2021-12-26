<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('uid');
            $table->string('title');
            $table->string('slug');
            $table->string('heading_text')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('content_text');
            $table->bigInteger('thumbnail')->nullable();
            $table->string('status')->default('published');
            $table->string('template')->nullable();
            $table->json('page_meta')->nullable();
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
        Schema::dropIfExists('other_pages');
    }
}
