<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_answers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->integer('amount')->default(0);
            $table->integer('order');
            $table->foreignId('vote_id')->constrained('votes')->onDelete('cascade');;
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
        Schema::table('vote_answers', function (Blueprint $table)
        {
            $table->dropConstrainedForeignId('vote_id');
        });
        Schema::dropIfExists('vote_answers');
    }
};
