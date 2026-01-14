<?php
namespace App;

trait Logger{
    public static function log(string $message){
        $message = $message.date('Y-m-d H:i:s') ."\n";
        $filename = LOGS."/log.txt";
        if (!file_exists($filename)){
            fopen($filename,"w");
        }
        file_put_contents($filename, $message);
    }
}
