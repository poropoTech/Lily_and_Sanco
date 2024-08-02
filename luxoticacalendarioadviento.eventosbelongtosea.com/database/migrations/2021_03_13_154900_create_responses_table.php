<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Common\Models\Comment;
use App\Domains\Responses\Models\Response;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('type_id')->default(Response::TYPE_CLICK);
            $table->string('challenge')->nullable();
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('ext_content')->nullable();
            $table->string('ext_content_type')->nullable();
            $table->unsignedBigInteger('verifier_id')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->boolean('published')->default(true);
            $table->unsignedInteger('comments_mode_id')->default(Comment::COMMENTS_OPEN_FREE);
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verifier_id')->references('id')->on('users')->onDelete('cascade');

        });


        Schema::create('views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('views');
        Schema::dropIfExists('responses');
    }
}
