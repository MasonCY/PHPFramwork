<?php
  // $url = $_SERVER['QUERY_STRING'];
  // $u='http://';
  // $u .= $_SERVER['REQUEST_URL'];
  

  /**
   * Routing
   */
  // require '../Core/Router.php';
  // require '../App/Controllers/Posts.php';

  /**
   * Twig
   */

/***
 * 
 * Autoloader
 */
spl_autoload_register(function ($class){

  $root = dirname(__DIR__); // get the parent directory
  $file = $root.'/'.str_replace('\\','/',$class).'.php';
  if(is_readable($file)){
    require $file;
  }
});


  $router = new Core\Router();

  // add the routes
  $router->add('',['controller' => 'Home', 'action' => 'index']);
  $router->add('posts',['controller' => 'Posts', 'action' => 'index']);
  // $router->add('posts/new',['controller' => 'Home', 'action' => 'new']);
  // var_dump($router->getRoutes());
  $router->add('{controller}/{action}');
  $router->add('admin/{controller}/{action}',['namespace' => 'Admin']);
  $router->add('{controller}/{id:\d+}/{action}');

  $url= $_SERVER["QUERY_STRING"];

  // // var_dump($url);
  // var_dump($router);
  // if($router->match($url)){
  //   var_dump($router->getParams());
  // }else{
  //   echo "No router found for URL '$url'";
  // }
  $router->dispatch($url);


?>