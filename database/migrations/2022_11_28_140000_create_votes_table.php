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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('session_id')->constrained('sessions')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('vote_types');
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
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropConstrainedForeignId('session_id');
            $table->dropConstrainedForeignId('type_id');
        });
        Schema::dropIfExists('users');
    }
};
