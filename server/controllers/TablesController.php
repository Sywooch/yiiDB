<?php

namespace app\controllers;
use yii\web\Controller;
use yii;

class TablesController extends Controller
{

    public function actionAll()
    {
        $sql = 'SHOW TABLES';
        $m = Yii::$app->db->createCommand($sql)->queryColumn();
        print_r(json_encode($m));
    }

    public function actionGet($db = false)
    {
        if(!$db)
            throw new yii\base\Exception('not fill db field');
        $sql = 'DESCRIBE ' . $db;
        $m = Yii::$app->db->createCommand($sql)->queryAll();
        print_r(json_encode($m));
    }

    public function actionCreate()
    {
        $sql = 'CREATE TABLE pet2 (name VARCHAR(20))';
        $m = Yii::$app->db->createCommand($sql)->queryAll();
        echo '<pre>';
        //print_r($m);
    }

}