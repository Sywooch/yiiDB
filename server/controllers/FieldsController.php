<?php

namespace app\controllers;
use yii\web\Controller;
use app\models\Migration;
use yii;

class FieldsController extends Controller
{

    public function actionGet($table= false)
    {
        print_r(json_encode($this->getFields($table)));
    }

    public function actionMigrate($data = null, $table = null)
    {
        $data = json_decode($data);
        //print_r($data);
        $req = '';
        foreach ($data as $d)
        {
            $req = (!$req ? $req : ($req . ',')) . $d->Field . ':' . $d->Type . '(' . $d->Length . ')';
        }
        print_r(Migration::executeCommand('migrate/create add_' . $data[0]->Field . '_column_to_' . $table . '_table --fields=' . $req));
        print_r(Migration::executeCommand("migrate"));
    }

    public function actionCreate($table = false, $field = false)
    {
        if(!$field || !$table)
            throw new yii\base\Exception('not fill name field');
        $fields = $this->getFields($table);
        foreach ($fields as $f){
            if($field == $f){
                throw new yii\base\Exception("field name is busy");
            }
        }
        //print_r($this->createOrDropTable($name));
        print_r(Migration::executeCommand('migrate/create add_' . $field . '_column_to_' . $table . '_table --fields="' . $field . ':integer(50),title:string(12)"'));
        print_r(Migration::executeCommand("migrate"));
    }

    public function actionDrop($name = false)
    {
        if(!$name)
            throw new yii\base\Exception('not fill name field');
        print_r(Migration::executeCommand("migrate/create drop_" . $name . "_table"));
        print_r(Migration::executeCommand("migrate"));
    }

    private function getFields($table){
        if(!$table)
            throw new yii\base\Exception("not fill name field");
        $sql = "DESCRIBE " . $table;
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($res as $i => $row)
        {
            $res[$i]['Length'] = explode(')', explode('(', $row['Type'])[1])[0];
            $res[$i]['Type'] = explode('(', $row['Type'])[0];
        }
        return $res;
    }
}