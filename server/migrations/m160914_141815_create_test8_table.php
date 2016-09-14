<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test8`.
 */
class m160914_141815_create_test8_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test8', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test8');
    }
}
