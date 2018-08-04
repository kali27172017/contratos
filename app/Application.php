<?php
namespace App;

use Illuminate\Contracts\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PanelController;



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
        $router->post('/', LoginController::class . '@showMessageLogin');

        $router->get('dashboard', DashboardController::class . '@index');
        $router->get('exit', DashboardController::class . '@exit');
        $router->post('dashboard', DashboardController::class . '@registerTeacher');


        $router->get('contract',ContractController::class . '@index');
        $router->post('contract' , ContractController::class  .  '@searchTeacher');
        $router->post('contract/teacher', ContractController::class . '@saveContractTeacher');
        $router->get('contract/generate/{id}', ContractController::class .  '@loadContractGenerate');


        $router->get('panel',PanelController::class . '@index');
        $router->get('panel/{id}',PanelController::class . '@actionCrud');        

        $response = $router->dispatch(Request::capture());
        $response->send();
    }
}