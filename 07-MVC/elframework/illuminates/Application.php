<?php

namespace Illuminates;

use App\Core;
use Illuminates\Middleware\CSRFToken;
use Illuminates\Router\Route;
use Illuminates\Router\Segment;
use Illuminates\Sessions\Session;

class Application
{
    protected $router;
    protected $framework_setting;

    public function start()
    {
        $this->router = new Route();
        $this->framework_setting = new FrameworkSetting();
        $this->framework_setting::setTimeZone();

        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $cleanedUri = '/' . ltrim(str_replace($basePath, '', $requestUri), '/');

        if (strpos($cleanedUri, '/api') === 0) {
            $this->apiRoute();
        } else {
            $this->framework_setting::setlocale($_GET['lang'] ?? 'en');
            $this->webRoute();
        }
    }


    public function __destruct()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $cleanedUri = '/' . ltrim(str_replace($basePath, '', $requestUri), '/');

        $this->router->dispatch($cleanedUri, $_SERVER['REQUEST_METHOD']);
    }

    public function webRoute()
    {
        foreach (Core::$globalWeb as $gloal) {
            new $gloal();
        }
        $this->createCSRF();
        $this->framework_setting::setlocale(config('app.locale'));
        include route_path('web.php');
    }

    public function createCSRF()
    {
        if (!Session::has('csrf_token')) {
            $csrf = CSRFToken::generateCSRFToken();
            Session::make('csrf_token', $csrf);
            // return $csrf;
        }
    }
    public function apiRoute()
    {
        foreach (Core::$globalApi as $gloal) {
            new $gloal();
        }
        include route_path('api.php');
    }
}
