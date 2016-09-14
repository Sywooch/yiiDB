<?php

use yii\db\Migration;

/**
 * Handles the creation for table `test4`.
 */
class m160914_135609_create_test4_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test4', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test4');
    }
}
