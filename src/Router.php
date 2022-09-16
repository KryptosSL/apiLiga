<?php
 require_once("Controller/ProdutoCtrl.php");
 require_once("Controller/PageCtrl.php");
 require_once("Controller/Auth.php");
function load(string $controller, string $action)
{
    try {
        $controllerInstance = new $controller();
        $controllerInstance->$action((object) $_REQUEST);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

$router = [
  "GET" => [
    "/api/produtos" => fn () => load("ProdutoCtrl", "consulta"),
    "/consulta" => fn () => load("PageCtrl", "consulta"),
    "/novoToken" => fn () => load("Auth", "geraToken"),
    "/validaSessao" => fn () => load("Auth", "validaSessao"),
    "/limpasesao" => fn () => load("Auth", "token")
  ],
  "POST" => [
    "/verificaToken" => fn () => load("Auth", "verificatoken"),
  ],
];
?>