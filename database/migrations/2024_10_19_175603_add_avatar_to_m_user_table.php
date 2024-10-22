<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_avatar_to_m_user_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvatarToMUserTable extends Migration
{
    public function up()
    {
        Schema::table('m_user', function (Blueprint $table) {
            $table->string('avatar')->nullable(); // Tambahkan kolom avatar
        });
    }

    public function down()
    {
        Schema::table('m_user', function (Blueprint $table) {
            $table->dropColumn('avatar');
        });
    }
}
