<?php

namespace Illuminates;

use App\Core;
use Illuminates\Router\Route;
use Illuminates\Router\Segment;
use Illuminates\Sessions\Session;

// use App\HTTP\Controllers\HomeController;
class Application
{
    protected $router;
    /**
     * @return void
     */
    public function start()
    {
        $this->router = new Route();
        // Session::make('session_massage', 'Welcome to Elframework');
        // echo Session::get('massage');
        // var_dump(Segment::all());
        if(Segment::get(0)== 'api') {
            $this->apiRoute();
        }else{
            $this->webRoute();
        }
        // var_dump(public_path());
        // var_dump(config('route.path'));
        // $this->router::get('/', HomeController::class ,'index');
        // $this->router::get( 'about', HomeController::class , 'about');
    }

    public function __destruct()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->router->dispatch($uri, $_SERVER['REQUEST_METHOD']);
    }

    /**
     *
     * @return void
     */
    public function webRoute()
    {
        foreach (Core::$globalWeb as $gloal) {
            new $gloal();
        }
        include route_path() . '/web.php';
    }

    public function apiRoute()
    {
        foreach (Core::$globalApi as $gloal) {
            new $gloal();
        }
        include route_path() . '/api.php';
    }
}
