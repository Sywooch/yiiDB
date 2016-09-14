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

    public function actionCreate($db = false)
    {
        print_r($this->createOrDropTable($db));
    }

    public function actionDrop($db = false)
    {
        print_r($this->createOrDropTable($db, true));
    }

    public function createOrDropTable($db = false, $drop = false)
    {
        if(!$db)
            throw new yii\base\Exception('not fill db field');

        $data = array(
            'jsonrpc' => '2.0',
            'method'  => 'yii'
        );

        if($drop)
            $data['params'] =  ["migrate/create drop_" . $db . "_table"];
        else
            $data['params'] =  ["migrate/create create_" . $db . "_table"];

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