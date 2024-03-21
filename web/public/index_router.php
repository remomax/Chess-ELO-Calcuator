<?php
declare(strict_types=1);

session_start();

use Pecee\SimpleRouter\SimpleRouter;

/* Load external routes file */

require_once '../vendor/autoload.php';
require_once '../route_helper.php';
require_once '../app/routes.php';

/**
 * The default namespace for route-callbacks, so we don't have to specify it each time.
 * Can be overwritten by using the namespace config option on your routes.
 */

SimpleRouter::setDefaultNamespace('\Demo\Controllers');

#print_r($_SERVER);
// Start the routing
SimpleRouter::start();
