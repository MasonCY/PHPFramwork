<?php
namespace App\Controllers\Admin;


class Users extends \Core\Controller{
  protected function before(){
    echo "this is User controller before";
  }
  protected function after(){
    echo "this is User controller after";


  }
  public  function indexAction(){
    echo "this is index action in users controller";
  }
}


?>