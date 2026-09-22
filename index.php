<?php
$rutas = [
    '/' => __DIR__ .'/vistas/bienvenida.php',
];

$ruta_silicitada = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (array_key_exists($ruta_silicitada, $rutas)) {
    require_once $rutas[$ruta_silicitada];
} else {
    require_once __DIR__ . '/vistas/error404.php';
}
