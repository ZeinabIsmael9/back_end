<?php

namespace Illuminates;

use Illuminates\Router\Route;
// use App\HTTP\Controllers\HomeController;
class Application
{
    protected $router;
    public function start()
    {
        $this->router = new Route;
        include route_path();
        // var_dump(config('route.path'));
        // $this->router::get('/', HomeController::class ,'index');
        // $this->router::get( 'about', HomeController::class , 'about');
    }
    public function __destruct()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->router->dispatch($uri, $_SERVER['REQUEST_METHOD']);
    }
}
