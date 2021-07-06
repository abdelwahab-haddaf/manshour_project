<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->foreignId('sub_category_id_1');
            $table->foreignId('sub_category_id_2')->nullable();
            $table->foreignId('city_id');
            $table->string('title');
            $table->longText('content');
            $table->string('contact')->nullable();
            $table->boolean('hide_contact')->default(true);
            $table->string('price')->nullable();
            $table->string('sell_price')->nullable();
            $table->tinyInteger('sell_type')->nullable();
            $table->string('delete_reason')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
