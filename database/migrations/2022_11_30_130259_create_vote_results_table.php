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
        Schema::create('vote_results', function (Blueprint $table) {
            $table->id();
            $table->integer('influence')->default(1);
            $table->foreignId('answer_id')->constrained('vote_answers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('vote_id')->constrained('votes')->onDelete('cascade');
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
        Schema::table('vote_results', function (Blueprint $table)
        {
            $table->dropConstrainedForeignId('answer_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('vote_id');
        });
        Schema::dropIfExists('vote_results');
    }
};
