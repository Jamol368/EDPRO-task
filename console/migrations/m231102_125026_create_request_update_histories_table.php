<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_update_histories}}`.
 */
class m231102_125026_create_request_update_histories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_update_histories}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'request_id' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-request_update_histories-user_id',
            'request_update_histories',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `requests`
        $this->addForeignKey(
            'fk-request_update_histories-request_id',
            'request_update_histories',
            'request_id',
            'requests',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-request_update_histories-user_id',
            'request_update_histories'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-request_update_histories-request_id',
            'request_update_histories'
        );

        $this->dropTable('{{%request_update_histories}}');
    }
}
