<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test3`.
 */
class m160914_135553_create_test3_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test3', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test3');
    }
}
