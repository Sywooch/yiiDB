<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `test9`.
 */
class m160914_142331_drop_test9_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('test9');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable('test9', [
            'id' => $this->primaryKey(),
        ]);
    }
}
