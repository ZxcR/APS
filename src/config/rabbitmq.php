<?php
define('RABBIT_HOST', 'rabbitmq');
define('RABBIT_PORT', 5672);
define('RABBIT_USER', 'user');
define('RABBIT_PASS', 'bitnami');

use PhpAmqpLib\Connection\AMQPStreamConnection;


$connection = new AMQPStreamConnection(
    RABBIT_HOST,
    RABBIT_PORT,
    RABBIT_USER,
    RABBIT_PASS
);
