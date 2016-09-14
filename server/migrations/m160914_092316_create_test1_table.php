<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test1`.
 */
class m160914_092316_create_test1_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test1', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test1');
    }
}
