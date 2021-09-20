<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%booked}}`.
 */
class m210920_031345_create_booked_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booked}}', [
            'id' => $this->primaryKey(),
            'booked' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%booked}}');
    }
}
