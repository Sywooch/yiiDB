<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `test2`.
 */
class m160914_141403_drop_test2_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('test2');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable('test2', [
            'id' => $this->primaryKey(),
        ]);
    }
}
