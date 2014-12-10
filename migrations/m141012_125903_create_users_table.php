<?php

use yii\db\Schema;
use yii\db\Migration;

class m141012_125903_create_users_table extends Migration
{
    public function up()
    {
        $this->createTable('users', [
            'id' => 'pk',
            'steamid' => Schema::TYPE_STRING,
            'personaname' => Schema::TYPE_STRING,
            'profileurl' => Schema::TYPE_STRING,
            'avatarfull' => Schema::TYPE_STRING,
        ]);
    }

    public function down()
    {
        $this->dropTable('users');
    }
}
