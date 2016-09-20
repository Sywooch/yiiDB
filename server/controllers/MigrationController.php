<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\Migration;
use yii;

class MigrationController extends Controller
{

    public function actionAll($table= false)
    {
        $sql = "Select * from migration";
        $query = Yii::$app->db->createCommand($sql)->queryAll();
        print_r(json_encode($query));
    }

    public function actionApply($name = false)
    {
        if(!$name)
            throw new yii\base\Exception('not fill name field');
        
        print_r(Migration::executeCommand("migrate/to " . $name . " --interactive=0"));
    }
}