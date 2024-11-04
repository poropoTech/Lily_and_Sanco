<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Responses\Models\Response;

class CreateStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->longText('content');
            $table->integer('order')->default(0);
            $table->boolean('published')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('card_content');
            $table->longText('intro_content');
            $table->longText('individual_content');
            $table->unsignedInteger('individual_type_id')->default(Response::TYPES['CLICK']['id']);
            $table->longText('collective_content');
            $table->unsignedInteger('collective_type_id')->default(Response::TYPES['T_I']['id']);
            $table->integer('order')->default(0);
            $table->boolean('published')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
        Schema::dropIfExists('categories');
    }
}
