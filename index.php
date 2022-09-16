<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   require_once("src/Controller/Auth.php" );
   require_once("src/Router.php" );


    try {
      $uri = parse_url($_SERVER["REQUEST_URI"])["path"];
      $request = $_SERVER["REQUEST_METHOD"];
    
      if (!isset($router[$request])) {
        exit("A rota não existe");
      }
    
      if (!array_key_exists($uri, $router[$request])) {
        exit("A rota não existe");
      }
    
      $controller = $router[$request][$uri];
      $controller();
    } catch (Exception $e) {
      $e->getMessage();
    }



?>