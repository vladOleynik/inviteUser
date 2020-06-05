<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->unsignedBigInteger('initiator_invite');
            $table->unsignedBigInteger('recipient_invite');
            //по умолчанию заявка создаеться не принятой, если она отменена она софт удаляется
            $table->boolean('accepted_invite')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('initiator_invite')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recipient_invite')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
