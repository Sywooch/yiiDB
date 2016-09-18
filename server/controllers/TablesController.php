<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\Migration;
use yii;

class TablesController extends Controller
{

    public function actionAll()
    {
        print_r(json_encode($this->getTables()));
    }

    public function actionGet($name = false)
    {
        if(!$name)
            throw new yii\base\Exception("not fill name field");
        $sql = "DESCRIBE " . $name;
        $m = Yii::$app->db->createCommand($sql)->queryAll();
        print_r(json_encode($m));
    }


    public function actionTest()
    {
       print_r(Migration::executeCommand("migrate"));
    }

    public function actionCreate($name = false)
    {
        if(!$name)
            throw new yii\base\Exception('not fill name field');

        $tables = $this->getTables();
        foreach ($tables as $row){
            if($row['table'] == $name){
                throw new yii\base\Exception("db name is busy");
            }
        }
        //print_r($this->createOrDropTable($name));
        print_r(Migration::executeCommand("migrate/create create_" . $name . "_table"));
        print_r(Migration::executeCommand("migrate"));
    }

    public function actionDrop($name = false)
    {
        if(!$name)
            throw new yii\base\Exception('not fill name field');
        print_r(Migration::executeCommand("migrate/create drop_" . $name . "_table"));
        print_r(Migration::executeCommand("migrate"));
    }

    private function getTables(){
        $sql = "SHOW TABLES";
        $query = Yii::$app->db->createCommand($sql)->queryColumn();
        $response = [];
        foreach ($query as $i => $item)
        {
            $response[$i]["table"] = $item;
        }
        return $response;
    }
}