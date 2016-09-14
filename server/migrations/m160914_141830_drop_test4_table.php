<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `test4`.
 */
class m160914_141830_drop_test4_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('test4');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->createTable('test4', [
            'id' => $this->primaryKey(),
        ]);
    }
}
