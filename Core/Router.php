<?php
namespace Core;

class Router{
  protected $routes = [];

  protected $params = [];

  public function add($route,$params = []){
      // $this->routes[$route] = $params;
      // convert the route to a regular expression: escape forward slashes
      $route = preg_replace('/\//','\\/',$route);

        // Convert variables e.g. {controller}
      $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

      //convert variables with custom regular expressions e.g. {id:\d+}
      $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
      // $route = preg_replace('/\{([a-z]+)\}/','(?P<\1>[a-z]+)',$route);
      $route = '/^'. $route . '$/i';

      $this->routes[$route] = $params;

  }

  public function getRoutes(){
    return $this->routes;
  }

  public function match($url){
      // foreach($this->routes as $route => $params){
      //   if($url == $route){
      //     $this->params = $params;
      //     return true;
      //   }

      // }
      // return false;
  
        // // $reg_exp = "/(?P<controller>^[a-z-]+)\/(?P<action>[a-z-]+)$/";
        // if(preg_match($reg_exp,$url,$matches)){
        //   $params = [];
        //   foreach($matches as $key => $match){
        //     if(is_string($key)){
        //       $params[$key] = $match;
        //     }
        //   }

        // }


        foreach($this->routes as $route=>$params){
        if(preg_match($route,$url,$matches)){
    
          foreach($matches as $key => $match){
            if(is_string($key)){
              $params[$key] = $match;
            }
          }
          $this->params = $params;
    
      
          return true;

        }
      }
     return false;

  }
  public function getParams(){
    return $this->params;
  }

  public function dispatch($url){
    $url = $this->removeQueryStringVarialbes($url);
    if($this->match($url)){
      $controller = $this->params['controller'];
      $controller = $this->convertToStudlyCaps($controller);
      // $controller = "App\Controllers\\$controller";
      $controller = $this->getNamespace() .$controller;

      if(class_exists($controller)){
        $controller_object = new $controller($this->params);
        $action = $this->params['action'];
        $action = $this->convertToCamelCase($action);
      
        // if(is_callable([$controller_object, $action])){
          if(preg_match('/action$/i', $action)==0){
         
          $controller_object->$action();
          
        }else{
          throw new  \Exception("Method $action in controller cannot be called please remove suffix stuff.");
        }
      
      }
      else{
        echo "Controller class $controller not found";
      }

    }else{
      echo  "No route matched.";
    }
  }
  protected function convertToStudlyCaps($string){
    return str_replace(' ','',ucwords(str_replace('-',' ',$string)));
  }
  protected function convertToCamelCase($string){
    return lcfirst($this->convertToStudlyCaps($string));
  }
  protected function removeQueryStringVarialbes($url){
    if($url !=''){
      $parts = explode('&',$url,2);
      if(strpos($parts[0], '=') === false){
        $url = $parts[0];
      }else{
        $url = '';
      }
    }
    return $url;
  }
  protected function getNamespace(){
    $namespace = 'App\Controllers\\';
    if(array_key_exists('namespace', $this->params)){
      $namespace .= $this->params['namespace'] .'\\';
      
    }
  
    return $namespace;

  }
}
?>