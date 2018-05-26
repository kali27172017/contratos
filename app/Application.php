<?php
namespace App;

use Illuminate\Contracts\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use App\Http\Controllers\LoginController;

class Application
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        $router = new Router(
            new Dispatcher($this->container),
            $this->container
        );

        $router->get('/', LoginController::class . '@index');
        $router->post('login', LoginController::class . '@prueba');
        //$router->get('/post/{id}', HomeController::class . '@show');

        $response = $router->dispatch(Request::capture());

        $response->send();
    }
}