<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Responses\Models\Response;

class StructureTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_lang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('lang');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('activities_lang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_id');
            $table->string('lang');
            $table->string('title')->nullable();
            $table->text('card_content')->nullable();
            $table->longText('intro_content')->nullable();
            $table->longText('individual_content')->nullable();
            $table->longText('collective_content')->nullable();
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities_lang');
        Schema::dropIfExists('categories_lang');
    }
}
