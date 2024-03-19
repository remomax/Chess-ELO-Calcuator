<?php

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', function() {
    return 'Hello world';
});
SimpleRouter::get('/liste', function() {
    return 'Liste';
});
SimpleRouter::get('/login', function() {
    return 'Login here';
});
