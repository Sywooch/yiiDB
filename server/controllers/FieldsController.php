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
        $toDelete = [];
        $fields = $this->getFields($table);
        foreach ($fields as $i)
        {
            $match = false;
            foreach ($data as $key => $j)
            {
                if($i['Field'] == $j->Field){
                    if($j->Type == $i['Type'] && $j->Length == $i['Length']){
                        $match = true;
                        unset($data[$key]);
                    }
                }

            }
            if(!$match)
                array_push($toDelete, $i);
        }
        echo('!!!!!!!!!!!!!!');
        print_r($toDelete);
        print_r($data);
        if(count($toDelete)){ // Сначала создать миграцию на удаление
            $exec = '';
            foreach ($toDelete as $d)
            {
                $length = $d['Length'] ? '(' . $d['Length'] . ')' : ''; //(30) или ничего
                $exec = (!$exec ? $exec : ($exec . ',')) . $d['Field'] . ':' . $d['Type'] . $length;
            }
            echo $exec;
            print_r(Migration::executeCommand('migrate/create drop_' . $toDelete[0]['Field'] . '_column_from_' . $table . '_table --fields=' . $exec));
            sleep(2);
        }
        if(count($data)){ //миграция на добавление столбцов
            $exec = '';
            $index = null;
            foreach ($data as $i => $d)
            {
                $index = $i;
                if($d->Field != 'id')
                    $exec = (!$exec ? $exec : ($exec . ',')) . $d->Field . ':' . $d->Type . '(' . $d->Length . ')';
            }
            echo $exec;
            print_r(Migration::executeCommand('migrate/create add_' . $data[$index]->Field . '_column_to_' . $table . '_table --fields=' . $exec));
            print_r(Migration::executeCommand("migrate"));
        }
//        print_r(Migration::executeCommand('migrate/create add_' . $data[0]->Field . '_column_to_' . $table . '_table --fields=' . $exec));
//        print_r(Migration::executeCommand("migrate"));
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
        $sql = "DESCRIBE `" . $table . "`";
        $res = Yii::$app->db->createCommand($sql)->queryAll();
        foreach ($res as $i => $row)
        {
            $res[$i]['Length'] =  isset(explode('(', $row['Type'])[1]) ? explode(')', explode('(', $row['Type'])[1])[0] : 0;
            $res[$i]['Type'] = explode('(', $row['Type'])[0];
            switch ($res[$i]['Type']){
                case 'int' : $res[$i]['Type'] = 'integer'; break;
                case 'varchar' : $res[$i]['Type'] = 'string'; break;
            }
        }
        return $res;
    }
}