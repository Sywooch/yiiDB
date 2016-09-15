<?php

namespace app\controllers;
use yii\web\Controller;
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
            throw new yii\base\Exception('not fill name field');
        $sql = 'DESCRIBE ' . $name;
        $m = Yii::$app->db->createCommand($sql)->queryAll();
        print_r(json_encode($m));
    }

    public function actionCreate($name = false)
    {
        $tables = $this->getTables();
        foreach ($tables as $row){
            if($row['table'] == $name){
                throw new yii\base\Exception('db name is busy');
            }
        }
        print_r($this->createOrDropTable($name));
    }

    public function actionDrop($name = false)
    {
        print_r($this->createOrDropTable($name, true));
    }

    private function getTables(){
        $sql = 'SHOW TABLES';
        $query = Yii::$app->db->createCommand($sql)->queryColumn();
        $response = [];
        foreach ($query as $i => $item)
        {
            $response[$i]['table'] = $item;
        }
        return $response;
    }

    private function createOrDropTable($name = false, $drop = false)
    {
        if(!$name)
            throw new yii\base\Exception('not fill name field');

        $data = array(
            'jsonrpc' => '2.0',
            'method'  => 'yii'
        );

        if($drop)
            $data['params'] =  ["migrate/create drop_" . $name . "_table"];
        else
            $data['params'] =  ["migrate/create create_" . $name . "_table"];

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
            )
        );
        $context  = stream_context_create( $options );
        file_get_contents('http://' . $_SERVER["HTTP_HOST"] . '/webshell/default/rpc', false, $context );

        $data = array(
            'jsonrpc' => '2.0',
            'method'  => 'yii',
            'params'  =>  ["migrate"]
        );
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'content' => json_encode( $data ),
                'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
            )
        );
        $context  = stream_context_create( $options );
        $result = file_get_contents('http://' . $_SERVER["HTTP_HOST"] . '/webshell/default/rpc', false, $context );

        $response = json_decode( $result );
        return $response;
    }

}