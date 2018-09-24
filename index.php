<?php

require_once './sys/autoloader.php';

error_reporting(0);

Session::begin();

// Обрада захтева
$request = Http::getRequest();

// Детектовање руте
$routes = require_once './routes.php';
$args = $foundRoute = null;
foreach ($routes as $route) {
	if (preg_match($route->getPattern(), $request, $args)) {
		$foundRoute = $route;
		unset($args[0]);
		$args = array_values($args);
		break;
	}
}

// Учитавање одговарајућег контролера
$controller = './app/controllers/' . $foundRoute->getController() . 'Controller.php';
if (!file_exists($controller)) {
	ob_clean();
	die('Controller error - file not found!');
}
require_once $controller;

// Инстанцирање класе контролера
$className = $foundRoute->getController() . 'Controller';
$worker = new $className;

// Опциони __pre метод
if (method_exists($worker, '__pre')) {
	call_user_func([$worker, '__pre']);
}

// Позивање одговарајуће методе контролера
if (!method_exists($worker, $foundRoute->getMethod())) {
	ob_clean();
	die('Controller error - method not found!');
}

$methodName = $foundRoute->getMethod();
call_user_func_array([$worker, $methodName], $args);

// Преузимање глобалних података
$DATA = $worker->getData();

// API одговор
if ($worker instanceof ApiController) {
	ob_clean();
	Http::setJsonHeaders();
	echo json_encode($DATA, JSON_UNESCAPED_UNICODE);
	die;
}

// Учитавање одговарајућег шаблона приказа
$headerView = './app/views/_global/header.php';
$footerView = './app/views/_global/footer.php';
$view = './app/views/' . $foundRoute->getController() . '/' . $foundRoute->getMethod() . '.php';

if (!file_exists($headerView)) {
	ob_clean();
	die('View error - header file missing!');
}

if (!file_exists($view)) {
	ob_clean();
	die('View error - file not found!');
}

if (!file_exists($footerView)) {
	ob_clean();
	die('View error - footer file missing!');
}

require_once $headerView;
require_once $view;
require_once $footerView;
