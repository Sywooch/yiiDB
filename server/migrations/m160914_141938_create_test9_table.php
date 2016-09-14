<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test9`.
 */
class m160914_141938_create_test9_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test9', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test9');
    }
}
