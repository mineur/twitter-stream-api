<?php

# Imports
use Alexhoma\TwitterStreamApi\HttpClient;
use Alexhoma\TwitterStreamApi\PublicStream;

# Errors
error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", "on");

# Autoload
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Testing Console
 */
echo ':: Initializing Console ::' . PHP_EOL;

$httpClient = new HttpClient(
    'bTlijKb4c6vnGS1skdZQo5ch0',
    'PNGiXkQta5pa2T0XCEGNCxBniZe94vyK0GbXUtEX2Y7GynNX6Y',
    '	305706048-vfG5DWcT64WpLz0N3AE5rFlre5Gmf9CVG4z3DpWW',
    'TRXyhuic9Lka5QHr3ovA5C0LSoa4aFeuuZa3dVth7pG2S'
);

echo (new PublicStream($httpClient))->open('hello');

