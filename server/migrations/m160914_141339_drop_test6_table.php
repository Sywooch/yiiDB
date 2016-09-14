<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `test6`.
 */
class m160914_141339_drop_test6_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('test6');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable('test6', [
            'id' => $this->primaryKey(),
        ]);
    }
}
