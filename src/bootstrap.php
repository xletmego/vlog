<?php declare(strict_types=1);

use Vlog\FrontPage\Presentation\FrontPageController;

define('ROOT_DIR', __DIR__ . '/../');

require ROOT_DIR . '/vendor/autoload.php';

\Tracy\Debugger::enable();

$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

$dispatcher = \FastRoute\simpleDispatcher(
    function (\FastRoute\RouteCollector $r) {
        $routes = include(ROOT_DIR . '/src/routes.php');
        foreach ($routes as $route) {
            $r->addRoute(...$route);
        }
    }
);

$routeInfo = $dispatcher->dispatch(
    $request->getMethod(),
    $request->getPathInfo()
);
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response = new \Symfony\Component\HttpFoundation\Response(
            'Not found',
            404
        );
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response = new \Symfony\Component\HttpFoundation\Response(
            'Method not allowed',
            405
        );
        break;
    case \FastRoute\Dispatcher::FOUND:
        [$controllerName, $method] = explode('#', $routeInfo[1]);
        $vars = $routeInfo[2];
        $factory = new Vlog\Framework\Rendering\TwigTemplateRendererFactory();
        $templateRenderer = $factory->create();
        $controller = new $controllerName($templateRenderer);
        $response = $controller->$method($request, $vars);
        break;
}


//
$response->prepare($request);
$response->send();
