<?php

class Wallet{
    public $balance;
    public function __construct($money){
        $this->balance = $money;
    }
    public function getBalance(){
        return $this->balance;
    }
    public function setBalance($value){
        $this->balance = $value;
    }
}
class MyThread extends Thread{
    private $wallet;
    private $std;
    public function __construct($wallet,$std){
        $this->wallet = $wallet;
        $this->std = $std;
    }
    public function run(){
        $this->synchronized(function($thread){
                $hack = $this->wallet;
                if($hack->getBalance() - 80 >0){
                    sleep(1);
                    $hack->setBalance($hack->getBalance() - 80);
                    echo $this->getThreadId() . "reduce 80 successful<br/>Current num is：" . $hack->getBalance() . "<Br/>";
                    //Here is Wrong!  The result is bool(false)????!!!!
                    var_dump($hack == $this->wallet);
                }
                 else
                     echo $this->getThreadId() . "reduce fail<br/>Current num is：" . $hack->getBalance() . "<br/>";
           
        },$this->std);
    }
}
$wallet = new Wallet(200);
$std = new stdClass();
for($x=0;$x<3;$x++){
    $pool[] = new MyThread($wallet,$std);
    $pool[$x]->start();
}