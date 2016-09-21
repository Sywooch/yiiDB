<?php
namespace app\models;

use Yii;

/**
 * Created by PhpStorm.
 * User: lapsh
 * Date: 16.09.2016
 * Time: 20:36
 */
class Migration
{
    public static function executeCommand($cmd = null)
    {
        $data = array(
            'jsonrpc' => '2.0',
            'method'  => 'yii'
        );

        $data['params'] =  [$cmd . " --interactive=0"]; //режим без подтверждения (yes|no)

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