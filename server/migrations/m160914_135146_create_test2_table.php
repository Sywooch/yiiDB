<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test2`.
 */
class m160914_135146_create_test2_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test2', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test2');
    }
}
