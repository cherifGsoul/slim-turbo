<?php

use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/../vendor/autoload.php';

$container = new Container();

AppFactory::setContainer($container);


$container->set('view', function() {
	return Twig::create(dirname(__DIR__) . '/templates', ['cache' => dirname(__DIR__) . '/var/cache/templates']);
	//return Twig::create(dirname(__DIR__) . '/templates', ['cache' => false]);
});

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
	return $this->get('view')->render($response, 'home.twig');
});

$app->get('/about', function (Request $request, Response $response, $args) {
	return $this->get('view')->render($response, 'about.twig');
});

$app->get('/contact', function (Request $request, Response $response, $args) {
	return $this->get('view')->render($response, 'contact.twig');
});

$app->run();