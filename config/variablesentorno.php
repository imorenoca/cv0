<?php
// Si existen variables de entorno (p. ej. definidas en docker-compose.yml) se usan esas;
// si no, se usan los valores por defecto de un entorno local con XAMPP.
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USERNAME', getenv('DB_USERNAME') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_DATABASE', getenv('DB_DATABASE') ?: 'cv');
 

