<?php

require __DIR__ . '/vendor/autoload.php';

function createParts(&$parts, $j = 0)
{
	$j++;
	if ($j < 5) {
		for ($i = 0; $i < 10; $i++) {
    			$part = dechex(crc32(mt_rand(1000, 2000)));
			$parts[$part] = [];
			createParts($parts[$part], $j);
		}
	}
}

function createRoutes(&$routes, $parts, $prefix = '/')
{
	foreach ($parts as $part => $subParts) {
		if (!empty($subParts)) {
			createRoutes($routes, $subParts, $prefix . $part . '/');
		} else {
			$routes[] = $prefix . $part . '/{id:[0-9]+}';
		}
	}
}

$sections = ['news', 'projects', 'users', 'tasks', 'articles', 'documents', 'photos'];
$subsections = ['all', 'new', 'popular', 'discussed', 'hot', 'my'];

$routePatterns = [
'/%section%/{param1}' => '/%section%/1',
'/%section%/{param1}/{param2}' => '/%section%/1/2',
'/%section%/{param1}/{param2}/full' => '/%section%/1/2/full',
'/%section%/%subsection%/{param1:[0-9]+}' => '/%section%/%subsection%/1',
'/%section%/%subsection%/{param1:[0-9]+}/{param2:[a-z]+}' => '/%section%/%subsection%/1/hello',
'/%section%/%subsection%/{param1:[0-9]+}/{param2:[a-z]+}/full' => '/%section%/%subsection%/1/hello/full'
];

$routeIndex = [];
foreach ($sections as $section) {
	foreach ($subsections as $subsection) {
		foreach ($routePatterns as $routePattern => $urlPattern) {
			$route = str_replace(['%section%', '%subsection%'], [$section, $subsection], $routePattern);
			$url = str_replace(['%section%', '%subsection%'], [$section, $subsection], $urlPattern);
			$routeIndex[$route] = $url;
		}
	}
}

var_dump($routeIndex);

$urls = array_values($routeIndex);

function createFastRoute($routeIndex)
{
	$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($routeIndex) {
		$i = 0;
		foreach ($routeIndex as $route => $url) {
			$r->addRoute('GET', $route, 'handler' . $i);
			$i++;
		}
	});
	return $dispatcher;
}

function createTreeRoute($routeIndex)
{
	$router = new \TreeRoute\Router();
	$i = 0;
	foreach ($routeIndex as $route => $url) {
		$router->addRoute('GET', $route, 'handler' . $i);
		$i++;
	}
	return $router;
}

$t1 = microtime(true);
$fastRoute = createFastRoute($routeIndex);
$t2 = microtime(true);


$t3 = microtime(true);
$treeRoute = createTreeRoute($routeIndex);
$t4 = microtime(true);

echo 'FastRoute init time: ' . ($t2 - $t1) . PHP_EOL;
echo 'TreeRoute init time: ' . ($t4 - $t2) . PHP_EOL;

function test($router, $routeIndex, $url)
{
	$time = 0;
	for ($i = 0; $i < 10000; $i++) {
		$t1 = microtime(true);
		$router->dispatch('GET', $url);
		$t2 = microtime(true);
		$time += ($t2 - $t1);
	}
	return $time;
}

$fastRouteResultFirst = test($fastRoute, $routeIndex, $urls[0]);
$treeRouteResultFirst = test($treeRoute, $routeIndex, $urls[0]);

$fastRouteResultMiddle = test($fastRoute, $routeIndex, $urls[round(sizeof($urls) / 2)]);
$treeRouteResultMiddle = test($treeRoute, $routeIndex, $urls[round(sizeof($urls) / 2)]);

$fastRouteResultLast = test($fastRoute, $routeIndex, $urls[sizeof($urls) - 1]);
$treeRouteResultLast = test($treeRoute, $routeIndex, $urls[sizeof($urls) - 1]);

$fastRouteResultNotFound = test($fastRoute, $routeIndex, '/not/found/url');
$treeRouteResultNotFound = test($treeRoute, $routeIndex, '/not/found/url');

echo 'FastRoute first route time: ' . $fastRouteResultFirst . PHP_EOL;
echo 'TreeRoute first route time: ' . $treeRouteResultFirst . PHP_EOL;

echo 'FastRoute middle route time: ' . $fastRouteResultMiddle . PHP_EOL;
echo 'TreeRoute middle route time: ' . $treeRouteResultMiddle . PHP_EOL;

echo 'FastRoute last route time: ' . $fastRouteResultLast . PHP_EOL;
echo 'TreeRoute last route time: ' . $treeRouteResultLast . PHP_EOL;

echo 'FastRoute not found time: ' . $fastRouteResultNotFound . PHP_EOL;
echo 'TreeRoute not found time: ' . $treeRouteResultNotFound . PHP_EOL;
