<?php
namespace App\Controllers;
class Posts extends \Core\Controller{
  public function indexAction(){
    echo '<p>Query string parameters:<pre>'. htmlspecialchars(print_r($_GET,true)). '</pre></p>';
    echo "Hello from the index action in posts controller.";
    echo '<p>Query string parameters:<pre>'. htmlspecialchars(print_r($_GET,true)). '</pre></p>';
  }
  public function addNewAction(){
    echo 'Hello from the addNew action in the posts controller';
  }

  protected function before(){
    echo " (before)";
    return false;
  }
  protected function after(){
    echo "(after)";
  }
}

?>