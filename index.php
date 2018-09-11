<?php

require_once './autoloader.php';

error_reporting(0);

Session::begin();

$request = filter_input(INPUT_SERVER, 'REQUEST_URI');
$request = substr($request, strlen(Config::PATH));

// Детектовање руте
$routes = require_once './routes.php';
$args = $foundRoute = null;
foreach ($routes as $route) {
	if (preg_match($route['Pattern'], $request, $args)) {
		$foundRoute = $route;
		unset($args[0]);
		$args = array_values($args);
		break;
	}
}

// Учитавање одговарајућег контролера
$controller = './app/controllers/' . $foundRoute['Controller'] . 'Controller.php';
if (!file_exists($controller)) {
	ob_clean();
	die('Controller error - file not found!');
}
require_once $controller;

// Инстанцирање класе контролера
$className = $foundRoute['Controller'] . 'Controller';
$worker = new $className;

// Опциони __pre метод
if (method_exists($worker, '__pre')) {
	call_user_func([$worker, '__pre']);
}

// Позивање одговарајуће методе контролера
if (!method_exists($worker, $foundRoute['Method'])) {
	ob_clean();
	die('Controller error - method not found!');
}

$methodName = $foundRoute['Method'];
call_user_func_array([$worker, $methodName], $args);

// Преузимање глобалних података
$DATA = $worker->getData();

// Учитавање одговарајућег шаблона приказа
$view = './app/views/' . $foundRoute['Controller'] . '/' . $foundRoute['Method'] . '.php';
if (!file_exists($view)) {
	ob_clean();
	die('View error - file not found!');
}
require_once $view;
