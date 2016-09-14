<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test6`.
 */
class m160914_141328_create_test6_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test6', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test6');
    }
}
