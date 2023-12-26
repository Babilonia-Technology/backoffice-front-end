<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Services\Helpers;
use App\Services\SesionService;
use Phroute\Phroute\Dispatcher;
use App\Controllers\HomeController;
use App\Middlewares\Authentication;
use Phroute\Phroute\RouteCollector;

use App\Controllers\LeadsController;
use App\Controllers\LoginController;
use App\Controllers\ViewsController;
use App\Controllers\AvisosController;
use App\Controllers\ListasController;
use App\Controllers\AccountController;
use App\Controllers\AlertasController;
use App\Controllers\ClientesController;
use App\Controllers\PaquetesController;
use App\Controllers\ReportesController;
use App\Controllers\Configuration2faController;
use App\Controllers\ConfigurationMenuController;
use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\Exception\HttpMethodNotAllowedException;

$router = new RouteCollector();

$router->filter("logueado", [Authentication::class, "auth"]);
$router->filter("no-logueado", [Authentication::class, "noauth"]);
$router->filter("verified", [Authentication::class, "verified"]);
$router->filter("VerifiedSaved", [Authentication::class, "VerifiedSaved"]);
$router->filter("VerifiedNoSaved", [Authentication::class, "VerifiedNoSaved"]);
$router->filter("verifyPrivileges", [Authentication::class, "verifyPrivileges"]);

// vistas privadas
$router
    ->group(["before" => "logueado"], function ($enrutadorVistasPrivadas) {


        $enrutadorVistasPrivadas->group(['before' => 'verified'], function($router){

            $router
                ->get("/", [HomeController::class, "index"])

                ->get("/account-edit", [AccountController::class, "viewEditAccount"])
                
                ->get("/menu", [ConfigurationMenuController::class, "index"], ['before' => 'verifyPrivileges'])
                ->post("/menu", [ConfigurationMenuController::class, "post"], ['before' => 'verifyPrivileges'])

                ->get("/2fa", [Configuration2faController::class, "index"], ['before' => 'verifyPrivileges'])
                ->post("/2fa", [Configuration2faController::class, "post"], ['before' => 'verifyPrivileges'])
                ->delete("/2fa", [Configuration2faController::class, "delete"], ['before' => 'verifyPrivileges'])

                ->get("/alertas", [AlertasController::class, "index"])
                ->get("/avisos", [AvisosController::class, "index"])
                ->get("/clientes", [ClientesController::class, "index"])
                ->get("/leads", [LeadsController::class, "index"])
                ->get("/paquetes", [PaquetesController::class, "index"])
                ->get("/vistas", [ViewsController::class, "index"])
                ->get("/reportes", [ReportesController::class, "index"]);

        });

        $enrutadorVistasPrivadas->group(['before' => 'VerifiedSaved'], function($router){
            
            $router
                ->get("/update-account-2fa", [AccountController::class, "viewUpdate2fa"])
                ->post("/update-account-2fa", [AccountController::class, "postUpdate2fa"]);
        });
        

        $enrutadorVistasPrivadas->group(['before' => 'VerifiedNoSaved'], function($router){
            $router
                ->get("/verify-account", [LoginController::class, "verifyAccount"])
                ->post("/verify-account", [AccountController::class, "verifyAccountPost"]);
        });

        $enrutadorVistasPrivadas->get("/logout", [LoginController::class, "logout"]);                        
    });

// vistas publicas
$router
    ->group(["before" => "no-logueado"], function ($enrutadorVistasPublicas) {
        $enrutadorVistasPublicas
        ->get("/login", [LoginController::class, "index"])
        ->post("/login", [LoginController::class, "login"]);
        
    });


$despachador = new Dispatcher($router->getData());
$rutaCompleta = $_SERVER["REQUEST_URI"];
$metodo = $_SERVER['REQUEST_METHOD'];
$rutaLimpia = processInput($rutaCompleta);

try {
    $despachador->dispatch($metodo, $rutaLimpia); # Mandar sólo el método y la ruta limpia
   //dd($dispacher);
} catch (HttpRouteNotFoundException $error) {
    
    $message = $error->getMessage() ?? '';
    
    if($message != '' && $_SERVER['REQUEST_URI']!="/login"){

        $session_usuario = SesionService::leer("correoUsuario");
        $approved = $session_usuario["approved"]??false;
        $verifyAccountrFind = str_contains($_SERVER['REQUEST_URI'], "verify-account") ?? false;
        
        if(!empty($session_usuario) && $approved == false){
            echo view("login-2fa");
        }else if(!empty($session_usuario) && $approved == true){
            echo view("home");
        }else if(empty($session_usuario)){
            echo view("login", [
                "message" => $message
            ]);
        }
        
    }
    
} catch (HttpMethodNotAllowedException $e) {
    echo "Error: Ruta encontrada pero método no permitido";
}

function processInput($uri)
{
    return $uri;
}
?>