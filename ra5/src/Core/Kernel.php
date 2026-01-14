<?php
namespace App\Core;

use App\Infrastructure\Request;
use App\Logger; // si no fuera trait lo pondriamos asi

class Kernel{
    //use App\Logger; // asi se implementa un trait
    private Request $request;

    public function __construct(Request $request){
        $this->setRequest($request);
        echo "Soy el kernel";
    }
    public function __destruct(){
        Logger::log('kernel off');
    }
    private function setRequest(Request $request){
        $this->request = $request;
    }
    private function getRequest(){
        return $this->request;
    }
}