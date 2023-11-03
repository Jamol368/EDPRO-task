<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%requests}}`.
 */
class m231102_124311_create_requests_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%requests}}', [
            'id' => $this->primaryKey(),
            'client_name' => $this->string()->notNull(),
            'request_name' => $this->string()->notNull(),
            'product' => $this->tinyInteger()->notNull(),
            'phone' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'status' => $this->tinyInteger()->defaultValue(1),
            'comment' => $this->text(),
            'price' => $this->float(2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%requests}}');
    }
}
