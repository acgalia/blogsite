<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->unsignedInteger('blog_id');
            $table->unsignedInteger('comment_id');
            $table->timestamps();

            //foreign keys
            $table->foreign('blog_id')
                  ->references('id')
                  ->on('blogs')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('comment_id')
                  ->references('id')
                  ->on('comments')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
}
