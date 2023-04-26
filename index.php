<?php

use App\Aula;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $Aula = new Aula();
    echo $Aula->extrairInformacoes();
    return $response;
});
$app->setBasePath('/ams/ams');
$app->run();