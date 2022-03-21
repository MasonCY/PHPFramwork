<?php
namespace App\Controllers;
use \Core\View;
use PDO;
use PDOException;

class Home extends \Core\Controller{

  public function indexAction(){
    // echo 'Hello from the index action in the home controller.';
    $servername='192.168.64.4';
    $username = 'mason';
    $password = '123456';
    try{
    $db = new PDO('mysql:host=192.168.64.4;dbname=BigM_s5199894_s5248446',$username,$password);
     $sql = "select * from EMPLOYEE";
     $results = $db->query($sql)->fetch();
     var_dump($results);

    }catch(PDOException $e){
      echo "Connection failed: ". $e->getMessage();
    }
    // View::render("Home/index.php", ['name' => 'Dave',
    //                                 'colours' => ['red','green','blue']]);
     View::render("Home/index.php", $results);
  }
  protected function before(){
    // echo " (before)";
    // return false;
  }
  protected function after(){
    // echo "(after)";
  }

}






?>