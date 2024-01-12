<?php
session_start();

$root = $_SERVER["DOCUMENT_ROOT"];
$parts = explode("/", $root);
$last_line = end($parts);
$last_line = ($last_line == "")? "" : "/";
define("URL_ROOT", $_SERVER["DOCUMENT_ROOT"] . $last_line );

$dotenv = Dotenv\Dotenv::createImmutable(URL_ROOT);
$dotenv->load(); 

define("URL_APP", URL_ROOT . "app");
define("URL_WEB", $_SERVER["URL_WEB"]??"http://localhost/backoffice/");
define("URL_LOGS", URL_ROOT. "logs/");
define("URL_PUBLIC", URL_ROOT . "public/");
define("URL_ASSETS", URL_ROOT . "public/assets/");
define("URL_API", URL_ROOT . "api/");
define("URL_VIEWS", URL_ROOT. "views/");
define("URL_CACHE", URL_ROOT. "cache/");
define("TESTING", $_SERVER["APP_TESTING"]??false);
define("NOMBRE_APLICACION", "");
define("AUTOR", "");

if(!is_dir(URL_CACHE)){ mkdir(URL_CACHE, 0777, true);   } 

if(!is_dir(URL_LOGS. "errors")){ mkdir(URL_LOGS."errors", 0777, true); }

if(!is_dir(URL_LOGS. "access")){ mkdir(URL_LOGS."access", 0777, true); }

ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", URL_LOGS . "errors/" . date("Y-m-d") . ".log");

$app_lang_listing_type = [
    "all" => "Todos",
    "sale" => "Venta",
    "rent" => "Alquiler"
];
$app_lang_property_type = [
    "all" => 'Todos',
    "offices" => 'Oficinas',
    "residential" => 'Residencial',
    "both" => 'Residencial y Oficinas',
    "apartment" => 'Departamento',
    "Residencial" =>  'Residencial',
    "Oficinas" =>  'Oficinas',
    "Mixto" =>  'Mixto',
    "house" =>  'Casa',
    "commercial" =>  'Local comercial',
    "office" =>  'Oficina',
    "land" =>  'Terreno',
    "room" =>  'Habitación',
    "local_industrial" =>  'Local Industrial',
    "land_agricultural" =>  'Terreno Agrícola',
    "land_industrial" =>  'Terreno Industrial',
    "land_commercial" =>  'Terreno Comercial',
    "cottage" =>  'Casa de Campo',
    "beach_house" =>  'Casa de Playa',
    "building" =>  'Edificio',
    "hotel" =>  'Hotel;',
    "deposit" =>  'Depósito',
    "parking" =>  'Estacionamiento',
    "airs" =>  'Aires'        
];
$app_lang_alert_type = [
    "lead" => "Lead",
    "similar" => "Similar",
    "alert" => "Alert"
];
$app_lang_alert_state = [
    "Desactivado",
    "Activado"
];
define("APP_LANG_LISTING_TYPE", $app_lang_listing_type);
define("APP_LANG_PROPERTY_TYPE", $app_lang_property_type);
define("APP_LANG_ALERT_TYPE", $app_lang_alert_type);
define("APP_LANG_ALERT_STATE", $app_lang_alert_state);

?>