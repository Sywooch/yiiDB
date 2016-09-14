<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test5`.
 */
class m160914_140355_create_test5_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test5', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test5');
    }
}
